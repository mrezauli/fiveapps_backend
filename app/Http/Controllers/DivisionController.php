<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function index()
    {
        $divisions = Division::orderByDesc('id')->get();
        return view('regions.division.index', get_defined_vars());
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'name_en' => 'required',
                'name_bn' => 'required',
            ]);

            $division = new Division();
            $division->name = $request->name_en;
            $division->bn_name = $request->name_bn;

            if ($division->save()) {
                return redirect()->route('regions.division.index')->with('success', 'Division created successfully');
            }

            return redirect()->back()->with('error', 'Failed to create division');
        } else {
            return view('regions.division.create');
        }
    }

    public function edit(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'name_en' => 'required',
                'name_bn' => 'required',
            ]);

            $division = Division::find($id);
            $division->name = $request->name_en;
            $division->bn_name = $request->name_bn;
            if ($division->save()) {
                return redirect()->back()->with('success', 'Division updated successfully');
            }

            return redirect()->back()->with('error', 'Failed to update division');
        } else {
            $division = Division::find($id);
            if ($division) {
                return view('regions.division.edit', get_defined_vars());
            }
            return redirect()->route('regions.division.index')->with('error', 'Division not found');
        }
    }

    public function delete($id)
    {
        $division = Division::find($id);
        if ($division->delete()) {
            return redirect()->route('regions.division.index')->with('success', 'Division deleted successfully');
        }

        return redirect()->route('regions.division.index')->with('error', 'Something went wrong');
    }
}