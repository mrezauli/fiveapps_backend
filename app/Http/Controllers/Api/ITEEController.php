<?php

namespace App\Http\Controllers\Api;

use App\Helper\CustomHelper;
use App\Http\Controllers\Controller;
use App\Models\IteeAdmitCardData;
use App\Models\IteeBook;
use App\Models\IteeCourseOutline;
use App\Models\IteeExamCategory;
use App\Models\IteeExamType;
use App\Models\IteeSyllabus;
use App\Models\User;
use App\Models\IteeExamFee;
use App\Models\IteeExamRegistration;
use App\Models\IteeExamResult;
use App\Models\IteeVenue;
use App\Notifications\AllNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class ITEEController extends Controller
{
    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * Get Syllabus with Download
     * @created 11-05-24
     * @param Request $request
     *
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function syllabus()
    {
        $syllabus = IteeSyllabus::select('name', 'syllabus_file')->where('status', 1)->orderBy('id')->get();

        $responseData = [];

        foreach ($syllabus as $key => $item) {
            $responseData[] = [
                'name' => $item->name,
                'download_link' => "https://bcc.touchandsolve.com" . $item->syllabus_file,
            ];
        }

        return response()->json(['status' => true, 'message' => '', 'records' => $responseData], 200);
    }

    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * Get Syllabus with Download
     * @created 11-05-24
     * @param Request $request
     *
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function courseOutline()
    {
        $courseOutline = IteeCourseOutline::select('name', 'course_outline_file')->where('status', 1)->orderBy('id')->get();

        $responseData = [];

        foreach ($courseOutline as $key => $item) {
            $responseData[] = [
                'name' => $item->name,
                'download_link' => "https://bcc.touchandsolve.com" . $item->course_outline_file,
            ];
        }

        return response()->json(['status' => true, 'message' => '', 'records' => $responseData], 200);
    }

    public function getAdmit($id)
    {
        try {
            $admitCardData = IteeAdmitCardData::where('examine_id', $id)->first();
            if ($admitCardData) {
                $url = url("/itee/download/admit/" . base64_encode($admitCardData->id));
                return response()->json(['status' => true, 'download' => $url], 200);
            } else {
                return response()->json(['status' => false, 'message' => 'Invalid data'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something went wrong'], 500);
        }
    }

    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * Get student individual result
     * @created 11-05-24
     * @param Request $request
     *
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function studentIndividualResult($id)
    {
        try {
            $result = IteeExamResult::where('examine_id', $id)->first();

            if($result) {
                $responseData = [
                    'exam_type' => $result->exam_type,
                    'name' => $result->name,
                    'dob' => $result->dob,
                    'morning_passer' => $result->morning_passer,
                    'afternoon_passer' => $result->afternoon_passer ?? 'None',
                    'passing_session' => $result->passing_session ?? 'None',
                    'passer_id' => $result->passer_id,
                ];
            } else {
                $result = IteeExamRegistration::where('examine_id', $id)->first();

                $responseData = [
                    'exam_type' => str_starts_with($result->examType->name, 'IP') ? 'ip' : 'fe',
                    'name' => $result->full_name,
                    'dob' => $result->dob,
                    'morning_passer' => 0,
                    'afternoon_passer' => 0,
                    'passing_session' => 'None',
                    'passer_id' => 'None',
                ];
            }

            if($result->exam_type == 'ip' || $responseData['morning_passer'] == 1 || $responseData['afternoon_passer'] == 1) {
                $responseData['passed'] = 1;
            } else {
                $responseData['passed'] = 0;
            }

            return response()->json(['status' => true, 'message' => '', 'records' => $responseData], 200);
        } catch (Exception $e) {
            return response()->json(['status' => true, 'message' => 'No result found', 'records' => ['message'=>$e->getMessage()]], 200);
        }

    }

    /*
        -- Deprecated
    */
    public function studentResult($category, $type)
    {
        $category_id = IteeExamCategory::where('name', $category)->first()->id;
        $type_id = IteeExamType::where('name', $type)->first()->id;

        if (!$category_id || !$type_id) {
            return response()->json(['status' => false, 'message' => 'Invalid request'], 500);
        }

        $res = IteeExamResult::with('student', 'exam_type', 'exam_category')->where(['student_id' => auth()->user()->id, 'itee_exam_category_id' => $category_id, 'itee_exam_type_id' => $type_id])->first();

        if ($res) {
            $result = [
                'name' => $res->student?->name,
                'exam_name' => $res->exam_category?->name . '|' . $res->exam_type?->name,
                'result' => $res->result,
            ];
            return response()->json(['status' => true, 'message' => '', 'result' => $result], 200);
        } else {
            return response()->json(['status' => true, 'message' => 'No result found', 'result' => []], 200);
        }
    }

    /**
     * @author Touch and Solve <email>
     * @contributor Monzurul Hasan monzurulhasan1001@gmail.com
     * Get personal information
     * @created 01-07-24
     *
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function getPersonalInfo()
    {
        try {
            $student = auth()->user();
            $responseData = [
                'name' => $student->name,
                'email' => $student->email,
                'phone' => $student->phone,
                'occupation' => $student->occupation,
                'linkedin' => $student->linkedin,
            ];
            return response()->json(['status' => true, 'message' => '', 'records' => $responseData], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'records' => [], 'message' => 'Something went wrong'], 500);
        }
    }

    /**
     * @author Touch and Solve <email>
     * @contributor Monzurul Hasan monzurulhasan1001@gmail.com
     * Get User's Admit Card List
     * @created 13-08-24
     * @param Request $request
     *
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function myAdmitCardsList() {
        try {
            $examRegs = IteeExamRegistration::where('user_id', auth()->user()->id)->where('status', 1)->where('payment', 'Paid')->get();
            $acards = [];
            $examRegs->map(function($reg) use (&$acards) {
                $acards_rs = IteeAdmitCardData::where('examine_id', $reg->examine_id)->select('id', 'name')->first();
                if($acards_rs) {
                    $url = url("/itee/download/admit/" . base64_encode($acards_rs->id));
                    $acards[] = [
                        'examine_id' => $reg->examine_id,
                        'examine_name' => $acards_rs->name,
                        'exam_category' => $reg->category?->name,
                        'exam_type' => $reg->examType?->name,
                        'admit_download' => $url
                    ];
                }
            });

            return response()->json(['status' => true, 'records' => $acards, 'message' => ''], 200);
        } catch(Exception $e) {
            return response()->json(['status' => false, 'records' => [], 'message' => 'Something went wrong'], 500);
        }

    }

    /**
     * @author Touch and Solve <email>
     * @contributor Monzurul Hasan monzurulhasan1001@gmail.com
     * Get Unpaid List
     * @created 13-08-24
     * @param Request $request
     *
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function myUnpaidList() {
        try {
            $examRegs = IteeExamRegistration::where('user_id', auth()->user()->id)->where('payment', 'Unpaid')->get();
            $applications = [];
            $applications = $examRegs->map(function($reg) use (&$applications) {
                $books = [];
                $reg->getBooks()->map(function($book) use (&$books) {
                    $books[] = [
                        'book_name' => $book->book_name,
                        'book_fees' => $book->book_price,
                    ];
                });
                return [
                    'examine_id' => $reg->examine_id,
                    'exam_type' => $reg->examType?->name,
                    'exam_category' => $reg->category?->name,
                    'books' => $books
                ];
            });

            return response()->json(['status' => true, 'records' => $applications, 'message' => ''], 200);
        } catch(Exception $e) {
            return response()->json(['status' => false, 'records' => [], 'message' => 'Something went wrong'], 500);
        }

    }

    /**
     * @author Touch and Solve <email>
     * @contributor Monzurul Hasan monzurulhasan1001@gmail.com
     * Get Category Types
     * @created 17-08-24
     * @param Request $request
     *
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function categoryTypes($category_id) {
        try {
            $types = IteeExamType::select('id', 'name', 'category_id')->where('category_id', $category_id)->where('status', 1)->get();
            return response()->json(['status' => true, 'records' => $types, 'message' => ''], 200);
        } catch(Exception $e) {
            return response()->json(['status' => false, 'records' => [], 'message' => 'Something went wrong'], 500);
        }
    }

    /**
     * @author Touch and Solve <email>
     * @contributor Monzurul Hasan monzurulhasan1001@gmail.com
     * Get User's Results List
     * @created 13-08-24
     * @param Request $request
     *
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function myResutsList() {
        try {
            $examRegs = IteeExamRegistration::select('examine_id')->where('user_id', auth()->user()->id)->where('status', 1)->where('payment', 'Paid')->get();
            $results = [];
            $examRegs->map(function($reg) use (&$results) {
                $results_rs = IteeExamResult::where('examine_id', $reg->examine_id)->select(
                    'passer_id',
                    'examine_id',
                    'name',
                    'dob',
                    'morning_passer',
                    'afternoon_passer',
                    'passing_session',
                    'exam_type',
                )->get()->toArray();
                foreach($results_rs as $result) {
                    $results[] = $result;
                }
            });

            return response()->json(['status' => true, 'records' => $results, 'message' => ''], 200);
        } catch(Exception $e) {
            return response()->json(['status' => false, 'records' => [], 'message' => 'Something went wrong'], 500);
        }

    }

    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * Get Exam Apply Information
     * @created 11-05-24
     * @param Request $request
     *
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function getExamApplyInfo()
    {
        $venues = IteeVenue::select('id', 'name')->where('status', 1)->orderBy('id')->get();
        $categories = IteeExamCategory::select('id', 'name')->where('status', 1)->orderBy('id')->get();
        $examTypes = IteeExamType::select('id', 'name')->where('status', 1)->orderBy('id')->get();
        $books = IteeBook::select('id', 'book_name', 'book_price')->where('status', 1)->orderBy('id')->get();
        $responseData = [];
        foreach ($venues as $key => $value) {
            $responseData['venues'][] = [
                'id' => $value->id,
                'name' => ucfirst($value->name),
            ];
        }

        foreach ($categories as $key => $value) {
            $responseData['exam_categories'][] = [
                'id' => $value->id,
                'name' => ucfirst($value->name),
            ];
        }

        foreach ($examTypes as $key => $value) {
            $responseData['exam_type'][] = [
                'id' => $value->id,
                'name' => ucfirst($value->name),
            ];
        }

        foreach ($books as $key => $value) {
            $responseData['books'][] = [
                'id' => $value->id,
                'name' => ucfirst($value->book_name),
                'fee' => $value->book_price
            ];
        }
        return response()->json(['status' => true, 'message' => '', 'records' => $responseData], 200);
    }

    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * Get Exam Fee
     * @created 11-05-24
     * @param Request $request
     *
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function getExamFee($category_id, $type_id)
    {
        $examFee = IteeExamFee::select('id', 'fee')->where(['itee_exam_category_id' => $category_id, 'itee_exam_type_id' => $type_id])->first();

        $responseData = $examFee;
        return response()->json(['status' => true, 'message' => '', 'records' => $responseData], 200);
    }

    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * Get Book Fee
     * @created 11-05-24
     * @param Request $request
     *
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    // public function getBookFee(Request $request)
    public function getBookFee($category_name)
    {
        $isFE = str_contains($category_name, 'FE');
        // $isIP = strpos(strtolower($category_name), 'ip') > 0 ? true : false;
        $books = IteeBook::select('id', 'book_price', 'book_name')->where('status', 1)->get();
        $rspb = [];
        if($isFE) {
            $rspb = $books->filter(function($book) {
                return str_contains($book->book_name, 'FE');
            })->values()->toArray();
        } else {
            $rspb = $books->filter(function($book) {
                return !str_contains($book->book_name, 'FE');
            })->values()->toArray();
        }

        // $responseData = $rspb;
        return response()->json(['status' => true, 'message' => '', 'records' => $rspb], 200);
    }

    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * Exam Registration Information Store
     * @created 11-05-24
     * @param Request $request
     *
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function examRegistration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'user_id'   => 'required|string|max:244',
            'itee_venue_id' => 'required|integer',
            'itee_exam_category_id' => 'required|integer',
            'itee_exam_type_id' => 'required|integer',
            'exam_fees' => 'required|string|max:244',
            'fee_id' => 'required|integer',
            'itee_book_id' => 'required|string',
            'itee_book_fees' => 'required|string|max:244',
            'full_name' => 'required|string|max:244',
            'email' => 'required|email',
            'phone' => 'required|string|max:244',
            'dob' => 'required|string|max:244',
            'gender' => 'required|string|max:244',
            'address' => 'required|string',
            'post_code' => 'required|string|max:244',
            'occupation' => 'required|string|max:244',
            'linkedin' => 'required|string|max:244',
            'photo' => 'required|image|mimes:jpg,jpeg,png,gif|max:5300',
            'education_qualification' => 'required|string|max:244',
            'discipline' => 'nullable|string|max:244',
            'subject_name' => 'nullable|string|max:244',
            'passing_year' => 'required|string|max:244',
            'institute_name' => 'required|string|max:244',
            'result' => 'required|string|max:244',
            'previous_passing_id' => 'nullable|string|max:244', // not require
            // 'payment'                   => 'required|string|max:244',
            // 'status'    => 'required|string|max:244',
        ]);

        // 1 3
        // 1|3

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validator->errors()
            ], 422);
        }
        $photo = '';
        if ($request->hasFile('photo')) {
            $photo = CustomHelper::storeImage($request->file('photo'), '/itee/photo/');
        }

        try {
            // ------------------
            //
            // ------------------
            $venue = IteeVenue::find($request->itee_venue_id);
            $exam_type = IteeExamType::find($request->itee_exam_type_id);
            $examine_id = $this->generateUniqueExamineeId(str_starts_with($exam_type->name, 'IP') ? 'IP' : 'FE');

            if(IteeExamRegistration::where('full_name', $request->full_name)->where('dob', $request->dob)->first()) {
                throw new Exception('Person is already registered for an exam previously.');
            }
            $examRegistration = IteeExamRegistration::create([
                'examine_id' => $examine_id,
                'user_id' => auth()->user()->id,
                'itee_venue_id' => $request->itee_venue_id,
                'itee_exam_category_id' => $request->itee_exam_category_id,
                'itee_exam_type_id' => $request->itee_exam_type_id,
                'exam_center' => $venue->name,
                'exam_fees' => $request->exam_fees,
                'exam_fees_id' => $request->fee_id,
                'itee_book_id' => explode('|', $request->itee_book_id),
                'itee_book_fees' => $request->itee_book_fees,
                'full_name' => $request->full_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'dob' => $request->dob,
                'gender' => $request->gender,
                'address' => $request->address,
                'post_code' => $request->post_code,
                'occupation' => $request->occupation,
                'linkedin' => $request->linkedin,
                'photo' => $photo,
                'education_qualification' => $request->education_qualification,
                'subject_name' => $request->subject_name,
                'passing_year' => $request->passing_year,
                'institute_name' => $request->institute_name,
                'result' => $request->result,
                'previous_passing_id' => $request->previous_passing_id,
                'payment' => 'Unpaid',
                'status' => 0,
            ]);

            $notify_message = "New exam registration submitted";
            $users = User::whereHas('roles', function ($query) {
                $query->where('name', "ITEE Admin");
            })->get();
            Notification::send($users, new AllNotification($notify_message));
            $responseData = ['exam_registration_id' => $examRegistration->id, 'examine_id' => $examine_id];
            return response()->json(['status' => true, 'message' => 'Exam Registration Successfully', 'records' => $responseData], 200);
        } catch (\Throwable $th) {
            if ($request->hasFile('photo') && $photo) {
                $photo = CustomHelper::deleteFile($photo);
            }

            return response()->json(['status' => true, 'message' => 'Something is error.', 'records' => [$th->getMessage()]], 200);
        }

    }

    private function generateUniqueExamineeId($prefix)
    {
        $idx = $prefix;
        $idx .= date('y');
        $currentMonth = intval(date('m'));
        $idx .= $currentMonth > 4 && $currentMonth < 11 ? 2 : 1;
        $rnd = rand(111111, 999999);
        $idx .= substr($rnd, 0, 5);
        if (IteeExamRegistration::where('examine_id', $idx)->exists())
            $idx = $this->generateUniqueExamineeId($prefix);

        return $idx;
    }

    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * Exam Registration Payment Store
     * @created 11-05-24
     * @param Request $request
     *
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function paymentExamRegistration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'transaction_id' => 'required|string|max:244',
            'exam_registration_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $examRegistration = IteeExamRegistration::find($request->exam_registration_id);
            if ($examRegistration) {
                $examRegistration->update([
                    'transaction_id' => $request->transaction_id,
                    'payment' => 'Paid',
                ]);

                $notify_message = "Exam registration payment";
                $users = User::whereHas('roles', function ($query) {
                    $query->where('name', "ITEE Admin");
                })->get();
                Notification::send($users, new AllNotification($notify_message));

                return response()->json(['status' => true, 'message' => 'Exam Registration Payment Successfully', 'records' => []], 200);
            } else {
                return response()->json(['status' => true, 'message' => 'Exam Registration Application Not Found', 'records' => []], 200);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => true, 'message' => 'Something is error.', 'records' => []], 200);
        }

    }
}
