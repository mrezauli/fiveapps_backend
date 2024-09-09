<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Division;
use App\Models\Union;
use App\Models\Upazila;
use Illuminate\Http\Request;

class UpazilaController extends Controller
{
    public function index()
    {
        $upazilas = Upazila::orderByDesc('id')->get();
        return view('regions.upazila.index', get_defined_vars());
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'name_en' => 'required',
                'name_bn' => 'required',
                'division_id' => 'required',
                'district_id' => 'required'
            ]);

            $upazila = new Upazila();

            $upazila->name = $request->name_en;
            $upazila->bn_name = $request->name_bn;
            $upazila->district_id = $request->district_id;

            if ($upazila->save()) {
                return redirect()->route('regions.upazila.index')->with('success', 'Upazila created successfully');
            }

            return redirect()->back()->with('error', 'Upazila not created');
        } else {
            $divisions = Division::all();
            $districts = District::get(['id', 'name', 'division_id']);

            return view('regions.upazila.create', get_defined_vars());
        }
    }

    public function edit(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'name_en' => 'required',
                'name_bn' => 'required',
                'division_id' => 'required',
            ]);

            $upazila = Upazila::find($id);
            $upazila->name = $request->name_en;
            $upazila->bn_name = $request->name_bn;
            if ($request->district_id != null)
                $upazila->district_id = $request->district_id;

            if ($upazila->save()) {
                return redirect()->back()->with('success', 'Upazila updated successfully');
            }

            return redirect()->back()->with('error', 'Upazila not updated');
        } else {
            $upazila = Upazila::find($id);
            if ($upazila) {
                $divisions = Division::all();
                $districts = District::get(['id', 'name', 'division_id']);

                return view('regions.upazila.edit', get_defined_vars());
            }

            return redirect()->route('regions.upazila.index')->with('error', 'Upazila not found');
        }
    }

    public function delete($id)
    {
        $upazila = Upazila::find($id);
        if ($upazila->delete()) {
            return redirect()->route('regions.upazila.index')->with('success', 'Upazila deleted successfully');
        }

        return redirect()->route('regions.upazila.index')->with('error', 'Something went wrong');
    }
}