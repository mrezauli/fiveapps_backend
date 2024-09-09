<?php

namespace App\Http\Controllers;

use App\Models\BkiictCenter;
use Exception;
use Illuminate\Http\Request;

class BKIICTCenterController extends Controller
{
    public function index()
    {
        $centers = BkiictCenter::orderByDesc('id')->get();
        return view('bkiict.center.index', get_defined_vars());
    }

    public function create()
    {
        return view('bkiict.center.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'center_name' => 'required',
            'status' => 'required',
        ]);

        try {
            if ($request->has('id')) {
                $center = BkiictCenter::findOrFail($request->id);
                $center->name = $request->center_name;
                $center->status = $request->status;
                $center->save();
                return redirect()->back()->with('success', 'Center updated successfully.');
            }
            BkiictCenter::create([
                'name' => $request->center_name,
                'status' => $request->status,
            ]);
            return redirect()->route('bkiict.center.index')->with('success', 'Center created successfully.');
        } catch (Exception $e) {
            return redirect()->route('bkiict.center.create')->with('error', 'Something happened wrong, please try again later.');
        }
    }

    // ? public function view()
    // ? {

    // ?     return view('bkiict.center.view');
    // ? }

    public function edit($id)
    {
        try {
            $center = BkiictCenter::findOrFail($id);
            return view('bkiict.center.edit', get_defined_vars());
        } catch (Exception $e) {
            return redirect()->route('bkiict.center.index')->with('error', 'Center not found');
        }
    }


    public function delete($id)
    {
        try {
            $center = BkiictCenter::findOrFail($id);
            $center->delete();
            return redirect()->route('bkiict.center.index')->with('success', 'Center deleted successfully');
        } catch (Exception $e) {
            return redirect()->route('bkiict.center.index')->with('error', 'Center not found');
        }
    }
}