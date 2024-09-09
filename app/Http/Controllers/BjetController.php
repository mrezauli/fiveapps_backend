<?php

namespace App\Http\Controllers;

use App\Helper\CustomHelper;
use App\Models\IteeBjetEvent;
use App\Models\User;
use App\Notifications\AllNotification;
use Exception;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;

class BjetController extends Controller
{
    public function index()
    {
        $events = IteeBjetEvent::orderBy('id', 'desc')->get();
        return view('itee.bjet.index', compact('events'));
    }

    public function create()
    {
        return view('itee.bjet.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required',
            'image' => ($request->has('id') ? 'nullable' : 'required') . '|image|mimes:jpg,jpeg,png,gif|max:2048',
            'description' => 'nullable',
            'status' => 'required|in:1,0',
        ]);

        $notify_message = "Events has been updated";
        try {
            $oldImage = null;
            if ($request->has('id')) {
                $bjetEvent = IteeBjetEvent::find($request->id);
                $oldImage = $bjetEvent->image;
            } else {
                $bjetEvent = new IteeBjetEvent();
            }

            $image = null;
            if ($request->file('image')) {
                $image = CustomHelper::storeImage($request->file('image'), '/itee/bjet/');
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
                return redirect()->route('itee.bjet.index')->with('success', 'Event saved successfully');
            } else {
                return redirect()->back()->withInput()->with('error', 'Failed to save event')->withInput();
            }
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Something went wrong')->withInput();
        }

    }

    public function view($id)
    {
        try {
            $event = IteeBjetEvent::findOrFail($id);
            return view('itee.bjet.view', compact('event'));
        } catch (Exception $e) {
            return redirect()->route('itee.bjet.index')->with('error', 'Something went wrong');
        }
    }

    public function edit($id)
    {
        try {
            $event = IteeBjetEvent::findOrFail($id);
            return view('itee.bjet.edit', compact('event'));
        } catch (Exception $e) {
            return redirect()->route('itee.bjet.index')->with('error', 'Something went wrong');
        }
    }

    public function delete($id)
    {
        try {
            $event = IteeBjetEvent::findOrFail($id);

            if (!is_null($event->image)) {
                CustomHelper::deleteFile($event->image);
            }
            if ($event->delete()) {
                return redirect()->route('itee.bjet.index')->with('success', 'Event deleted successfully');
            } else {
                return redirect()->route('itee.bjet.index')->with('error', 'Failed to delete event');
            }
        } catch (Exception $e) {
            return redirect()->route('itee.bjet.index')->with('error', 'Something went wrong');
        }
    }
}