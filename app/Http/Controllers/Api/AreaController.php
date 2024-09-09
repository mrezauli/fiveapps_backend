<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NTTN;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AreaController extends Controller
{
    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * Get Division
     * @created 06-04-24
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function division()
    {
        $divisions = DB::table('divisions')->get();

        return response()->json(['status' => true, 'message' => '', 'records' => $divisions], 200);
    }

    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * Get District
     * @created 06-04-24
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function district($division_id)
    {
        $districts = DB::table('districts')->where('division_id', $division_id)->get();

        return response()->json(['status' => true, 'message' => '', 'records' => $districts], 200);
    }

    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * Get Upzila
     * @created 06-04-24
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function upazila($district_id)
    {
        $upazilas = DB::table('upazilas')->where('district_id', $district_id)->get();

        return response()->json(['status' => true, 'message' => '', 'records' => $upazilas], 200);
    }

    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * Get Unions
     * @created 06-04-24
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function union($upazila_id)
    {
        $unions = DB::table('unions')->where('upazila_id', $upazila_id)->get();

        return response()->json(['status' => true, 'message' => '', 'records' => $unions], 200);
    }

    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * Get Provider
     * @created 20-04-24
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function nttnProvider($union_id)
    {
        $provider = NTTN::with('provider')->where('union_id', $union_id)->get();

        $providers = [];

        foreach ($provider as $key => $value) {
            $providers[] = [
                'id' => $value->id,
                'provider' => $value->provider?->name,
            ];
        }

        return response()->json(['status' => true, 'message' => '', 'records' => $providers], 200);
    }
}
