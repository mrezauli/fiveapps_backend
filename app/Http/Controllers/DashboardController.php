<?php

namespace App\Http\Controllers;

use Auth;
use Exception;
use Carbon\Carbon;
use App\Models\Trip;
use App\Models\User;
use App\Models\IteeNotice;
use App\Models\IteeExamFee;
use App\Helper\CustomHelper;
use Illuminate\Http\Request;
use App\Models\DriverWithCar;
use App\Models\VlmStaffHierarchy;
use App\Models\IteeExamRegistration;

use function Laravel\Prompts\select;
use Illuminate\Support\Facades\Hash;
use App\Notifications\AllNotification;
use Illuminate\Support\Facades\Notification;

class DashboardController extends Controller
{
    public function index()
    {
        $titles = [
            'bcc_connect' => 'BCC Connect',
            'ndc' => 'NDC',
            'bkiict' => 'BKIICT',
            'itee' => 'ITEE',
            'vm' => 'Vehicle Management',
        ];

        if (CustomHelper::userRoleName(auth()->user()) == 'Super Admin') {
            return view('dashboard', get_defined_vars());
        } else if (CustomHelper::userRoleName(auth()->user()) == 'NTTN' || CustomHelper::userRoleName(auth()->user()) == 'NTTN Staff') {
            return redirect()->route('nttn.index');
        } else if (CustomHelper::userRoleName(auth()->user()) == 'BCC' || CustomHelper::userRoleName(auth()->user()) == 'BCC Staff') {
            return redirect()->route('isp_connection.index');
        } else if (CustomHelper::userRoleName(auth()->user()) == 'NDC Security Admin' || CustomHelper::userRoleName(auth()->user()) == 'NDC Admin') {
            return redirect()->route('ndc.appointment.index');
        } else if (CustomHelper::userRoleName(auth()->user()) == 'ITEE Admin' || CustomHelper::userRoleName(auth()->user()) == 'ITEE Staff') {
            return redirect()->route('itee.exam.application.index');
            //
        } else if (CustomHelper::userRoleName(auth()->user()) == 'VLM Admin' || CustomHelper::userRoleName(auth()->user()) == 'VLM Senior Officer') {
            return redirect()->route('vm.cars.trip.index');
        } else if (CustomHelper::userRoleName(auth()->user()) == 'BKIICT Admin') {
            return redirect()->route('bkiict.course.index');
        } else if (CustomHelper::userRoleName(auth()->user()) == 'Examinee') {
            $notices = IteeNotice::all()->pluck('notice')->toArray();
            $enrolledCourseCount = IteeExamRegistration::where('user_id', auth()->user()->id)->count();
            $totalExamFee = IteeExamFee::count();
            $totalExaminee = User::where('user_type', 'itee_student')->count();
            return view('examinee.dashboard', compact('enrolledCourseCount', 'totalExamFee', 'totalExaminee', "notices")); // examinee dashboard
        } else {
            Auth::logout();
            return redirect('login')->with("error", "Wrong Credentials");
        }
    }

    public function notificationRead()
    {
        try {
            auth()->user()->unreadNotifications->markAsRead();
        } catch (Exception $e) {
            return response()->json('Some Error');
        }
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8',
            'confirm_password' => 'required|same:password'
        ]);

        $id = $request->id;
        try {
            if ($user = User::find($id)) {
                $user->password = Hash::make($request->password);
                $user->save();
            }
        } catch (Exception $e) {
            return redirect()->back();
        }
    }
}
