<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Division;
use Illuminate\Http\Request;

use function Pest\Laravel\get;

class DistrictController extends Controller
{
    public function index()
    {
        $districts = District::orderByDesc('id')->get();
        return view('regions.district.index', get_defined_vars());
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'name_en' => 'required',
                'name_bn' => 'required',
                'division_id' => 'required'
            ]);

            $district = new District();

            $district->name = $request->name_en;
            $district->bn_name = $request->name_bn;
            $district->division_id = $request->division_id;

            if ($district->save()) {
                return redirect()->route('regions.district.index')->with('success', 'District created successfully');
            }

            return redirect()->back()->with('error', 'Something went wrong');
        } else {
            $divisions = Division::all();
            return view('regions.district.create', get_defined_vars());
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

            $district = District::find($id);
            $district->name = $request->name_en;
            $district->bn_name = $request->name_bn;
            $district->division_id = $request->division_id;

            if ($district->save()) {
                return redirect()->back()->with('success', 'District updated successfully');
            }

            return redirect()->back()->with('error', 'Something went wrong');
        } else {
            $district = District::find($id);
            if ($district) {
                $divisions = Division::all();
                return view('regions.district.edit', get_defined_vars());
            }
            return redirect()->route('regions.district.index')->with('error', 'District not found');
        }
    }

    public function delete($id)
    {
        $district = District::find($id);
        if ($district->delete()) {
            return redirect()->route('regions.district.index')->with('success', 'District deleted successfully');
        }

        return redirect()->route('regions.district.index')->with('error', 'Something went wrong');
    }
}