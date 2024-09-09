<?php

namespace App\Http\Controllers;

use App\Exports\IteeApplicantsExport;
use App\Models\IteeExamRegistration;
use App\Models\IteeExamType;
use App\Models\User;
use App\Notifications\AllNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Maatwebsite\Excel\Facades\Excel;

class ITEEExamApplicationController extends Controller
{
    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * Exam Application
     * @created 11-05-24
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $items = IteeExamRegistration::orderByDesc('id')->get()/* all() */;
        // foreach($items as $item) {
        //     $item->itee_book_id = [$item->itee_book_id];
        //     $item->save();
        // }
        return view('itee.exam_application.index', get_defined_vars());
    }

    /**
     * @author Touch and Solve <email>
     * @contributor Monzurul Hasan monzurulhasan1001@gmail.com
     * Import Application
     * @created 11-05-24
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function import(Request $request)
    {
        if ($request->isMethod('POST')) {
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

            foreach ($fileContents as $line) {
                $data = str_getcsv($line);
                if (
                    str_contains(strtolower($data[0]), 'id') ||
                    str_contains(strtolower($data[1]), 'exam center') ||
                    str_contains(strtolower($data[2]), 'dob') ||
                    str_contains(strtolower($data[3]), 'gender') ||
                    str_contains(strtolower($data[4]), 'name') ||
                    str_contains(strtolower($data[5]), 'postal code') ||
                    str_contains(strtolower($data[6]), 'address') ||
                    str_contains(strtolower($data[7]), 'mobile') ||
                    str_contains(strtolower($data[8]), 'email')
                ) {
                    continue;
                }
                $total[] = $data;
                $i_id = $data[0];
                $i_exam_center = $data[1];
                $i_dob = $data[2];
                $i_gender = $data[3];
                $i_name = $data[4];
                $i_postal_code = $data[5];
                $i_address = $data[6];
                $i_mobile = $data[7];
                $i_email = $data[8];

                if ($i_id && $i_exam_center && $i_dob && $i_gender && $i_name && $i_postal_code && $i_address && $i_mobile && $i_email) {
                } else {
                    $skipped[] = $data;
                    continue;
                }

                $doesExists = IteeExamRegistration::where('email', $i_email)->where('phone', $i_mobile)->first();

                if (!$doesExists) {
                    try {
                        IteeExamRegistration::create([
                            'examine_id' => $i_id,
                            'exam_center' => $i_exam_center,
                            'dob' => $i_dob,
                            'gender' => $i_gender,
                            'full_name' => $i_name,
                            'post_code' => $i_postal_code,
                            'address' => $i_address,
                            'phone' => $i_mobile,
                            'email' => $i_email,
                            'status' => 1
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
            return view('itee.exam_application.import');
        }
    }

    /**
     * @author Touch and Solve <email>
     * @contributor Monzurul Hasan monzurulhasan1001@gmail.com
     * Export Application
     * @created 11-05-24
     * @return \Illuminate\Contracts\View\View|\Maatwebsite\Excel\Concerns\Exportable::download
     */
    public function chooseExport(Request $request)
    {
        if ($request->isMethod('POST')) {
            $request->validate([
                'from_date' => 'required',
                'to_date' => 'required',
                'payment_status' => 'required',
                'status' => 'required',
                'export_format' => 'required|in:xlsx,csv'
            ]);

            $current_date = date('Y-m-d');
            $from_date = $request->from_date;
            $to_date = $request->to_date;
            $payment_status = $request->payment_status;
            $status = $request->status;
            $export_ext = ".{$request->export_format}";

            if ($from_date > $current_date || $to_date < $current_date || $to_date < $from_date) {
                return redirect()->back()->with('warning', 'Please select valid date');
            }

            return (new IteeApplicantsExport($from_date, $to_date, $payment_status, $status))->download("Exam_Applicants.{$from_date}_{$to_date}.{$payment_status}." . ['Pending', 'Accepted'][$status] . $export_ext);

        } else {
            return view('itee.exam_application.choose_export');
        }
    }

    public function approve($id)
    {
        $notify_message = "Your exam registration approved!";
        try {
            $exam = IteeExamRegistration::where('transaction_id', '!=', '')->where('id', $id)->first();
            $users = User::where('id', $exam->user_id)->get();
            if ($exam) {
                $exam->update([
                    'status' => 1
                ]);

                $users = User::where('id', $exam->user_id)->get();
                Notification::send($users, new AllNotification($notify_message));

                return redirect()->route('itee.exam.application.index')->with('success', 'ITEE exam application accept successfully');
            }
            return redirect()->route('itee.exam.application.index')->with('warning', 'This is unpaid registration.');
        } catch (Exception $e) {
            return redirect()->route('itee.exam.application.index')->with('error', 'Something went wrong');
        }
    }

    public function view($id)
    {
        $application = IteeExamRegistration::where('id', $id)->first();
        return view('itee.exam_application.view', get_defined_vars());
    }

    public function delete($id)
    {
        try {
            IteeExamRegistration::where('id', $id)->delete();
            return redirect()->route('itee.exam.application.index')->with('success', 'ITEE exam application deleted successfully');
        } catch (Exception $e) {
            return redirect()->route('itee.exam.application.index')->with('error', 'Something went wrong');
        }
    }
}
