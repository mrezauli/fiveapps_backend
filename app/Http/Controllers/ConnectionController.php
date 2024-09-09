<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Division;
use App\Models\IspConnection;
use App\Models\NTTN;
use App\Models\NttnProvider;
use App\Models\Union;
use App\Models\Upazila;
use App\Models\User;
use Illuminate\Http\Request;

use function Pest\Laravel\get;

class ConnectionController extends Controller
{
    public function index()
    {
        $filters = ['Accepted', 'Pending', 'Rejected'];
        $nttnProvider = null;

        if (request('nttn')) {
            $nttnProvider = NttnProvider::where('slug', request('nttn'))->first();
            if ($nttnProvider) {
                $connections = IspConnection::orderByDesc('created_at')->get()->map(function ($connection) use ($nttnProvider) {
                    if ($connection->nttnProvider->nttn_providerId == $nttnProvider->id) {
                        return $connection;
                    }
                })->filter();
            } else {
                return redirect()->route('isp_connection.index')->with('error', 'Invalid NTTN Provider');
            }
        } else if (request('filter') && in_array(ucfirst(request('filter')), $filters)) {
            $connections = IspConnection::where('status', ucfirst(request('filter')))->orderByDesc('created_at')->get();
        } else {
            $connections = IspConnection::orderByDesc('created_at')->get();
        }
        if ($nttnProvider) {
            $pending_count = IspConnection::where('status', 'Pending')->get()->map(function ($conns) use ($nttnProvider) {
                if ($nttnProvider->id == $conns->nttnProvider->nttn_providerId) {
                    return $conns;
                }
            })->filter()->count();
            $accepted_count = IspConnection::where('status', 'Accepted')->get()->map(function ($conns) use ($nttnProvider) {
                if ($nttnProvider->id == $conns->nttnProvider->nttn_providerId) {
                    return $conns;
                }
            })->filter()->count();
            $rejected_count = IspConnection::where('status', 'Rejected')->get()->map(function ($conns) use ($nttnProvider) {
                if ($nttnProvider->id == $conns->nttnProvider->nttn_providerId) {
                    return $conns;
                }
            })->filter()->count();
        } else {
            $pending_count = IspConnection::where('status', 'Pending')->count();
            $accepted_count = IspConnection::where('status', 'Accepted')->count();
            $rejected_count = IspConnection::where('status', 'Rejected')->count();
        }
        $adslNTTN = NttnProvider::where('slug', 'adsl')->first();
        $adsl_count = IspConnection::orderByDesc('created_at')->get()->map(function ($adslConnections) use ($adslNTTN) {
            if ($adslConnections->nttnProvider->nttn_providerId == $adslNTTN->id) {
                return $adslConnections;
            }
        })->filter()->count();
        $sblNTTN = NttnProvider::where('slug', 'sbl')->first();
        $sbl_count = IspConnection::orderByDesc('created_at')->get()->map(function ($sblConnection) use ($sblNTTN) {
            if ($sblConnection->nttnProvider->nttn_providerId == $sblNTTN->id) {
                return $sblConnection;
            }
        })->filter()->count();

        return view('isp_connections.index', get_defined_vars());
    }

    public function view($id)
    {
        $connection = IspConnection::findOrFail($id);
        return view('isp_connections.view', get_defined_vars());
    }

    public function approve($id)
    {
        $connection = IspConnection::findOrFail($id);
        $connection->status = 'Accepted';
        $connection->save();
        return redirect()->route('isp_connection.view', $id)->with('success', 'Connection approved successfully');
    }

    public function reject($id)
    {
        $connection = IspConnection::findOrFail($id);
        $connection->status = 'Rejected';
        $connection->save();
        return redirect()->route('isp_connection.view', $id)->with('success', 'Connection rejected successfully');
    }

    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * Search ISP Connection
     * @created 06-04-24
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function search(Request $request)
    {
        $divisions = Division::all();
        $districts = District::get(['id', 'name', 'division_id']);
        $upazilas = Upazila::get(['id', 'name', 'district_id']);
        $unions = Union::get(['id', 'name', 'upazila_id']);
        // $nttns = NTTN::get(['union_id', 'nttn_providerId']);

        $connection = IspConnection::query();
        $division = $request->get('division_id');
        $district = $request->get('district_id');
        $upazila = $request->get('upazila_id');
        $union = $request->get('union_id');
        $provider = $request->get('provider_id');

        if ($division) {
            $connection->where('division_id', $division);
        }
        if ($district) {
            $connection->where('district_id', $district);
        }
        if ($upazila) {
            $connection->where('upazila_id', $upazila);
        }
        if ($union) {
            $connection->where('union_id', $union);
        }
        if ($provider) {
            $connection->where('nttn_provider', $provider);
        }

        $connections = $connection->orderByDesc('created_at')->get();

        return view('isp_connections.search', get_defined_vars());
    }
}