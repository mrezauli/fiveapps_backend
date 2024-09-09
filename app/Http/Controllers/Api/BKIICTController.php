<?php

namespace App\Http\Controllers\Api;

use App\Helper\CustomHelper;
use App\Http\Controllers\Controller;
use App\Models\BkiictBatch;
use App\Models\BkiictCenter;
use App\Models\BkiictCourse;
use App\Models\BkiictCoursePdf;
use App\Models\BkiictExamRegistration;
use App\Models\BkiictTeacher;
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
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BKIICTController extends Controller
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

    public function getAdmit($cid, $tid)
    {
        try {
            $cat = IteeExamCategory::find($cid);
            $type = IteeExamType::find($tid);
            $student = auth()->user();
            if ($cat && $type && $student) {
                $arr = json_encode([
                    'cid' => $cid,
                    'tid' => $tid,
                    'sid' => $student->id
                ]);
                $url = url("/itee/download/admit/" . base64_encode($arr));
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
        $results = IteeExamResult::with('student', 'exam_type', 'exam_category')->where('student_id', $id)->get();

        $responseData = [];
        if (count($results) > 0) {
            foreach ($results as $result) {
                $responseData['result'][] = [
                    'name' => $result->student?->name,
                    'subject_name' => $result->exam_category?->name . '|' . $result->exam_type?->name,
                    'result' => $result->result,
                ];
            }

            return response()->json(['status' => true, 'message' => '', 'records' => $responseData], 200);
        } else {
            return response()->json(['status' => true, 'message' => 'No result found', 'records' => []], 200);
        }

    }

    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * @contributor Monzurul Hasan monzurulhasan1001@gmail.com
     * Get Exam Apply Information
     * @created 11-05-24
     * @param Request $request
     *
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function getCenter()
    {
        try {
            $centers = BkiictCenter::where('status', 1)->get()->map(function ($center) {
                return [
                    'id' => $center->id,
                    'name' => $center->name,
                ];
            });

            $responseData = $centers;
            return response()->json(['status' => true, 'message' => '', 'records' => $responseData], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something went wrong', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * @contributor Monzurul Hasan monzurulhasan1001@gmail.com
     * Get Exam Apply Information
     * @created 11-05-24
     * @param Request $request
     *
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function getCourse($center_id, $type)
    {
        $types = ['short', 'long', 'customized'];

        if (!in_array($type, $types)) {
            return response()->json(['status' => false, 'message' => 'Invalid request'], 500);
        }

        try {
            $courses = BkiictCourse::where('center_id', $center_id)->where('type', $type)->whereNot('status', 0)->get()->map(function ($course) {
                return [
                    'id' => $course->id,
                    'name' => $course->name,
                    'status' => $course->status,
                    'fee' => $course->fee
                ];
            });

            $responseData = $courses;
            return response()->json(['status' => true, 'message' => '', 'records' => $responseData], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something went wrong', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * @author Touch and Solve <email>
     * @contributor Monzurul Hasan monzurulhasan1001@gmail.com
     * Get Course Batches
     * @created 11-05-24
     * @param int $course_id
     *
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function getBatches($course_id)
    {

        try {
            $batches = BkiictBatch::where('bkiict_course_id', $course_id)->whereNot('status', 'deactive')->where('complete', 0)->get()->map(function ($batch) {
                return [
                    'id' => $batch->id,
                    'batch_number' => $batch->number,
                    'name' => $batch->name,
                ];
            });

            return response()->json(['status' => true, 'message' => '', 'records' => $batches], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something went wrong', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * @author Touch and Solve <email>
     * @contributor Monzurul Hasan monzurulhasan1001@gmail.com
     * Get Course Info
     * @created 11-05-24
     * @param int $course_id
     *
     * @return mixed|\Illuminate\Http\JsonResponse
     */

    public function getCourseInfo($course_id, $batch_id)
    {
        try {
            $batch = BkiictBatch::find($batch_id);
            if (!$batch) {
                throw new Exception('Batch not found');
            }
            if ($batch->bkiict_course_id != $course_id) {
                throw new Exception('Batch not found');
            }
            $course = BkiictCourse::with('ins_cordinator', 'center')->find($course_id);
            if (!$course) {
                throw new Exception('Course not found');
            }
            $instructors = BkiictTeacher::whereIn('id', json_decode($course->instructor))->get();
            $response = [
                'id' => $course->id ?? 'None',
                'name' => $course->name ?? 'None',
                'overview' => strip_tags($course->overview) ?? 'None',
                'requirements' => $course->requirements ?? 'None',
                'project' => $course->project ?? 'None',
                'tools' => $course->tools ?? 'None',
                'outline' => strip_tags($course->outline) ?? 'None',
                'duration' => $course->duration ?? 'None',
                'hours' => $course->hours ?? 'None',
                'fee' => $course->fee ?? 'None',
                'shift' => $course->shift ?? 'None',
                'classes' => $course->classes ?? 'None',
                'type' => $course->type ?? 'None',
                'center' => $course->center->name ?? 'None',
                'batch_number' => $batch->number ?? 'None',
                'reg_deadline' => $batch->deadline ?? 'None',
                'class_start' => $batch->class_start ?? 'None',
                'batch_end' => $batch->course_end ?? 'None',
                'status' => $batch->status ?? 'None',
            ];
            // $response['batch'] = [
            // ];
            if ($course->ins_cordinator->status == 'Active') {
                $resImg1 = "None";
                if (file_exists(public_path($course?->ins_cordinator->photo))) {
                    $resImg1 = asset($course?->ins_cordinator->photo);
                }
                $response['cordinator'] = [
                    "name" => $course?->ins_cordinator->name ?? 'None',
                    'photo' => $resImg1 ?? 'None',
                ];
            }
            if (count($instructors) > 0) {
                foreach ($instructors as $instructor) {
                    $resImgI = "None";
                    if (file_exists(public_path($instructor->photo))) {
                        $resImgI = asset($instructor->photo);
                    }
                    $response['instructors'][] = [
                        'name' => $instructor->name ?? 'None',
                        'photo' => $resImgI ?? 'None'
                    ];
                }
            } else {
                $response['instructors'] = [];
            }
            return response()->json(['status' => true, 'message' => '', 'records' => $response], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage() /* 'Something went wrong' */], 500);
        }
    }

    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * @contributor Monzurul Hasan monzurulhasan1001@gmail.com
     * Course Registration Information Store
     * @created 11-05-24
     * @param Request $request
     *
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function courseRegistration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'center_id' => 'required|integer',
            'course_type' => 'required|string',
            'course_id' => 'required|integer',
            'batch_id' => 'required|integer',
            'course_fee' => 'required|string|max:244',
            'full_name' => 'required|string|max:244',
            'email' => 'required|email',
            'phone' => 'required|string|max:244',
            'dob' => 'required|string|max:244',
            'gender' => 'required|string|max:244',
            'photo' => 'required|image|mimes:jpg,jpeg,png,gif|max:5300',
            'education_qualification' => 'required|string|max:244',
            'discipline' => 'nullable|string|max:244',
            'subject_name' => 'nullable|string|max:244',
            'passing_year' => 'required|string|max:244',
            'institute_name' => 'required|string|max:244',
            'result' => 'required|string|max:244',
            'certificate_photo' => 'required|image|mimes:jpg,jpeg,png,gif|max:5300',
            // 'payment' => 'required|string|max:244',
            // 'status' => 'required|string|max:244',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validator->errors()
            ], 422);
        }
        $photo = '';
        if ($request->hasFile('photo')) {
            $photo = CustomHelper::storeImage($request->file('photo'), '/bkiict/photo/');
        }

        $certificate = '';
        if ($request->hasFile('certificate_photo')) {
            $certificate = CustomHelper::storeImage($request->file('certificate_photo'), '/bkiict/certificate/');
        }

        try {
            $examRegistration = BkiictExamRegistration::create([
                'user_id' => auth()->user()->id,
                'center_id' => $request->center_id,
                'type' => $request->course_type,
                'course_id' => $request->course_id,
                'batch_id' => $request->batch_id,
                'course_fee' => $request->course_fee,
                'full_name' => $request->full_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'dob' => $request->dob,
                'gender' => $request->gender,
                'photo' => $photo,
                'education_qualification' => $request->education_qualification,
                'subject_name' => $request->subject_name,
                'discipline' => $request->discipline,
                'passing_year' => $request->passing_year,
                'institute_name' => $request->institute_name,
                'result' => $request->result,
                'certificate_photo' => $certificate,
                'payment' => 'Unpaid',
                'status' => 0,
            ]);
            $responseData = ['exam_registration_id' => $examRegistration->id];
            return response()->json(['status' => true, 'message' => 'Course Registration Successfully', 'records' => $responseData], 200);
        } catch (\Throwable $th) {
            if ($request->hasFile('photo') && $photo) {
                $photo = CustomHelper::deleteFile('/bkiict/photo/' . $photo);
            }
            if ($request->hasFile('certificate_photo') && $certificate) {
                $photo = CustomHelper::deleteFile('/bkiict/certificate/' . $certificate);
            }

            return response()->json(['status' => true, 'message' => 'Something is error.', 'records' => [$th->getMessage()]], 200);
        }

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
    public function paymentCourseRegistration(Request $request)
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
            $examRegistration = BkiictExamRegistration::find($request->exam_registration_id);
            if ($examRegistration) {
                $examRegistration->update([
                    'transaction_id' => $request->transaction_id,
                    'payment' => 'Paid',
                ]);

                return response()->json(['status' => true, 'message' => 'Course Registration Payment Successfully'], 200);
            } else {
                return response()->json(['status' => true, 'message' => 'Course Registration Application Not Found'], 200);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => true, 'message' => 'Something is error.'], 200);
        }

    }

    public function getCoursePdf()
    {
        $pdf = BkiictCoursePdf::where('status', 1)->where('front', 1)->first();
        $responseData = [
            'name' => $pdf->name,
            'download_link' => asset($pdf->file),
        ];
        return response()->json(['status' => true, 'data' => $responseData], 200);
    }

    public function getResultPdf()
    {
        // $pdf = BkiictCoursePdf::where('status', 1)->where('front', 1)->first();
        $result = asset('uploads/bkiict/result_demo.pdf');
        $responseData = [
            // 'name' => $pdf->name,
            'download_link' => $result,
        ];
        return response()->json(['status' => true, 'data' => $responseData], 200);
    }
}
