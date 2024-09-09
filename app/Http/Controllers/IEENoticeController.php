<?php

namespace App\Http\Controllers;

use App\Helper\RedirectHelper;
use App\Models\IteeNotice;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class IEENoticeController extends Controller
{
    public function index()
    {
        $items = IteeNotice::orderByDesc('id')->get();
        return view('itee.notice.index', get_defined_vars());
    }

    public function create()
    {
        $items = IteeNotice::orderByDesc('id')->get();
        $block = false;
        if ($items->count() > 2) {
            $block = true;
        }
        return view('itee.notice.create', compact('block'));
    }

    public function edit($id)
    {
        $item = IteeNotice::findOrFail($id);

        return view('itee.notice.edit', get_defined_vars());
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
        if(IteeNotice::orderByDesc('id')->count() > 2) {
            return redirect()->route('itee.notice.index')->with('error', 'You can not add more than 3 notice.');
        }
        $message = 'ITEE Notice successfully ';
        if ($request->has('id')) {
            $iteeNotice = IteeNotice::find($request->id);
            $rules['notice'] = 'required';
            $rules['status'] = 'required';
            $message = $message . ' updated';
        } else {
            $iteeNotice = new IteeNotice();
            $rules['notice'] = 'required';
            $rules['status'] = 'required';
            $message = $message . ' created';
        }
        $request->validate($rules);

        try {
            $iteeNotice->notice = $request->notice;
            $iteeNotice->status = $request->status;

            if ($iteeNotice->save()) {

                return redirect()->route('itee.notice.index')->with('success', $message);
            }
            return RedirectHelper::backWithInput();
        } catch (QueryException $e) {

            return RedirectHelper::backWithInputFromException();
        }

    }

    public function delete($id)
    {
        $iteeNotice = IteeNotice::find($id);
        if ($iteeNotice) {
            if ($iteeNotice->delete()) {
                return redirect()->route('itee.notice.index')->with('success', 'Itee Notice deleted successfully');
            }
        }
        return redirect()->route('itee.notice.index')->with('error', 'Something went wrong');
    }
}