<?php

namespace App\Http\Controllers;

use App\Models\VmCarInfo;
use Exception;
use Illuminate\Http\Request;

class VMCarController extends Controller
{
    public function index()
    {
        $cars = VmCarInfo::orderByDesc('id')->get();
        return view('vm.car_info.index', compact('cars'));
    }

    public function create()
    {
        return view('vm.car_info.create');
    }

    public function store(Request $request)
    {
        $validates = $request->validate([
            'car_name' => 'required|min:5',
            'model_number' => 'required|min:5',
            'vehicle_number' => 'required|min:5',
            'status' => 'required|in:1,0',
        ]);

        try {
            if ($request->has('id')) {
                $book = VmCarInfo::find($request->id);
            } else {
                $book = new VmCarInfo();
            }

            $book->name = $request->car_name;
            $book->model_number = $request->model_number;
            $book->vehicle_number = $request->vehicle_number;
            $book->status = $request->status;
            if ($book->save()) {
                if ($request->has('id')) {
                    return redirect()->route('vm.cars.index')->with('success', 'Car information updated Successfully');
                }
                return redirect()->route('vm.cars.index')->with('success', 'Car information added Successfully');
            } else {
                return redirect()->back()->withInput()->with('error', 'Car information add Failed');
            }
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Car information add Failed');
        }
    }

    public function view($id)
    {
        $car = VmCarInfo::findOrFail($id);
        return view('vm.car_info.view', compact('car'));
    }

    public function edit($id)
    {
        $car = VmCarInfo::findOrFail($id);
        return view('vm.car_info.edit', compact('car'));
    }

    public function delete($id)
    {
        $car = VmCarInfo::findOrFail($id);
        if ($car->delete()) {
            return redirect()->route('vm.cars.index')->with('success', 'Car information deleted successfully');
        }
        return redirect()->route('vm.cars.index')->with('error', 'Something went wrong');
    }
}