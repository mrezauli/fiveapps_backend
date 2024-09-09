<?php

namespace App\Http\Controllers;

use App\Helper\CustomHelper;
use App\Models\District;
use App\Models\Division;
use App\Models\NTTN;
use App\Models\NttnProvider;
use App\Models\Union;
use App\Models\Upazila;
use Illuminate\Http\Request;

class NTTNDataController extends Controller
{
    public function index()
    {
        if (request()->has('search') && empty(trim(request()->search))) {
            return redirect()->route('nttn.index');
        }

        $nttnProviders = ['sbl' => 'SecureNet Bangladesh Limited', 'adsl' => 'Advanced Digital Solution Limited'];
        if (request()->has('nttn')) {
            $nttnProvider = NttnProvider::where('slug', request('nttn'))->first();
            if ($nttnProvider) {
                if (CustomHelper::userRoleName(auth()->user()) == 'Super Admin' || auth()->user()->user_type == 'bcc_staff') {
                    $nttns = NTTN::where('nttn_providerId', $nttnProvider->id)->orderByDesc('id')->get();
                } else {
                    return redirect()->route('nttn.index')->with('error', 'Invalid NTTN Provider');
                }
            } else {
                return redirect()->route('nttn.index')->with('error', 'Invalid NTTN Provider');
            }
        } else {
            if (CustomHelper::userRoleName(auth()->user()) == 'Super Admin' || auth()->user()->user_type == 'bcc_staff') {
                $nttns = NTTN::orderByDesc('id')->get();
            } else {
                $nttns = NTTN::where('nttn_providerId', getNttnProvider(auth()->user())->id)->orderByDesc('id')->get();
            }
        }

        $nttn_adsl = NttnProvider::where('slug', 'adsl')->first();
        $nttn_sbl = NttnProvider::where('slug', 'sbl')->first();
        $adsl_count = NTTN::where('nttn_providerId', $nttn_adsl->id)->count();
        $sbl_count = NTTN::where('nttn_providerId', $nttn_sbl->id)->count();

        // dd(count($nttns));
        return view('nttn_data.index', get_defined_vars());
    }

    public function records($type)
    {
        if ($type) {
            $nttnProvider = NttnProvider::where('slug', request('nttn'))->first();
            if ($nttnProvider) {
                if (CustomHelper::userRoleName(auth()->user()) == 'Super Admin' || auth()->user()->user_type == 'bcc_staff') {
                    $nttns = NTTN::where('nttn_providerId', $nttnProvider->id)->orderByDesc('id')->get();
                } else {
                    return redirect()->route('nttn.index')->with('error', 'Invalid NTTN Provider');
                }
            } else {
                return redirect()->route('nttn.index')->with('error', 'Invalid NTTN Provider');
            }
        } else {
            if (CustomHelper::userRoleName(auth()->user()) == 'Super Admin' || auth()->user()->user_type == 'bcc_staff') {
                $nttns = NTTN::orderByDesc('id')->get();
            } else {
                $nttns = NTTN::where('nttn_providerId', getNttnProvider(auth()->user())->id)->orderByDesc('id')->get();
            }
        }

        return $nttns;
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'division_id' => 'required',
                'district_id' => 'required',
                'upazila_id' => 'required',
                'union_id' => 'required',
                'phone' => 'required',
                'pop_location' => 'required',
                'pop_location_type' => 'required',
            ]);

            $nttn = new NTTN();
            $nttn->union_id = $request->union_id;
            $nttn->phone = $request->phone;
            if ($request->has('nttn_id')) {
                $nttn->nttn_providerId = $request->nttn_id;
            } else {
                $nttn->nttn_providerId = getNttnProvider(auth()->user())->id;
            }
            $nttn->pop_location = $request->pop_location;
            $nttn->pop_location_type = $request->pop_location_type;

            if ($nttn->save()) {
                return redirect()->route('nttn.index')->with('success', 'NTTN data created successfully');
            }

            return redirect()->back()->with('error', 'Something went wrong');
        } else {
            $divisions = Division::all();
            $districts = District::get(['id', 'name', 'division_id']);
            $upazilas = Upazila::get(['id', 'name', 'district_id']);
            $unions = Union::get(['id', 'name', 'upazila_id']);
            // $providers = NttnProvider::select('id', 'name')->get();

            return view('nttn_data.create', get_defined_vars());
        }
    }

    public function edit(Request $request, $id)
    {

        if ($request->isMethod('post')) {
            $request->validate([
                'division_id' => 'required',
                'phone' => 'required',
                'pop_location' => 'required',
                'pop_location_type' => 'required',
            ]);

            $nttn = NTTN::find($id);
            $nttn->phone = $request->phone;
            if ($request->has('nttn_id')) {
                $nttn->nttn_providerId = $request->nttn_id;
            } else {
                $nttn->nttn_providerId = getNttnProvider(auth()->user())->id;
            }
            $nttn->pop_location = $request->pop_location;
            $nttn->pop_location_type = $request->pop_location_type;
            if ($request->district_id != null && $request->upazila_id != null && $request->union_id != null) {
                $nttn->union_id = $request->union_id;
            }

            if ($nttn->save()) {
                return redirect()->route('nttn.view', $id)->with('success', 'NTTN data updated successfully');
            }

            return redirect()->back()->with('error', 'Something went wrong');
        } else {
            $nttn = NTTN::find($id);

            if ($nttn) {
                $divisions = Division::all();
                $districts = District::get(['id', 'name', 'division_id']);
                $upazilas = Upazila::get(['id', 'name', 'district_id']);
                $unions = Union::get(['id', 'name', 'upazila_id']);
                // $providers = NttnProvider::select('id', 'name')->get();

                return view('nttn_data.edit', get_defined_vars());
            }

            return redirect()->route('nttn.index')->with('error', 'NTTN data not found');
        }
    }

    public function view($id)
    {
        $nttn = NTTN::find($id);

        if ($nttn) {
            return view('nttn_data.view', get_defined_vars());
        }

        return redirect()->route('nttn.index')->with('error', 'NTTN data not found');
    }

    public function delete($id)
    {
        $nttn = NTTN::find($id);
        if ($nttn->delete()) {
            return redirect()->route('nttn.index')->with('success', 'NTTN deleted successfully');
        }

        return redirect()->route('nttn.index')->with('error', 'Something went wrong');
    }
}