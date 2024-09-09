<?php

namespace App\Http\Controllers;

use App\Helper\CustomHelper;
use App\Models\IteeProgram;
use Exception;
use Illuminate\Http\Request;

class IteeProgramsController extends Controller
{
    public function index()
    {
        $events = IteeProgram::orderBy('id', 'desc')->get();
        return view('itee.programs.index', compact('events'));
    }

    public function create()
    {
        return view('itee.programs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required',
            'image' => ($request->has('id') ? 'nullable' : 'required') . '|image|mimes:jpg,jpeg,png,gif|max:2048',
            'description' => 'nullable',
            'status' => 'required|in:1,0',
        ]);

        $notify_message = "Programs has been updated";
        try {
            $oldImage = null;
            if ($request->has('id')) {
                $bjetEvent = IteeProgram::find($request->id);
                $oldImage = $bjetEvent->image;
            } else {
                $bjetEvent = new IteeProgram();
            }

            $image = null;
            if ($request->file('image')) {
                $image = CustomHelper::storeImage($request->file('image'), '/itee/programs/');
                if (!is_null($oldImage)) {
                    CustomHelper::deleteFile($oldImage);
                }
            }

            $bjetEvent->label = $request->label;
            $bjetEvent->image = $image ?? $oldImage;
            $bjetEvent->description = $request->description;
            $bjetEvent->status = $request->status;

            if ($bjetEvent->save()) {
                // $users = User::where('id', $request->student_id)->get();
                // Notification::send($users, new AllNotification($notify_message));
                return redirect()->route('itee.programs.index')->with('success', 'Program saved successfully');
            } else {
                return redirect()->back()->withInput()->with('error', 'Failed to save program')->withInput();
            }
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Something went wrong')->withInput();
        }

    }

    public function view($id)
    {
        try {
            $program = IteeProgram::findOrFail($id);
            return view('itee.programs.view', compact('program'));
        } catch (Exception $e) {
            return redirect()->route('itee.programs.index')->with('error', 'Something went wrong');
        }
    }

    public function edit($id)
    {
        try {
            $program = IteeProgram::findOrFail($id);
            return view('itee.programs.edit', compact('program'));
        } catch (Exception $e) {
            return redirect()->route('itee.programs.index')->with('error', 'Something went wrong');
        }
    }

    public function delete($id)
    {
        try {
            $program = IteeProgram::findOrFail($id);

            if (!is_null($program->image)) {
                CustomHelper::deleteFile($program->image);
            }
            if ($program->delete()) {
                return redirect()->route('itee.programs.index')->with('success', 'Program deleted successfully');
            } else {
                return redirect()->route('itee.programs.index')->with('error', 'Failed to delete program');
            }
        } catch (Exception $e) {
            return redirect()->route('itee.programs.index')->with('error', 'Something went wrong');
        }
    }
}
