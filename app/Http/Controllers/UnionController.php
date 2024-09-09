<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Division;
use App\Models\Union;
use App\Models\Upazila;
use Illuminate\Http\Request;

class UnionController extends Controller
{
    public function index()
    {
        $unions = Union::orderByDesc('id')->get();
        return view('regions.union.index', get_defined_vars());
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'name_en' => 'required',
                'name_bn' => 'required',
                'division_id' => 'required',
                'district_id' => 'required',
                'upazila_id' => 'required',
            ]);

            $union = new Union();
            $union->name = $request->name_en;
            $union->bn_name = $request->name_bn;
            $union->upazila_id = $request->upazila_id;

            if ($union->save()) {
                return redirect()->route('regions.union.index')->with('success', 'Union created successfully');
            }

            return redirect()->back()->with('error', 'Something went wrong.');
        } else {
            $divisions = Division::all();
            $districts = District::get(['id', 'name', 'division_id']);
            $upazilas = Upazila::get(['id', 'name', 'district_id']);

            return view('regions.union.create', get_defined_vars());
        }
    }

    public function edit(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'name_en' => 'required',
                'name_bn' => 'required',
                'division_id' => 'required'
            ]);

            $union = Union::find($id);
            $union->name = $request->name_en;
            $union->bn_name = $request->name_bn;
            if ($request->upazila_id != null)
                $union->upazila_id = $request->upazila_id;

            if ($union->save()) {
                return redirect()->back()->with('success', 'Union updated successfully');
            }

            return redirect()->back()->with('error', 'Something went wrong');
        } else {
            $union = Union::find($id);

            if ($union) {
                $divisions = Division::all();
                $districts = District::get(['id', 'name', 'division_id']);
                $upazilas = Upazila::get(['id', 'name', 'district_id']);

                return view('regions.union.edit', get_defined_vars());
            }

            return redirect()->route('regions.union.index')->with('error', 'No union found');
        }
    }

    public function delete($id)
    {
        $union = Union::find($id);
        if ($union->delete()) {
            return redirect()->route('regions.union.index')->with('success', 'Union deleted successfully');
        }

        return redirect()->route('regions.union.index')->with('error', 'Something went wrong');
    }
}