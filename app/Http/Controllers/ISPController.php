<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ISPController extends Controller
{
    public function index()
    {
        if (request('filter') == 'approved') {
            $isp_staffs = User::where('user_type', 'isp_staff')->where('active', 1)->get();
        } else if (request('filter') == 'pending') {
            $isp_staffs = User::where('user_type', 'isp_staff')->where('active', 0)->get();
        } else {
            $isp_staffs = User::where('user_type', 'isp_staff')->get();
        }

        $pendingStaffCount = User::where('user_type', 'isp_staff')->where('active', 0)->count();
        $activeStaffCount = User::where('user_type', 'isp_staff')->where('active', 1)->count();

        return view('isp.index', get_defined_vars());
    }

    public function view($id)
    {
        $staff = User::where('id', $id)->where('user_type', 'isp_staff')->first();
        if (!$staff) {
            return redirect()->route('isp.index')->with('success', 'No ISP found');
        }
        return view('isp.view', get_defined_vars());
    }

    public function approve($id)
    {
        $staff = User::findOrFail($id);
        $staff->active = 1;
        $staff->save();
        return redirect()->route('isp.view', $id)->with('success', 'ISP registration request accepted');
    }

    public function delete($id)
    {
        $staff = User::findOrFail($id);
        $staff->delete();
        return redirect()->route('isp.index')->with('success', 'ISP registration request deleted');
    }
}
