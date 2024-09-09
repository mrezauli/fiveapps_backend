<?php

namespace App\Http\Controllers;

use App\Models\IteeAdmitCardData;
use App\Models\IteeExamRegistration;
use App\Models\IteeVenue;
use Exception;
use Illuminate\Http\Request;

class ITEEAdmitCardController extends Controller
{
    public function index()
    {
        $ac_datas = IteeAdmitCardData::all();
        return view('itee.admit-card.index', compact('ac_datas'));
    }

    public function create()
    {
        $students = IteeExamRegistration::where('status', 1)->where('payment', 'Paid');
        $areas = IteeVenue::where('status', 1)->get();
        return view('itee.admit-card.create', compact('students', 'areas'));
    }

    public function store(Request $request)
    {
        if (!$request->has('id')) {
            $request->validate([
                'name' => 'required',
                'examine_id' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'address' => 'required',
                'sex' => 'required',
                'dob' => 'required',
                'pin' => 'required|numeric',
                'area_id' => 'required',
                'site' => 'required',
                'room_no' => 'required',
                'post_code' => 'required',
                'exempt' => 'required',
            ]);
        }

        try {
            $admitCardData = $request->has('id') ? IteeAdmitCardData::find($request->id) : new IteeAdmitCardData();

            // Determine area
            $area = IteeVenue::where('id', $request->area_id)->first();

            if (!$area) {
                throw new Exception("Invalid area", 1);
            }

            if (!$request->has('id')) {
                $exists = IteeAdmitCardData::where('dob', $request->dob)->where('name', $request->name)->first();
                if ($exists) {
                    return redirect()->back()->withInput()->with('error', 'Admit card already exists for this name and date-of-birth. Please update the existing admit card or delete it to create a new one');
                }
            }

            $request->examine_id ? $admitCardData->examine_id = $request->examine_id : '';
            $request->pin ? $admitCardData->pin = $request->pin : '';
            $request->name ? $admitCardData->name = $request->name : '';
            $request->sex ? $admitCardData->sex = $request->sex : '';
            $request->dob ? $admitCardData->dob = $request->dob : '';
            $request->site ? $admitCardData->site = $request->site : '';
            $request->room_no ? $admitCardData->room_no = $request->room_no : '';
            $request->post_code ? $admitCardData->post_code = $request->post_code : '';
            $request->address ? $admitCardData->address = $request->address : '';
            $request->phone ? $admitCardData->phone = $request->phone : '';
            $request->email ? $admitCardData->email = $request->email : '';
            $request->exempt ? $admitCardData->exempt = $request->exempt : '';
            if ($request->area_id) {
                $admitCardData->area = $area->name;
                $admitCardData->area_id = $request->area_id;
            }

            if (!$admitCardData->save()) {
                throw new Exception("Error Saving Data", 1);
            }

            $msg = 'Admit card data saved successfully';

            if ($request->has('id')) {
                return redirect()->back()->with('success', $msg);
            } else {
                return redirect()->route('itee.admit-card.index')->with('success', $msg);
            }

        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Something went wrong');
        }
    }

