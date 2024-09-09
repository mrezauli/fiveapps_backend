<?php

namespace App\Http\Controllers;

use App\Helper\CustomHelper;
use App\Helper\RedirectHelper;
use App\Models\IteeNotice;
use App\Models\IteeVenue;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class ITEEVenueController extends Controller
{
    public function index()
    {
        $items = IteeVenue::orderByDesc('id')->get();
        return view('itee.venue.index', get_defined_vars());
    }

    public function create()
    {
        return view('itee.venue.create');
    }

    public function edit($id)
    {
        $item = IteeVenue::findOrFail($id);

        return view('itee.venue.edit', get_defined_vars());
    }

    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * Login
     * @created 16-04-24
     * @param \Illuminate\Http\Request $request
     * @return
     */
    public function store(Request $request)
    {
        $message = 'ITEE Venue successfully ';
        if ($request->has('id')) {
            $iteeVenue= IteeVenue::find($request->id);
            $rules['name'] = 'required';
            $rules['address'] = 'required';
            $rules['image'] = 'nullable|image|mimes:png,jpg,jpeg|max:2048';
            $rules['status'] = 'required';
            $message = $message . ' updated';
        } else {
            $iteeVenue= new IteeVenue();
            $rules['name'] = 'required';
            $rules['address'] = 'required';
            $rules['image'] = 'required|image|mimes:png,jpg,jpeg|max:2048';
            $rules['status'] = 'required';
            $message = $message . ' created';
        }
        $request->validate($rules);

        try {
            $iteeVenue->name = $request->name;
            $iteeVenue->address = $request->address;
            $iteeVenue->status = $request->status;
            if($request->has('image')) {
                $photo = CustomHelper::storeImage($request->file('image'), '/itee/venue/');
            } else {
                $photo = $iteeVenue->photo;
            }

            $iteeVenue->photo = $photo;

            if ($iteeVenue->save()) {

                return redirect()->route('itee.venue.index')->with('success', $message);
            }
            return RedirectHelper::backWithInput();
        } catch (QueryException $e) {

            return RedirectHelper::backWithInputFromException();
        }

    }

    public function delete($id)
    {
        $iteeVenue = IteeVenue::find($id);
        if ($iteeVenue) {
            if ($iteeVenue->delete()) {
                return redirect()->route('itee.venue.index')->with('success', 'Itee Notice deleted successfully');
            }
        }
        return redirect()->route('itee.venue.index')->with('error', 'Something went wrong');
    }
}
