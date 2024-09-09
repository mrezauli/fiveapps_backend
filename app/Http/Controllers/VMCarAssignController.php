<?php

namespace App\Http\Controllers;

use App\Models\DriverWithCar;
use App\Models\User;
use App\Models\VmCarInfo;
use Exception;
use Illuminate\Http\Request;

class VMCarAssignController extends Controller
{
    public function index()
    {
        $cars = DriverWithCar::with('user', 'car')->orderByDesc('id')->get();
        return view('vm.car_assign.index', compact('cars'));
    }

    public function create()
    {
        $userId = DriverWithCar::pluck('user_id')->toArray();
        $carId = DriverWithCar::pluck('vm_car_info_id')->toArray();

        $data['drivers'] = User::where('user_type', 'vlm_driver')->whereNotIn('id', $userId)->get();
        $data['cars'] = VmCarInfo::whereNotIn('id', $carId)->get();

        return view('vm.car_assign.create', $data);
    }

    public function store(Request $request)
    {

        $validates = $request->validate([
            'car' => 'required|',
            'driver' => 'required|',
        ]);

        try {
            if ($request->has('id')) {
                $book = DriverWithCar::find($request->id);
            } else {
                $book = new DriverWithCar();
            }

            $book->vm_car_info_id = $request->car;
            $book->user_id = $request->driver;
            if ($book->save()) {
                if ($request->has('id')) {
                    return redirect()->route('vm.cars.assign.index')->with('success', 'Car information updated Successfully');
                }
                return redirect()->route('vm.cars.assign.index')->with('success', 'Car information added Successfully');
            } else {
                return redirect()->back()->withInput()->with('error', 'Car information add Failed');
            }
        } catch (Exception $e) {

            return redirect()->back()->withInput()->with('error', 'Car information add Failed');
        }
    }


    public function edit($id)
    {
        $userId = DriverWithCar::pluck('user_id')->toArray();
        $carId = DriverWithCar::pluck('vm_car_info_id')->toArray();

        $data['drivers'] = User::where('user_type', 'vlm_driver')->whereNotIn('id', $userId)->get();
        $data['cars'] = VmCarInfo::whereNotIn('id', $carId)->get();

        $data['assignInfo'] = DriverWithCar::findOrFail($id);
        return view('vm.car_assign.edit', $data);
    }

    public function delete($id)
    {
        $car = DriverWithCar::findOrFail($id);
        if ($car->delete()) {
            return redirect()->route('vm.cars.assign.index')->with('success', 'Car information deleted successfully');
        }
        return redirect()->route('vm.cars.assign.index')->with('error', 'Something went wrong');
    }
}