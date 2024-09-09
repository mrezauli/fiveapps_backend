<?php

namespace App\Http\Controllers;

use App\Helper\CustomHelper;
use App\Models\IteeRecentEvents;
use Exception;
use Illuminate\Http\Request;

class IteeRecentEventsController extends Controller
{
    public function index()
    {
        $events = IteeRecentEvents::orderBy('id', 'desc')->get();
        return view('itee.recent-events.index', compact('events'));
    }

    public function create()
    {
        return view('itee.recent-events.create');
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
                $bjetEvent = IteeRecentEvents::find($request->id);
                $oldImage = $bjetEvent->image;
            } else {
                $bjetEvent = new IteeRecentEvents();
            }

            $image = null;
            if ($request->file('image')) {
                $image = CustomHelper::storeImage($request->file('image'), '/itee/recent-events/');
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
                return redirect()->route('itee.recent-events.index')->with('success', 'Event saved successfully');
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
            $event = IteeRecentEvents::findOrFail($id);
            return view('itee.recent-events.view', compact('event'));
        } catch (Exception $e) {
            return redirect()->route('itee.recent-events.index')->with('error', 'Something went wrong');
        }
    }

    public function edit($id)
    {
        try {
            $event = IteeRecentEvents::findOrFail($id);
            return view('itee.recent-events.edit', compact('event'));
        } catch (Exception $e) {
            return redirect()->route('itee.recent-events.index')->with('error', 'Something went wrong');
        }
    }

    public function delete($id)
    {
        try {
            $event = IteeRecentEvents::findOrFail($id);

            if (!is_null($event->image)) {
                CustomHelper::deleteFile($event->image);
            }
            if ($event->delete()) {
                return redirect()->route('itee.recent-events.index')->with('success', 'Event deleted successfully');
            } else {
                return redirect()->route('itee.recent-events.index')->with('error', 'Failed to delete event');
            }
        } catch (Exception $e) {
            return redirect()->route('itee.recent-events.index')->with('error', 'Something went wrong');
        }
    }
}