    public function import(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'file' => 'required|mimes:csv,txt'
            ]);
            $file = $request->file('file');

            $fileContents = file($file->getPathname());
            $error = "";

            $total = [];
            $imported = [];
            $duplicate = [];
            $skipped = [];
            $entryError = [];
            // dd($fileContents);

            $areas = IteeVenue::select('id', 'name')->where('status', 1);
            $careas = [];

            foreach ($areas->get() as $area) {
                $careas[$area->id] = strtolower($area->name);
            }

            foreach ($fileContents as $line) {
                $data = str_getcsv($line);
                if (
                    str_contains(strtolower($data[0]), 'examinee no') &&
                    str_contains(strtolower($data[1]), 'pin') &&
                    str_contains(strtolower($data[2]), 'name') &&
                    str_contains(strtolower($data[3]), 'sex') &&
                    str_contains(strtolower($data[4]), 'birth date') &&
                    str_contains(strtolower($data[5]), 'area') &&
                    str_contains(strtolower($data[6]), 'site') &&
                    str_contains(strtolower($data[7]), 'room') &&
                    str_contains(strtolower($data[8]), 'post code') &&
                    str_contains(strtolower($data[9]), 'address') &&
                    str_contains(strtolower($data[10]), 'phone') &&
                    str_contains(strtolower($data[11]), 'e-mail') &&
                    str_contains(strtolower($data[12]), 'exempt')
                ) {
                    continue;
                }
                $total[] = $data;
                $i_examine_no = $data[0];
                $i_pin = $data[1];
                $i_name = $data[2];
                $i_sex = $data[3];
                $i_birth_date = date('Y-m-d', strtotime($data[4]));
                $i_area = $data[5];
                $i_site = $data[6];
                $i_room = $data[7];
                $i_post_code = $data[8];
                $i_address = $data[9];
                $i_phone = $data[10];
                $i_email = $data[11];
                $i_exempt = $data[12];

                // Determine area from database
                $i_area_id = array_search(strtolower($i_area), $careas);
                if ($i_area_id === false) {
                    $skipped[] = $data;
                    $entryError[] = ['data' => $data, 'message' => "Area name is not matched with any existing area names. Please check if there are any typo or spelling mistakes."];
                    continue;
                }
                $i_area = $areas->where('id', $i_area_id)->first()->name;

                // Check if exam registration exists
                // -------- To be written


                if ($i_examine_no && $i_pin && $i_name && $i_sex && $i_birth_date && $i_area && $i_site && $i_room && $i_post_code && $i_address && $i_phone && $i_email && $i_exempt) {
                } else {
                    $skipped[] = $data;
                    continue;
                }

                $doesExists = IteeAdmitCardData::where('name', $i_name)->where('dob', $i_birth_date)->first();

                if (!$doesExists) {
                    try {
                        IteeAdmitCardData::create([
                            'examine_id' => $i_examine_no,
                            'pin' => $i_pin,
                            'name' => $i_name,
                            'sex' => $i_sex,
                            'dob' => $i_birth_date,
                            'area' => $i_area,
                            'area_id' => $i_area_id,
                            'site' => $i_site,
                            'room_no' => $i_room,
                            'post_code' => $i_post_code,
                            'address' => $i_address,
                            'phone' => $i_phone,
                            'email' => $i_email,
                            'exempt' => $i_exempt,
                        ]);
                        $imported[] = $data;
                    } catch (Exception $e) {
                        $skipped[] = $data;
                        $entryError[] = ['data' => $data, 'message' => $e->getMessage()];
                    }
                } else {
                    $duplicate[] = $data;
                }
            }
            if (!empty($error)) {
                return redirect()->back()->with('error', $error);
            } else {
                return redirect()->back()->with(
                    [
                        'array' => [
                            'total' => $total,
                            'imported' => $imported,
                            'duplicate' => $duplicate,
                            'skipped' => $skipped,
                            'entryError' => $entryError,
                            'message' => "Operation complete",
                        ]
                    ]
                );
            }
        } else {
            return view('itee.admit-card.import');
        }
    }

    public function view($id)
    {
        try {
            $ac_data = IteeAdmitCardData::findOrFail($id);
            return view('itee.admit-card.view', compact('ac_data'));
        } catch (Exception $e) {
            return redirect()->route('itee.admit-card.index')->with('error', 'Admit card data not found');
        }
    }

    public function edit($id)
    {
        try {
            $students = IteeExamRegistration::where('status', 1)->where('payment', 'Paid');
            $ac_data = IteeAdmitCardData::findOrFail($id);
            $areas = IteeVenue::where('status', 1)->get();
            return view('itee.admit-card.edit', compact('ac_data', 'students', 'areas'));
        } catch (Exception $e) {
            return redirect()->route('itee.admit-card.index')->with('error', 'Admit card data not found');
        }
    }

    public function delete($id)
    {
        try {
            $admitData = IteeAdmitCardData::findOrFail($id);
            $admitData->delete();
            return redirect()->route('itee.admit-card.index')->with('success', 'Admit card data deleted successfully');
        } catch (Exception $e) {
            return redirect()->route('itee.admit-card.index')->with('error', 'Failed to delete admit card data');
        }
    }
}
