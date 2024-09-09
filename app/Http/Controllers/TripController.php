<?php

namespace App\Http\Controllers;

use App\Models\DriverWithCar;
use App\Models\Trip;
use App\Models\User;
use App\Notifications\AllNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class TripController extends Controller
{
    public function index()
    {
        $trips = Trip::select('id', 'name', 'driver_with_car_id', 'destination_from', 'destination_to', 'date', 'start_time', 'end_time', 'approx_distance', 'status')->orderByDesc('id')->get();
        return view('vm.trip.index', compact('trips'));
    }

    public function view($id)
    {
        $trip = Trip::find($id);
        $ongoingTripIds = Trip::where('status', 'Accepted')->whereNotNull('driver_with_car_id')->whereNull('stop_trip')->pluck('driver_with_car_id')->toArray();
        $driver = DriverWithCar::with('user', 'car')->whereNotIn('id', $ongoingTripIds)->get();
        return view('vm.trip.view', compact('trip', 'driver'));
    }

    public function approve($id)
    {
        $trip = Trip::where('status', 'Pending')->where('id', $id)->first();
        try {
            if ($trip) {
                $trip->update(['status' => 'Accepted']);
                return back()->with('success', 'Approve this trip');
            } else {
                return back()->with('warning', 'This trip is ongoing or finished');
            }
        } catch (\Throwable $th) {
            return back()->with('error', 'Something is wrong');

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
        $request->validate([
            'trip_id'   => 'required',
            'car_id'   => 'required',
        ]);

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

                return back()->with('success', 'Car Assign in this trip');
            }
        } catch (\Throwable $th) {
            return back()->with('error', 'Something is error');

        }
    }
}
