<?php

namespace App\Http\Controllers\Api;

use App\Helper\CustomHelper;
use App\Http\Controllers\Controller;
use App\Models\DriverWithCar;
use App\Models\Trip;
use App\Models\User;
use App\Models\VlmStaffHierarchy;
use App\Notifications\AllNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Null_;

class VLMController extends Controller
{
    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * Trip Start
     * @created 19-05-24
     * @modified 29-07-24
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function tripRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'user_id'    => 'required',
            'driver_with_car_id' => 'nullable',
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'purpose' => 'required|string|max:255',
            'phone' => 'required',
            'destination_from' => 'required|string|max:255',
            'destination_to' => 'required|string|max:255',
            //'date' => 'required|date', //App Developer Mahafuz Vaai
            'date' => 'required', 
            'start_time' => 'required',
            'end_time' => 'required',
            'approx_distance' => 'required',
            'trip_category' => 'required',
            'type' => 'required',
            'start_trip' => 'nullable',
            'stop_trip' => 'nullable',
            'attachment_file' => 'nullable|file|mimes:pdf,doc,docx,xlsx,xls,csv,txt|max:5300',
            // 'status'     => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => 'Validation error', 'errors' => $validator->errors()]);
        }
        $attachment_file = Null;
        if ($request->hasFile('attachment_file')) {
            $attachment_file = CustomHelper::fileSystem($request->file('attachment_file'), '/vlm/trip/');
        }
        try {
            $trip = Trip::create([
                'user_id' => auth()->user()->id,
                'name' => $request->name,
                'designation' => $request->designation,
                'department' => $request->department,
                'purpose' => $request->purpose,
                'phone' => $request->phone,
                'destination_from' => $request->destination_from,
                'destination_to' => $request->destination_to,
                'date' => $request->date,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'approx_distance' => $request->approx_distance,
                'trip_category' => $request->trip_category,
                'type' => $request->type,
                'attachment_file'   => $attachment_file->path ?? $attachment_file,
                'status' => 'Pending',
            ]);

            $notify_message = "New trip request";
            $userId = (string) auth()->user()->id;
            $senior = VlmStaffHierarchy::whereJsonContains('juniorStaffs', [$userId])->first();
            $data[] = $senior->seniorStaffId ?? 0;
            $data[] = $trip->driverWithCar?->user_id ?? 0;
            $users = User::whereIn('id', $data)->get();
            Notification::send($users, new AllNotification($notify_message));
            return response()->json(['status' => true, 'message' => 'Trip request successfully'], 200);
        } catch (Exception $e) {
            if ($request->hasFile('attachment_file')) {
                CustomHelper::deleteFile($attachment_file->path);
            }
            return response()->json(['status' => true, 'message' => 'Something is error'], 500);

        }

    }


    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * Trip Start
     * @created 19-05-24
     * @param int $tripId
     *
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function startTrip($tripId)
    {
        $userId = auth()->user()->id;
        $ongoingTrip = Trip::where('user_id', $userId)->where('status', 'Accepted')->whereNotNull(['driver_with_car_id', 'start_trip'])->whereNull('stop_trip')->exists();
        if ($ongoingTrip) {
            return response()->json(['status' => true, 'message' => 'At first finished your previous trip.'], 200);
        }

        $trip = Trip::where('id', $tripId)->where('status', 'Accepted')->first();

        try {
            if ($trip) {
                $trip->update(['start_trip' => Carbon::now()]);

                $notify_message = "Trip is start";
                $users = User::where('id', $trip->user_id)->get();
                Notification::send($users, new AllNotification($notify_message));
                return response()->json(['status' => true, 'message' => 'Trip is start.'], 200);
            } else {
                return response()->json(['status' => true, 'message' => 'Trip not found.'], 200);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => true, 'message' => 'Something is error'], 500);

        }

    }

    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * Trip Start
     * @created 19-05-24
     * @param int $tripId
     *
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function stopTrip($tripId)
    {
        $trip = Trip::where('id', $tripId)->where('status', 'Accepted')->first();
        try {
            if ($trip) {
                $trip->update(['status' => 'Finished', 'stop_trip' => Carbon::now()]);

                $notify_message = "Trip is stop";
                $users = User::where('id', $trip->user_id)->get();
                Notification::send($users, new AllNotification($notify_message));
                return response()->json(['status' => true, 'message' => 'Trip is stop.'], 200);
            } else {
                return response()->json(['status' => true, 'message' => 'Trip not found.'], 200);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => true, 'message' => 'Something is error'], 500);

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
        $trip = Trip::find($request->trip_id);
        try {
            if (in_array($decision, ['accepted', 'rejected']) && $trip) {
                $trip->update(['status' => ucfirst($decision)]);

                $notify_message = $decision === 'accepted' ? 'Trip is accepted' : 'Trip is rejected';
                $userId = $trip->user_id ?? 0;
                $senior = VlmStaffHierarchy::whereJsonContains('juniorStaffs', [(string) $userId])->first();
                $data[] = $userId;
                $data[] = $senior->seniorStaffId ?? 0;
                $users = User::whereIn('id', $data)->get();
                Notification::send($users, new AllNotification($notify_message));

                return response()->json(['status' => true, 'message' => 'Trip Accepted Successfully'], 200);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => true, 'message' => 'Something Was Wrong'], 200);
        }
    }

    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * Approve appointment
     * @created 21-05-24
     * @param Request $request
     * @return |\Illuminate\Http\Response
     */
    public function assignCarInTrip(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'trip_id' => 'required|integer',
            'car_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => 'Validation error', 'errors' => $validator->errors()]);
        }

        $trip = Trip::find($request->trip_id);
        try {
            if ($trip) {
                $trip->update(['driver_with_car_id' => $request->car_id]);

                $notify_message = 'You assign this trip.';
                $driver = DriverWithCar::find($request->car_id);
                $userId = $driver->user_id ?? 0;
                // $senior = VlmStaffHierarchy::whereJsonContains('juniorStaffs', [(string) $userId])->first();
                $data[] = $userId;
                // $data[] = $senior->seniorStaffId ?? 0;
                $users = User::whereIn('id', $data)->get();
                Notification::send($users, new AllNotification($notify_message));

                return response()->json(['status' => true, 'message' => 'Assign car successfully'], 200);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => true, 'message' => 'Something Was Wrong'], 200);
        }
    }

    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * Available Car
     * @created 21-05-24
     * 
     * @return |\Illuminate\Http\Response
     */
    public function availableDriver()
    {
        $ongoingTripIds = Trip::where('status', 'Accepted')->whereNotNull('driver_with_car_id')->whereNull('stop_trip')->pluck('driver_with_car_id')->toArray();
        $driver = DriverWithCar::with('user', 'car')->whereNotIn('id', $ongoingTripIds)->paginate(5);

        $responseData['Available_Driver'] = $driver->map(function ($item) {
            return [
                'car_id' => $item->id,
                'name' => $item->user?->name ?? 'None',
                'car_name' => $item->car?->name ?? 'None',
            ];
        });

        return response()->json(['status' => true, 'message' => '', 'records' => $responseData], 200);
    }
}
