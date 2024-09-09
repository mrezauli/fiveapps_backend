<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\IspConnection;
use App\Models\NTTN;
use App\Models\User;
use App\Notifications\AllNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class ISPController extends Controller
{
    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * Store ISP Connection
     * @created 06-04-24
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function newConnection(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'request_type' => 'required',
            'division' => 'required',
            'district' => 'required',
            'upazila' => 'required',
            'union' => 'required',
            'nttn_provider' => 'required',
            'link_capacity' => 'required',
            'remark' => 'required|string|max:244',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => 'Validation Error', 'errors' => $validator->errors()], 422);
        }

        $exist = IspConnection::where([
            'division_id' => $request->division,
            'district_id' => $request->district,
            'upazila_id' => $request->upazila,
            'union_id' => $request->union,
            'nttn_provider' => $request->nttn_provider,
        ])->exists();

        try {
            // if ($request->request_type === "New Connection") {
            //     if ($exist) {
            //         return response()->json(['status' => true, 'message' => 'Connection Request Already Exist'], 200);
            //     } else {
            //         $notify_message = 'New connection request!';
            //         IspConnection::updateOrCreate([
            //             'division_id' => $request->division,
            //             'district_id' => $request->district,
            //             'upazila_id' => $request->upazila,
            //             'union_id' => $request->union,
            //             'nttn_provider' => $request->nttn_provider,
            //             'user_id' => auth()->user()->id,
            //             'request_type' => 'New Connection',
            //             'link_capacity' => $request->link_capacity,
            //             'remark' => $request->remark,
            //             'status' => 'Pending',
            //         ]);
            //     }
            // } else {
            //     if ($exist) {
            //         $notify_message = 'Update connection request!';
            //         IspConnection::updateOrCreate([
            //             'division_id' => $request->division,
            //             'district_id' => $request->district,
            //             'upazila_id' => $request->upazila,
            //             'union_id' => $request->union,
            //             'nttn_provider' => $request->nttn_provider,
            //         ], [
            //             'user_id' => auth()->user()->id,
            //             'request_type' => $request->request_type,
            //             'link_capacity' => $request->link_capacity,
            //             'remark' => $request->remark,
            //             'status' => 'Pending',
            //         ]);
            //     } else {
            //         return response()->json(['status' => true, 'message' => 'Please at first request a connection request'], 200);
            //     }
            // }
            $notify_message = 'New connection request!';
            IspConnection::updateOrCreate([
                'division_id' => $request->division,
                'district_id' => $request->district,
                'upazila_id' => $request->upazila,
                'union_id' => $request->union,
                'nttn_provider' => $request->nttn_provider,
                'user_id' => auth()->user()->id,
                'request_type' => 'New Connection',
                'link_capacity' => $request->link_capacity,
                'remark' => $request->remark,
                'status' => 'Pending',
            ]);
            $provider = NTTN::find($request->nttn_provider);
            $userType = $provider?->nttn_providerId == 2 ? 'nttn_sbl_staff' : 'nttn_adsl_staff';
            $users = User::whereIn('user_type', [$userType, 'bcc_staff'])->where('active', 1)->get();
            Notification::send($users, new AllNotification($notify_message));
            return response()->json(['status' => true, 'message' => 'Connection Request Submitted'], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Something was error'], 500);
        }
    }


    public function updateConnection(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'request_type' => 'required',
            'link_capacity' => 'required',
            'remark' => 'required|string|max:244',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => 'Validation Error', 'errors' => $validator->errors()], 422);
        }

        try {
            $connection = IspConnection::find($request->id);
            if ($connection) {
                $connection->update([
                    'request_type' => $request->request_type,
                    'link_capacity' => $request->link_capacity,
                    'remark' => $request->remark,
                ]);
                return response()->json(['status' => true, 'message' => 'Connection Updated Successfully'], 200);
            } else {
                return response()->json(['status' => false, 'message' => 'Connection does not exist'], 200);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Something was error'], 500);
        }
    }


    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * Store ISP Connection
     * @created 24-04-24
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function nttnConnection(Request $request)
    {
        $userType = auth()->user()->user_type;
        // if ($userType === 'isp_staff') {
        $data = IspConnection::with('nttnProvider', 'division', 'district', 'upazila', 'union')->select('id', 'request_type', 'nttn_provider', 'district_id', 'division_id', 'upazila_id', 'union_id', 'status')->get();
        $responseData = [];
        foreach ($data as $key => $value) {
            if ($value->status == 'Pending') {
                $responseData['Pending'][] = [
                    'connection_type' => ucfirst($value->request_type),
                    'provider' => $value->nttnProvider->nttn,
                    'application_id' => $value->id,
                    'phone' => $value->nttnProvider?->phone,
                    'location' => $value->division?->name . ", " . $value->district?->name . ", " . $value->upazila?->name . ", " . $value->union?->name,
                ];
            } else {
                $responseData['Accepted'][] = [
                    'connection_type' => ucfirst($value->request_type),
                    'provider' => $value->nttnProvider->nttn,
                    'application_id' => $value->id,
                    'phone' => $value->nttnProvider?->phone,
                    'location' => $value->division?->name . ", " . $value->district?->name . ", " . $value->upazila?->name . ", " . $value->union?->name,
                ];
            }
        }
        // }

        return response()->json(['status' => true, 'message' => '', 'records' => $responseData], 200);

    }

    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * Store ISP Connection
     * @created 24-04-24
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function filterNttnConnection(Request $request)
    {
        $data = IspConnection::query()->where('status', 'Accepted');
        $division = $request->filled('division_id');
        $district = $request->filled('district_id');
        $upazila = $request->filled('upazila_id');
        $union = $request->filled('union_id');
        if ($division) {
            $data = $data->where('division_id', $request->division_id);
        }
        if ($district) {
            $data = $data->where('district_id', $request->district_id);
        }
        if ($upazila) {
            $data = $data->where('upazila_id', $request->upazila_id);
        }
        if ($union) {
            $data = $data->where('union_id', $request->union_id);
        }
        $ispConnections = $data->get();
        $responseData = [];
        foreach ($ispConnections as $key => $value) {
            $responseData[] = [
                'name' => $value->user?->name,
                'organization' => $value->user?->organization,
                'mobile' => $value->user?->phone,
                'connection_type' => ucfirst($value->request_type),
                'provider' => $value->nttnProvider?->provider?->name,
                'status' => $value->status
            ];
        }

        return response()->json(['status' => true, 'message' => '', 'records' => $responseData], 200);

    }

    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * Store ISP Connection
     * @created 24-04-24
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function acceptOrReject(Request $request)
    {
        $decision = $request->input('type');
        $ispConnection = IspConnection::find($request->isp_connection_id);
        try {
            if (in_array($decision, ['accepted', 'rejected']) && $ispConnection) {
                $notify_message = $decision === 'accepted' ? 'Connection request accepted' : 'Connection request rejected';
                $ispConnection->update(['status' => ucfirst($decision)]);

                $users = User::where('id', $ispConnection->user_id)->orWhere('user_type', 'bcc_staff')->get();
                Notification::send($users, new AllNotification($notify_message));

                return response()->json(['status' => true, 'message' => 'ISP Connection Updated Successfully', 'records' => []], 200);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => true, 'message' => 'Something Was Wrong', 'records' => []], 200);
        }
    }


    public function getBCCConnections($uid)
    {
        try {
            $ispConnections = IspConnection::where('user_id', $uid)->where('status', 'Accepted')->with('nttnProvider', 'division', 'district', 'upazila', 'union')->get();

            $connections = [];
            foreach ($ispConnections as $ispConnection) {
                $connections[] = [
                    'id' => $ispConnection->id,
                    'user_id' => $ispConnection->user_id,
                    'request_type' => $ispConnection->request_type,
                    'link_capacity' => $ispConnection->link_capacity,
                    'division' => $ispConnection->division->name,
                    'district' => $ispConnection->district->name,
                    'upazila' => $ispConnection->upazila?->name,
                    'union' => $ispConnection->union?->name,
                    'nttn_provider' => $ispConnection->nttnProvider?->provider?->name,
                    'status' => $ispConnection->status,
                    'remark' => $ispConnection->remark,
                ];
            }
            return response()->json(['status' => true, 'message' => 'ISP Connections listing', 'records' => $connections], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => true, 'message' => 'Something Was Wrong', 'records' => []], 200);
        }
    }
}