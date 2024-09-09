<?php

namespace App\Http\Controllers\Api;

use App\Helper\CustomHelper;
use App\Http\Controllers\Controller;
use App\Models\NdcAppointment;
use App\Models\User;
use App\Notifications\AllNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * Store Data ndc appointment
     * @created 09-05-24
     * @param Request $request
     *
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function appointmentRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'purpose' => 'required|string|max:244',
            'belong' => 'required|string|max:244',
            'date' => 'required|date',
            'time' => 'required',
            'sector' => 'required|string|max:244',
            'name' => 'required|string|max:244',
            'identification' => 'required|string|max:244',
            'organization' => 'required|string|max:244',
            'designation' => 'required|string|max:244',
            'phone' => 'required|string|max:244',
            'email' => 'required|string|max:244',
            'name_of_personnel' => 'nullable|string|max:244',
            'device_model' => 'nullable|string|max:244',
            'device_serial' => 'nullable|string|max:244',
            'device_description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => 'Validation Error', 'errors' => $validator->errors()], 422);
        }

        try {
            NdcAppointment::create([
                'user_id' => auth()->user()->id,
                'purpose' => $request->purpose,
                'belong' => $request->belong,
                'date' => $request->date,
                'time' => $request->time,
                'sector' => $request->sector,
                'name' => $request->name,
                'identification' => $request->identification,
                'organization' => $request->organization,
                'designation' => $request->designation,
                'phone' => $request->phone,
                'email' => $request->email,
                'name_of_personnel' => $request->name_of_personnel,
                'device_model' => $request->device_model,
                'device_serial' => $request->device_serial,
                'device_description' => $request->device_description,
                'status' => 'Pending'
            ]);

            $notify_message = auth()->user()->name ?? '|' . '| New visit request';
            $users = User::where('active', 1)->where('ndc_admin_sector', $request->sector)->get();
            Notification::send($users, new AllNotification($notify_message));

            return response()->json(['status' => true, 'message' => 'Appointment Request Successfully'], 200);
        } catch (\Throwable $th) {
            // return response()->json(['status' => false, 'message' => 'Something is error'], 500);
            return response()->json(['status' => false, 'message' => $th->getMessage()], 500);
        }
    }

    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * Store Data ndc appointment
     * @created 09-05-24
     * @param Request $request
     *
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function guestAppointmentRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'purpose' => 'required|string|max:244',
            'belong' => 'required|string|max:244',
            'date' => 'required|date',
            'time' => 'required',
            'sector' => 'required|string|max:244',
            'guest_name' => 'required|string|max:244',
            'guest_identification' => 'required|string|max:244',
            'guest_organization' => 'required|string|max:244',
            'guest_designation' => 'required|string|max:244',
            'guest_phone' => 'required|string|max:20',
            'guest_email' => 'required|email',
            'document_file' => 'nullable|file|max:21000|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx',
            'device_model' => 'nullable|string|max:244',
            'device_serial' => 'nullable|string|max:244',
            'device_description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => 'Validation Error', 'errors' => $validator->errors()], 422);
        }

        $document = '';
        if ($request->hasFile('document_file')) {
            $document = CustomHelper::storeImage($request->file('document_file'), '/ndc/document/');
        }

        try {
            NdcAppointment::create([
                'purpose' => $request->purpose,
                'belong' => $request->belong,
                'date' => $request->date,
                'time' => $request->time,
                'sector' => $request->sector,
                'guest_name' => $request->guest_name,
                'guest_identification' => $request->guest_identification,
                'guest_organization' => $request->guest_organization,
                'guest_designation' => $request->guest_designation,
                'guest_phone' => $request->guest_phone,
                'guest_email' => $request->guest_email,
                'document_file' => $document != false ? $document : null,
                'device_model' => $request->device_model,
                'device_serial' => $request->device_serial,
                'device_description' => $request->device_description,
                'status' => 'Pending'
            ]);

            $notify_message = auth()->user()->name ?? '|' . '| New visit request';
            $users = User::where('active', 1)->where('ndc_admin_sector', $request->sector)->get();
            Notification::send($users, new AllNotification($notify_message));

            return response()->json(['status' => true, 'message' => 'Appointment Request Successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something is error'], 500);
        }
    }

    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * Approve appointment
     * @created 09-05-24
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function acceptOrReject(Request $request)
    {
        $decision = $request->input('type');
        $approve_by = auth()->user()->id;
        $ndcAppointment = NdcAppointment::find($request->appointment_id);
        try {
            if (in_array($decision, ['accepted', 'rejected']) && $ndcAppointment) {
                $ndcAppointment->update(['status' => ucfirst($decision), 'approved_by' => $approve_by]);

                $notify_message = $decision === 'accepted' ? 'Visit request accepted' : 'Visit request rejected';
                $userId = $ndcAppointment->user_id ?? 0;
                $users = User::where('id', $userId)->orWhere('user_type', 'ndc_security_admin')->get();
                Notification::send($users, new AllNotification($notify_message));

                return response()->json(['status' => true, 'message' => 'Appointment Accept Successfully', 'records' => []], 200);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => true, 'message' => 'Something Was Wrong', 'records' => []], 200);
        }
    }

    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * Approve appointment
     * @created 09-05-24
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function visitorEntry(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'entry_time' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Validation Error', 'errors' => $validator->errors()], 422);
        }

        $entry_by = auth()->user()->id;
        $ndcAppointment = NdcAppointment::find($request->appointment_id);
        try {
            if ($ndcAppointment) {
                $ndcAppointment->update(['entry_time' => $request->entry_time, 'entry_by' => $entry_by]);

                $notify_message = 'Appointment entry time has been fixed';
                $userId = $ndcAppointment->user_id ?? 0;
                $users = User::where('id', $userId)->get();
                Notification::send($users, new AllNotification($notify_message));

                return response()->json(['success' => true, 'message' => 'Entry Time Save Successfully', 'errors' => []], 200);
            }
        } catch (\Throwable $th) {
            return response()->json(['success' => true, 'message' => 'Something Was Wrong', 'errors' => []], 200);
        }
    }

    /**
     * @author Touch and Solve <email>
     * @contributor Monzurul Hasan <monzurulhasan1001@gmail.com>
     * Get PDF
     * @created 09-05-24
     * @param int $id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function getPdf(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required|exists:ndc_appointments,id',
                'time' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => "failed", 'message' => 'Validation Error', 'errors' => $validator->errors()], 422);
            }

            if (CustomHelper::userRoleName(auth()->user()) != 'NDC Security Admin') {
                return response()->json(['status' => "failed", 'message' => 'Permission Denied'], 403);
            }

            $id = $request->id;
            $time = $request->time;

            $ndc = NdcAppointment::with('user')->where('id', $id)->first();
            if ($ndc->status != 'Accepted') {
                return response()->json(['status' => 'failed', 'message' => 'Appointment is not accepted yet']);
            }

            $ndc->entry_time = $time;

            if ($ndc->save()) {
                $url = url("/ndc/download/pdf/" . encode_id($id));
                return response()->json(['status' => 'success', 'download_url' => $url]);
            } else {
                return response()->json(['status' => 'failed', 'message' => 'No data found']);
            }
        } catch (Exception $e) {
            return response()->json(['status' => 'failed', 'message' => 'Something went wrong']);
        }
    }


    /**
     * @author Touch and Solve <email>
     * @contributor Monzurul Hasan <monzurulhasan1001@gmail.com>
     * Get PDF
     * @created 09-05-24
     * @param int $id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function filterData(Request $request)
    {
        $data = NdcAppointment::query()->where('status', 'Accepted')->whereNotNull('approved_by');
        // $date = $request->filled('date');
        $date = $request->date;
        // $time = $request->filled('time');
        $time = $request->time;
        // $sector = $request->filled('sector');
        $sector = $request->sector;

        if ($date) {
            $data = $data->where('date', $request->date);
        }
        if ($time) {
            $data = $data->where('time', $request->time);
        }
        if ($sector) {
            $data = $data->where('sector', $request->sector);
        }

        $ndcAppointments = $data->paginate(10);
        $responseData = [];
        foreach ($ndcAppointments as $key => $value) {
            $responseData['appointments'][] = [
                'appointment_id' => $value->id,
                'name' => $value->name ?? $value->guest_name,
                'identification' => $value->identification ?? $value->guest_identification,
                'organization' => $value->organization ?? $value->guest_organization,
                'designation' => $value->designation ?? $value->guest_designation,
                'email' => $value->email ?? $value->guest_email,
                'phone' => $value->phone ?? $value->guest_phone,
                'name_of_personnel' => $value->name_of_personnel ?? 'None',
                'belong' => $value->belong,
                'purpose' => $value->purpose,
                'appointment_date_time' => $value->date . ', ' . $value->time,
                'sector' => $value->sector ?? 'None',
                'status' => $value->status
            ];
        }

        $responseData['pagination'] = [
            'next_page' => $ndcAppointments->nextPageUrl() ?? 'None',
            'previous_page' => $ndcAppointments->previousPageUrl() ?? 'None'
        ];

        return response()->json(['status' => true, 'message' => '', 'records' => $responseData], 200);

    }
}