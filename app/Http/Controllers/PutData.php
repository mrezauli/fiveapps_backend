<?php

namespace App\Http\Controllers;

use App\Models\NTTN;
use App\Models\Union;
use Illuminate\Http\Request;

class PutData extends Controller
{
    public function index()
    {
        NTTN::truncate();
        $file = public_path('nttn_data.csv');
        $array = array();
        $missed = array();
        $failed = array();
        $i = -1;
        if (($open = fopen($file, "r")) !== false) {
            while (($data = fgetcsv($open, filesize($file), ",")) !== false) {
                // $array[] = $data;
                $union_bn = $data[4];
                $nttnProvider = ['SBL' => 2, 'ADSL' => 1][$data[5]];
                $union = Union::where('bn_name', $union_bn)->first();
                if (!$union) {
                    $missed[] = [
                        'id' => ++$i,
                        'ক্রম' => $data[0],
                        'বিভাগ' => $data[1],
                        'জেলা' => $data[2],
                        'উপজেলা' => $data[3],
                        'ইউনিয়ন' => $data[4],
                        'NTTN' => $data[5],
                    ];
                    continue;
                } else {
                    $unionId = $union->id;
                    $nttn = NTTN::create([
                        'union_id' => $unionId,
                        'nttn_providerId' => $nttnProvider,
                        'phone' => "01*********",
                        'pop_location' => 'None',
                        'pop_location_type' => 'None'
                    ]);
                    if ($nttn) {
                        $array[] = $data;
                    } else {
                        $failed[] = $data;
                    }
                }
            }
        }
        return view('put_data', compact('array', 'missed', 'failed'));
    }
}
