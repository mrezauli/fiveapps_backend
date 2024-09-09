<?php

namespace App\Http\Controllers;

use App\Helper\CustomHelper;
use App\Helper\RedirectHelper;
use App\Models\NdcAppointment;
use App\Models\User;
use App\Notifications\AllNotification;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class NDCAppointmentController extends Controller
{
    public function index()
    {

        $mySector = auth()->user()->ndc_admin_sector ?? null;
        if (CustomHelper::userRoleName(auth()->user()) == 'NDC Admin') {
            $acceptedCount = NdcAppointment::where('status', 'Accepted')->where('sector', $mySector)->count();
            $acceptedCount = $acceptedCount > 99 ? '99+' : $acceptedCount;
            $pendingCount = NdcAppointment::where('status', 'Pending')->where('sector', $mySector)->count();
            $pendingCount = $pendingCount > 99 ? '99+' : $pendingCount;
            $rejectedCount = NdcAppointment::where('status', 'Rejected')->where('sector', $mySector)->count();
            $rejectedCount = $rejectedCount > 99 ? '99+' : $rejectedCount;
        } else {
            $acceptedCount = NdcAppointment::where('status', 'Accepted')->count();
            $acceptedCount = $acceptedCount > 99 ? '99+' : $acceptedCount;
            $pendingCount = NdcAppointment::where('status', 'Pending')->count();
            $pendingCount = $pendingCount > 99 ? '99+' : $pendingCount;
            $rejectedCount = NdcAppointment::where('status', 'Rejected')->count();
            $rejectedCount = $rejectedCount > 99 ? '99+' : $rejectedCount;
        }

        $filters = ['accepted' => 'Accepted', 'pending' => 'Pending', 'declined' => 'Rejected'];

        $filter = $filters[request('filter')] ?? null;
        if ($filter) {
            if (CustomHelper::userRoleName(auth()->user()) == 'NDC Admin') {
                $mySector = auth()->user()->ndc_admin_sector ?? null;
                $bcc_Staffs = NdcAppointment::where('status', $filter)->where('sector', $mySector)->orderByDesc('id')->get();
            } else {
                $bcc_Staffs = NdcAppointment::where('status', $filter)->orderByDesc('id')->get();
            }
        } else {
            if (CustomHelper::userRoleName(auth()->user()) == 'NDC Security Admin') {
                return redirect()->route('ndc.appointment.index', ['filter' => 'accepted']);
            } else {
                return redirect()->route('ndc.appointment.index', ['filter' => 'pending']);
            }
        }

        return view('ndc.ndc_appointment.index', get_defined_vars());
    }

    public function view($id)
    {
        $staff = NdcAppointment::with('user')->findOrFail($id);
        return view('ndc.ndc_appointment.view', get_defined_vars());
    }

    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * Login
     * @created 16-04-24
     * @param \Illuminate\Http\Request $request
     * @return
     */
    public function edit(Request $request, $id)
    {
        $request->validate([
            'date' => 'nullable|date',
            'time' => 'nullable',
        ]);
        try {
            $appointment = NdcAppointment::find($id);
            if ($appointment) {
                $appointment->date = $request->date ?? $appointment->date;
                $appointment->time = $request->time ?? $appointment->time;
                $appointment->save();
                return redirect()->back()->with('success', 'Appointment time updated successfully');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function transfer(Request $request, $id)
    {
        $sectors = ['Physical Security & Infrastructure', 'Network', 'Co Location', 'Server & Cloud', 'Email'];
        $request->validate([
            'ndc_admin_sector' => ['required', Rule::in($sectors)],
        ]);

        try {
            $appointment = NdcAppointment::find($id);
            if ($appointment) {
                $appointment->sector = $request->ndc_admin_sector;
                $appointment->save();
                return redirect()->route('ndc.appointment.index')->with('success', 'Appointment transfered successfully');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function update_entry_time(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'time' => 'required',
        ]);
        try {
            $id = $request->id;
            $appointment = NdcAppointment::find($id);
            if ($appointment) {
                $appointment->entry_time = $request->time;
                $appointment->save();

                $notify_message = 'Appointment entry time has been fixed';
                $userId = $appointment->user_id ?? 0;
                $users = User::where('id', $userId)->get();
                Notification::send($users, new AllNotification($notify_message));

                return ['status' => 'success', 'message' => 'Entry time updated successfully'];
            } else {
                return ['status' => 'error', 'message' => 'Something went wrong'];
            }
        } catch (Exception $e) {
            return ['status' => 'error', 'message' => 'Something went wrong'];
        }
    }

    public function approve($id)
    {
        $ndc = NdcAppointment::find($id);
        if ($ndc) {
            if ($ndc) {
                $ndc->update([
                    'status' => 'Accepted'
                ]);
                return redirect()->back()->with('success', 'NDC appointment accept successfully');
            }
        }
        return redirect()->back()->with('error', 'Something went wrong');
    }

    public function decline($id)
    {
        $ndc = NdcAppointment::find($id);
        if ($ndc) {
            if ($ndc) {
                $ndc->update([
                    'status' => 'Rejected'
                ]);
                return redirect()->back()->with('success', 'NDC appointment declined');
            }
        }
        return redirect()->back()->with('error', 'Something went wrong');
    }

    public function print($id)
    {
        // $d_id = decode_id($id);
        // if (!$d_id) {
        //     return json_encode(['status' => 'error', 'message' => 'Invalid ID']);
        // }
        $data = NdcAppointment::with('user')->findOrFail($id);
        // dd($data);
        $pdf = Pdf::loadView('pdf.ndc_appointment.format', compact('data'))->setPaper('a4', 'portrait')->set_option("dpi", 286.5);
        return $pdf->stream('appointment_' . substr($id, 0, 12) . rand(1111111, 999999) . '_' . now()->day . '-' . now()->format('M') . '.pdf');
        // return view('pdf.ndc_appointment.format', compact('data'));
    }

    public function documentUpload(Request $request, $id)
    {
        $request->validate([
            'document_file' => 'nullable|file|max:21000|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx',
        ]);

        $document = '';
        if ($request->hasFile('document_file')) {
            $document = CustomHelper::storeImage($request->file('document_file'), '/ndc/document/');
        }
        $appointment = NdcAppointment::find($id);
        try {
            if ($appointment) {
                $appointment->update([
                    'document_file' => $document != false ? $document : null,
                ]);

                return back()->with('success', 'Document file upload successfully');
            } else {
                return back()->with('success', 'Not Found');

            }
        } catch (\Throwable $th) {
            return back()->with('error', 'Something is error');

        }
    }
}