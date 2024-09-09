<?php

namespace App\Http\Controllers;

use App\Models\IteeExamResult;
use Exception;
use Illuminate\Http\Request;

class ITEEResultsController extends Controller
{
    public function index()
    {
        $results = IteeExamResult::orderByDesc('id')->get();
        return view('itee.results.index', compact('results'));
    }

    public function create()
    {
        return view('itee.results.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'passer_id' => 'required',
            'examine_id' => 'required',
            'name' => 'required',
            'dob' => 'required',
            'morning_passer' => 'nullable',
            'afternoon_passer' => 'nullable',
            'passing_session' => 'required',
            'exam_type' => 'required',
        ]);
        try {
            $result = $request->has('id') ? IteeExamResult::find($request->id) : new IteeExamResult();

            if (!$request->has('id')) {
                $exists = IteeExamResult::where('dob', date('Y-m-d', strtotime($request->dob)))->where('name', $request->name)->first();
                if ($exists) {
                    return redirect()->back()->withInput()->with('error', 'Result already exists. Please update the existing result or delete it to create a new one');
                }
            }

            $result->passer_id = $request->passer_id;
            $result->examine_id = $request->examine_id;
            $result->name = $request->name;
            $result->dob = $request->dob;
            $result->morning_passer = $request->morning_passer && $request->morning_passer == 'on' ? 1 : 0;
            $result->afternoon_passer = $request->afternoon_passer && $request->afternoon_passer == 'on' ? 1 : 0;
            $result->passing_session = $request->passing_session;
            $result->exam_type = $request->exam_type;
            $result->status = 1;

            if (!$result->save()) {
                throw new Exception("Error Saving Data", 1);
            }

            $msg = 'Result data saved successfully';

            if ($request->has('id')) {
                return redirect()->back()->with('success', $msg);
            } else {
                return redirect()->route('itee.results.index')->with('success', $msg);
            }
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Something went wrong');
        }
    }

    public function import(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'file' => 'required|mimes:csv,txt',
                'exam_type' => 'required|in:fe,ip'
            ]);

            $exam_type = $request->exam_type;
            $file = $request->file('file');

            $fileContents = file($file->getPathname());
            $error = "";

            $total = [];
            $imported = [];
            $duplicate = [];
            $skipped = [];
            $entryError = [];

            foreach ($fileContents as $line) {
                $data = str_getcsv($line);

                $i_morning_passer = null;
                $i_afternoon_passer = null;

                if ($exam_type === 'fe') {
                    if (
                        str_contains(strtolower($data[0]), 'passerid') &&
                        str_contains(strtolower($data[1]), 'examinee no') &&
                        str_contains(strtolower($data[2]), 'name') &&
                        str_contains(strtolower($data[3]), 'birth date') &&
                        str_contains(strtolower($data[4]), 'morning passer') &&
                        str_contains(strtolower($data[5]), 'afternoon passer') &&
                        str_contains(strtolower($data[6]), 'passing session')
                    ) {
                        continue;
                    }
                    $total[] = $data;
                    $i_passer_id = trim($data[0]);
                    $i_examine_no = trim($data[1]);
                    $i_name = trim($data[2]);
                    $i_birth_date = trim($data[3]);
                    $i_morning_passer = trim($data[4]);
                    $i_afternoon_passer = trim($data[5]);
                    $i_passing_session = trim($data[6]);
                } else {
                    if (
                        str_contains(strtolower($data[0]), 'passerid') &&
                        str_contains(strtolower($data[1]), 'examinee no') &&
                        str_contains(strtolower($data[2]), 'name') &&
                        str_contains(strtolower($data[3]), 'birth date') &&
                        str_contains(strtolower($data[4]), 'passing session')
                    ) {
                        continue;
                    }
                    $total[] = $data;
                    $i_passer_id = trim($data[0]);
                    $i_examine_no = trim($data[1]);
                    $i_name = trim($data[2]);
                    $i_birth_date = trim($data[3]);
                    $i_passing_session = trim($data[4]);
                }

                if (
                    $i_passer_id &&
                    $i_examine_no &&
                    $i_name &&
                    $i_birth_date &&
                    $i_passing_session
                ) {
                } else {
                    $skipped[] = $data;
                    continue;
                }

                $doesExists = IteeExamResult::where('dob', date('Y-m-d', strtotime($i_birth_date)))->where('name', $i_name)->first();

                if (!$doesExists) {
                    try {
                        IteeExamResult::create([
                            'examine_id' => $i_examine_no,
                            'passer_id' => $i_passer_id,
                            'name' => $i_name,
                            'dob' => date('Y-m-d', strtotime($i_birth_date)),
                            'morning_passer' => $i_morning_passer === null ? null : (strlen(trim($i_morning_passer)) > 0 ? 1 : 0),
                            'afternoon_passer' => $i_afternoon_passer === null ? null : (strlen(trim($i_afternoon_passer)) > 0 ? 1 : 0),
                            'passing_session' => $i_passing_session,
                            'exam_type' => $exam_type,
                            'status' => 1,
                        ]);
                        $imported[] = $data;
                    } catch (Exception $e) {
                        $skipped[] = $data;
                        $entryError[] = ['data' => $data, 'message' => $e->getMessage()];
                    }
                } else {
                    $duplicate[] = $data;
                    $entryError[] = ['data' => $data, 'message' => "Another result is already exists for this examine id"];
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
            return view('itee.results.import');
        }
    }

    public function view($id)
    {
        try {
            $result = IteeExamResult::findOrFail($id);
            return view('itee.results.view', compact('result'));
        } catch (Exception $e) {
            return redirect()->route('itee.results.index')->with('error', 'Result not found');
        }
    }

    public function edit($id)
    {
        try {
            $result = IteeExamResult::findOrFail($id);
            return view('itee.results.edit', compact('result'));
        } catch (Exception $e) {
            return redirect()->route('itee.results.index')->with('error', 'Result not found');
        }
    }

    public function delete($id)
    {
        try {
            $result = IteeExamResult::findOrFail($id);
            $result->delete();
            return redirect()->route('itee.results.index')->with('success', 'Result deleted successfully');
        } catch (Exception $e) {
            return redirect()->route('itee.results.index')->with('error', 'Failed to delete result');
        }
    }
}
