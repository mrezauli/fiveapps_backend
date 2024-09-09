<?php

namespace App\Http\Controllers\Api;

use App\Helper\CustomHelper;
use App\Http\Controllers\Controller;
use App\Models\BkiictBatch;
use App\Models\BkiictCourse;
use App\Models\DriverWithCar;
use App\Models\IspConnection;
use App\Models\IteeAdmitCardData;
use App\Models\IteeBjetEvent;
use App\Models\IteeBook;
use App\Models\IteeExamFee;
use App\Models\IteeExamRegistration;
use App\Models\IteeExamResult;
use App\Models\IteeNotice;
use App\Models\IteeProgram;
use App\Models\IteeRecentEvents;
use App\Models\NdcAppointment;
use App\Models\Trip;
use App\Models\VlmStaffHierarchy;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

use function PHPSTORM_META\map;
use function PHPUnit\Framework\isNull;

class HomeController extends Controller
{
    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * Get Dashboard Data
     * @created 20-04-24
     *
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $userType = auth()->user()->user_type;
        $userId = auth()->user()->id;
        if ($userType === 'isp_staff') {
            $dataPending = IspConnection::with('nttnProvider', 'division', 'district', 'upazila', 'union')->select('id', 'request_type', 'nttn_provider', 'district_id', 'division_id', 'upazila_id', 'union_id', 'status', 'created_at')->where('user_id', $userId)->where('status', 'Pending')->paginate(10, ['*'], 'pending_page');
            $dataAccepted = IspConnection::with('nttnProvider', 'division', 'district', 'upazila', 'union')->select('id', 'request_type', 'nttn_provider', 'district_id', 'division_id', 'upazila_id', 'union_id', 'status', 'created_at')->where('user_id', $userId)->where('status', 'Accepted')->paginate(10, ['*'], 'accepted_page');
            $notifications = auth()->user()->unreadNotifications->map(function ($item, $key) {
                return $item->data['message'];
            });
            $responseData = [];
            $responseData['notifications'] = $notifications->toArray();
            foreach ($dataPending as $key => $value) {
                if ($value->status == 'Pending') {
                    $responseData['Pending'][] = [
                        'connection_type' => ucfirst($value->request_type),
                        'provider' => $value->nttnProvider?->provider?->name,
                        'application_id' => $value->id,
                        'phone' => $value->nttnProvider?->phone,
                        'location' => $value->division?->name . ", " . $value->district?->name . ", " . $value->upazila?->name . ", " . $value->union?->name,
                        'created_at' => $value->created_at,
                        'status' => $value->status
                    ];
                }
            }
            foreach ($dataAccepted as $key => $value) {
                if ($value->status == 'Accepted') {
                    $responseData['Accepted'][] = [
                        'connection_type' => ucfirst($value->request_type),
                        'provider' => $value->nttnProvider?->provider?->name,
                        'application_id' => $value->id,
                        'phone' => $value->nttnProvider?->phone,
                        'location' => $value->division?->name . ", " . $value->district?->name . ", " . $value->upazila?->name . ", " . $value->union?->name,
                        'created_at' => $value->created_at,
                        'status' => $value->status
                    ];
                }
            }
            $responseData['pagination']['pending'] = [
                'next_page' => $dataPending->nextPageUrl() ?? 'None',
                'previous_page' => $dataPending->previousPageUrl() ?? 'None',
            ];
            $responseData['pagination']['accepted'] = [
                'next_page' => $dataAccepted->nextPageUrl() ?? 'None',
                'previous_page' => $dataAccepted->previousPageUrl() ?? 'None',
            ];

        } else if ($userType === 'bcc_staff') {
            $data = IspConnection::with('nttnProvider', 'user')->select('id', 'user_id', 'request_type', 'nttn_provider', 'district_id', 'division_id', 'upazila_id', 'union_id', 'status', 'created_at')->where('status', 'Pending')->paginate(10);
            $totalAdslActive = IspConnection::whereHas('nttnProvider', function ($query) {
                $query->where('nttn_providerId', 1);
            })->where('status', 'Accepted')->count();
            $totalAdslPending = IspConnection::whereHas('nttnProvider', function ($query) {
                $query->where('nttn_providerId', 1);
            })->where('status', 'Pending')->count();
            $totalSblActive = IspConnection::whereHas('nttnProvider', function ($query) {
                $query->where('nttn_providerId', 2);
            })->where('status', 'Accepted')->count();
            $totalSblPending = IspConnection::whereHas('nttnProvider', function ($query) {
                $query->where('nttn_providerId', 2);
            })->where('status', 'Pending')->count();
            $responseData = [];
            $totalData = ['adsl' => ['active' => $totalAdslActive, 'inactive' => $totalAdslPending], 'sbl' => ['active' => $totalSblActive, 'inactive' => $totalSblPending]];

            $notifications = auth()->user()->unreadNotifications->map(function ($item, $key) {
                return $item->data['message'];
            });

            $responseData['notifications'] = $notifications->toArray();
            foreach ($data as $key => $value) {
                $responseData['Pending'][] = [
                    'name' => $value->user?->name,
                    'organization' => $value->user?->organization,
                    'mobile' => $value->user?->phone,
                    'connection_type' => ucfirst($value->request_type),
                    'provider' => $value->nttnProvider?->provider?->name,
                    'application_id' => $value->id,
                    'status' => $value->status
                ];
            }
            $responseData['total'] = $totalData;
            $responseData['pagination'] = [
                'next_page' => $data->nextPageUrl() ?? 'None',
                'previous_page' => $data->previousPageUrl() ?? 'None',
            ];
        } else if (in_array($userType, ['nttn_sbl_staff', 'nttn_adsl_staff'])) {
            $provider_id = $userType == 'nttn_sbl_staff' ? 2 : 1;

            $dataPending = IspConnection::with('division', 'district', 'upazila', 'union', 'user', 'nttnProvider')->select('id', 'user_id', 'request_type', 'nttn_provider', 'district_id', 'division_id', 'upazila_id', 'union_id', 'status', 'link_capacity', 'remark')->where('status', 'Pending')->whereHas('nttnProvider', function ($query) use ($provider_id) {
                $query->where('nttn_providerId', $provider_id);
            })->paginate(10, ['*'], 'pending_page');

            $dataAccepted = IspConnection::with('division', 'district', 'upazila', 'union', 'user', 'nttnProvider')->select('id', 'user_id', 'request_type', 'nttn_provider', 'district_id', 'division_id', 'upazila_id', 'union_id', 'status', 'link_capacity', 'remark')->where('status', 'Accepted')->whereHas('nttnProvider', function ($query) use ($provider_id) {
                $query->where('nttn_providerId', $provider_id);
            })->paginate(10, ['*'], 'accepted_page');

            $totalActive = IspConnection::whereHas('nttnProvider', function ($query) use ($provider_id) {
                $query->where('nttn_providerId', $provider_id);
            })->where('status', 'Accepted')->count();
            $totalInactive = IspConnection::whereHas('nttnProvider', function ($query) use ($provider_id) {
                $query->where('nttn_providerId', $provider_id);
            })->where('status', 'Pending')->count();
            $responseData = [];
            $totalData = ['active' => $totalActive, 'inactive' => $totalInactive];

            $notifications = auth()->user()->unreadNotifications->map(function ($item, $key) {
                return $item->data['message'];
            });

            $responseData['notifications'] = $notifications->toArray();

            foreach ($dataPending as $key => $value) {
                if ($value->status == 'Pending') {
                    $responseData['Pending'][] = [
                        'name' => $value->user?->name,
                        'organization' => $value->user?->organization,
                        'mobile' => $value->user?->phone,
                        'connection_type' => ucfirst($value->request_type),
                        'application_id' => $value->id,
                        'location' => $value->division?->name . ", " . $value->district?->name . ", " . $value->upazila?->name . ", " . $value->union?->name,
                        'link' => $value->link_capacity,
                        'remark' => $value->remark,
                        'photo' => $value->user?->photo ?? '/uploads/profile/demo.jpg',
                        'status' => $value->status
                    ];
                }
            }

            foreach ($dataAccepted as $key => $value) {
                if ($value->status == 'Accepted') {
                    $responseData['Accepted'][] = [
                        'name' => $value->user?->name,
                        'organization' => $value->user?->organization,
                        'mobile' => $value->user?->phone,
                        'connection_type' => ucfirst($value->request_type),
                        'application_id' => $value->id,
                        'location' => $value->division?->name . ", " . $value->district?->name . ", " . $value->upazila?->name . ", " . $value->union?->name,
                        'link' => $value->link_capacity,
                        'remark' => $value->remark,
                        'photo' => $value->user?->photo ?? '/uploads/profile/demo.jpg',
                        'status' => $value->status
                    ];
                }
            }
            $responseData['total'] = $totalData;
            $responseData['pagination']['pending'] = [
                'next_page' => $dataPending->nextPageUrl() ?? 'None',
                'previous_page' => $dataPending->previousPageUrl() ?? 'None',
            ];
            $responseData['pagination']['accepted'] = [
                'next_page' => $dataAccepted->nextPageUrl() ?? 'None',
                'previous_page' => $dataAccepted->previousPageUrl() ?? 'None',
            ];
        }

        return response()->json(['status' => true, 'message' => '', 'records' => $responseData], 200);

    }

    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * Get NDC Dashboard Data
     * @created 20-04-24
     *
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function ndcDashboard()
    {
        $userType = auth()->user()->user_type;
        $userId = auth()->user()->id;
        $responseData = [];

        try {
            if (in_array($userType, ['ndc_internal', 'ndc_vendor', 'ndc_customer'])) {
                $dataPending = NdcAppointment::with('user')->where('user_id', $userId)->where('status', 'Pending')->paginate(5, ['*'], 'pending_page');
                $dataAccepted = NdcAppointment::with('user')->where('user_id', $userId)->where('status', 'Accepted')->paginate(5, ['*'], 'accepted_page');

                $notifications = auth()->user()->unreadNotifications->map(function ($item, $key) {
                    return $item->data['message'];
                });

                $responseData['notifications'] = $notifications->toArray();

                foreach ($dataPending as $key => $value) {
                    if ($value->status == 'Pending') {
                        $responseData['Pending'][] = [
                            'name' => $value->name ?? $value->guest_name,
                            'identification' => $value->identification ?? $value->guest_identification,
                            'organization' => $value->organization ?? $value->guest_organization,
                            'designation' => $value->designation ?? $value->guest_designation,
                            'email' => $value->email ?? $value->guest_email,
                            'phone' => $value->phone ?? $value->guest_phone,
                            'name_of_personnel' => $value->name_of_personnel ?? 'None',
                            'belong' => $value->belong,
                            'purpose' => $value->purpose,
                            'appointment_date_time' => $value->date . ', ' . $value->time,
                            'sector' => $value->sector ?? 'None',
                            'status' => $value->status
                        ];
                    }
                }

                foreach ($dataAccepted as $key => $value) {
                    if ($value->status === 'Accepted') {
                        $responseData['Accepted'][] = [
                            'name' => $value->name ?? $value->guest_name,
                            'identification' => $value->identification ?? $value->guest_identification,
                            'organization' => $value->organization ?? $value->guest_organization,
                            'designation' => $value->designation ?? $value->guest_designation,
                            'email' => $value->email ?? $value->guest_email,
                            'phone' => $value->phone ?? $value->guest_phone,
                            'name_of_personnel' => $value->name_of_personnel ?? 'None',
                            'belong' => $value->belong,
                            'purpose' => $value->purpose,
                            'appointment_date_time' => $value->date . ', ' . $value->time,
                            'sector' => $value->sector ?? 'None',
                            'status' => $value->status
                        ];
                    }
                }

                $responseData['pagination']['pending'] = [
                    'next_page' => $dataPending->nextPageUrl() ?? 'None',
                    'previous_page' => $dataPending->previousPageUrl() ?? 'None',
                ];
                $responseData['pagination']['accepted'] = [
                    'next_page' => $dataAccepted->nextPageUrl() ?? 'None',
                    'previous_page' => $dataAccepted->previousPageUrl() ?? 'None',
                ];
            } else if ($userType === 'ndc_admin') {
                $userSector = auth()->user()->ndc_admin_sector;
                $dataPending = NdcAppointment::with('user')->where('sector', $userSector)->where('status', 'Pending')->paginate(5, ['*'], 'pending_page');
                $dataAccepted = NdcAppointment::with('user')->where('sector', $userSector)->where('status', 'Accepted')->paginate(5, ['*'], 'accepted_page');

                $notifications = auth()->user()->unreadNotifications->map(function ($item, $key) {
                    return $item->data['message'];
                });

                $responseData['notifications'] = $notifications->toArray();
                // $startYearDate = Carbon::now()->subYear()->endOfDay();
                // $endYearDate = Carbon::now()->startOfDay();
                // $startOfWeek = Carbon::now()->startOfWeek();
                // $endOfWeek = Carbon::now()->endOfWeek();

                // $monthlyData = NdcAppointment::where('status', 'Accepted')->whereNotNull('approved_by')->whereBetween('updated_at', [$startYearDate, $endYearDate])->get()->groupBy(function ($item) {
                //     return Carbon::parse($item->created_at)->format('M');
                // })->map(function ($entries) {
                //     return $entries->count();
                // })->toArray();
                // $weeklyData = NdcAppointment::where('status', 'Accepted')->whereNotNull('approved_by')->whereBetween('updated_at', [$startOfWeek, $endOfWeek])->get()->groupBy(function ($item) {
                //     return Carbon::parse($item->created_at)->format('D');
                // })->map(function ($entries) {
                //     return $entries->count();
                // })->toArray();
                foreach ($dataPending as $key => $value) {
                    if ($value->status == 'Pending') {
                        $responseData['Pending'][] = [
                            'appointment_id' => $value->id,
                            'name' => $value->name ?? $value->guest_name,
                            'identification' => $value->identification ?? $value->guest_identification,
                            'organization' => $value->organization ?? $value->guest_organization,
                            'designation' => $value->designation ?? $value->guest_designation,
                            'email' => $value->email ?? $value->guest_email,
                            'phone' => $value->phone ?? $value->guest_phone,
                            'name_of_personnel' => $value->name_of_personnel ?? 'None',
                            'belong' => $value->belong,
                            'purpose' => $value->purpose,
                            'appointment_date_time' => $value->date . ', ' . $value->time,
                            'sector' => $value->sector ?? 'None',
                            'status' => $value->status
                        ];
                    }
                }
                foreach ($dataAccepted as $key => $value) {
                    if ($value->status === 'Accepted') {
                        $responseData['Accepted'][] = [
                            'appointment_id' => $value->id,
                            'name' => $value->name ?? $value->guest_name,
                            'identification' => $value->identification ?? $value->guest_identification,
                            'organization' => $value->organization ?? $value->guest_organization,
                            'designation' => $value->designation ?? $value->guest_designation,
                            'email' => $value->email ?? $value->guest_email,
                            'phone' => $value->phone ?? $value->guest_phone,
                            'name_of_personnel' => $value->name_of_personnel ?? 'None',
                            'belong' => $value->belong,
                            'purpose' => $value->purpose,
                            'appointment_date_time' => $value->date . ', ' . $value->time,
                            'sector' => $value->sector ?? 'None',
                            'status' => $value->status
                        ];
                    }
                }
                // $responseData['monthly_data'] = $monthlyData;
                // $responseData['weekly_data'] = $weeklyData;
                $responseData['pagination']['pending'] = [
                    'next_page' => $dataPending->nextPageUrl() ?? 'None',
                    'previous_page' => $dataPending->previousPageUrl() ?? 'None',
                ];
                $responseData['pagination']['accepted'] = [
                    'next_page' => $dataAccepted->nextPageUrl() ?? 'None',
                    'previous_page' => $dataAccepted->previousPageUrl() ?? 'None',
                ];
            } else if ($userType === 'ndc_security_admin') {
                $data = NdcAppointment::with('user')->where('status', 'Accepted')->whereNotNull('approved_by')->paginate(5);

                $notifications = auth()->user()->unreadNotifications->map(function ($item, $key) {
                    return $item->data['message'];
                });

                $responseData['notifications'] = $notifications->toArray();

                // $startYearDate = Carbon::now()->subYear()->endOfDay();
                // $endYearDate = Carbon::now()->startOfDay();
                // $startOfWeek = Carbon::now()->startOfWeek();
                // $endOfWeek = Carbon::now()->endOfWeek();

                // $monthlyData = NdcAppointment::where('status', 'Accepted')->whereNotNull('approved_by')->whereBetween('updated_at', [$startYearDate, $endYearDate])->get()->groupBy(function ($item) {
                //     return Carbon::parse($item->created_at)->format('M');
                // })->map(function ($entries) {
                //     return $entries->count();
                // })->toArray();
                // $weeklyData = NdcAppointment::where('status', 'Accepted')->whereNotNull('approved_by')->whereBetween('updated_at', [$startOfWeek, $endOfWeek])->get()->groupBy(function ($item) {
                //     return Carbon::parse($item->created_at)->format('D');
                // })->map(function ($entries) {
                //     return $entries->count();
                // })->toArray();
                $responseData = [];
                foreach ($data as $key => $value) {
                    $responseData['Accepted'][] = [
                        'appointment_id' => $value->id,
                        'name' => $value->name ?? $value->guest_name,
                        'identification' => $value->identification ?? $value->guest_identification,
                        'organization' => $value->organization ?? $value->guest_organization,
                        'designation' => $value->designation ?? $value->guest_designation,
                        'email' => $value->email ?? $value->guest_email,
                        'phone' => $value->phone ?? $value->guest_phone,
                        'name_of_personnel' => $value->name_of_personnel ?? 'None',
                        'belong' => $value->belong,
                        'purpose' => $value->purpose,
                        'appointment_date_time' => $value->date . ', ' . $value->time,
                        'sector' => $value->sector ?? 'None',
                    ];
                }
                // $responseData['monthly_data'] = $monthlyData;
                // $responseData['weekly_data'] = $weeklyData;
                $responseData['pagination'] = [
                    'next_page' => $data->nextPageUrl() ?? 'None',
                    'previous_page' => $data->previousPageUrl() ?? 'None',
                ];
            }

            /* if ($data) {
                $responseData['pagination'] = [
                    'next_page' => $data->nextPageUrl() ?? 'None',
                    'previous_page' => $data->previousPageUrl() ?? 'None',
                ];
            } */


            return response()->json(['status' => true, 'message' => '', 'records' => $responseData], 200);
        } catch (Exception $e) {
            return response()->json([$e->getMessage()], 500);
        }

    }

    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * Get ITEE Dashboard Data
     * @created 20-04-24
     *
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function iteeDashboard()
    {
        $responseData = [];
        try {
            $notices = IteeNotice::where('status', 1)->orderByDesc('id')->take(5)->get();
            $examFees = IteeExamFee::with('exam_type', 'exam_category')->orderByDesc('id')->get(); // extend type and category to different object
            // dd($examFees->toArray());
            $bjetEvents = IteeBjetEvent::orderByDesc('id')->get();
            $programs = IteeProgram::orderByDesc('id')->get();
            $recentEvents = IteeRecentEvents::orderByDesc('id')->get();

            $responseData = [];


            if (auth()->check()) {
                $books = IteeBook::orderByDesc('id')->get();
                // $result = IteeExamResult::where('student_id', auth()->user()->id);
                // $admit = IteeExamRegistration::where('user_id', auth()->user()->id)->whereNotNull('transaction_id')->where('payment', 'Paid')->where('status', 1);
                $my_applications = IteeExamRegistration::where('user_id', auth()->user()->id)->orderByDesc('id')->get();
                $notifications = auth()->user()->unreadNotifications->map(function ($item, $key) {
                    return $item->data['message'];
                });
                $responseData['notifications'] = $notifications->toArray();
            }


            foreach ($notices as $key => $value) {
                $responseData['notices'][] = [
                    'message' => ucfirst($value->notice),
                ];
            }

            foreach ($examFees as $key => $value) {
                $responseData['examFees'][] = [
                    'exam_image' => $value->exam_type?->image,
                    'exam_type_id' => $value->itee_exam_type_id,
                    'exam_category_id' => $value->itee_exam_category_id,
                    'exam_type' => $value->exam_type?->name,
                    'exam_category' => $value->exam_category?->name,
                    'fee_id' => $value->id,
                    'fees' => 'Tk ' . $value->fee . '/-',
                    'exam_details' => strip_tags($value->details),
                ];
            }

            $responseData['bjetEvents'] = [];
            foreach ($bjetEvents as $bjetEvent) {
                if ($bjetEvent->status) {
                    $responseData['bjetEvents'][] = [
                        'label' => $bjetEvent->label,
                        'image' => $bjetEvent->image
                    ];
                }
            }

            $responseData['programs'] = [];
            foreach ($programs as $program) {
                if ($program->status) {
                    $responseData['programs'][] = [
                        'label' => $program->label,
                        'image' => $program->image
                    ];
                }
            }

            $responseData['recentEvents'] = [];
            foreach ($recentEvents as $recentEvent) {
                if ($recentEvent->status) {
                    $responseData['recentEvents'][] = [
                        'label' => $recentEvent->label,
                        'image' => $recentEvent->image
                    ];
                }
            }


            if (auth()->check()) {
                $responseData['notifications'] = $notifications->toArray();

                foreach ($books as $key => $value) {
                    $responseData['books'][] = [
                        'name' => ucfirst($value->book_name),
                        'price' => 'Tk ' . $value->book_price . '/-'
                    ];
                }

                $responseData['my_applications'] = [];

                $resultPublished = 0;
                $admitCardPublished = null;

                foreach ($my_applications as $my_application) {
                    $exam_type = $my_application->examType?->name;
                    $exam_category = $my_application->category?->name;
                    $examine_id = $my_application->examine_id;
                    $result = IteeExamResult::where('examine_id', $examine_id);
                    $admit = IteeAdmitCardData::where('examine_id', $examine_id);

                    if (!$resultPublished && $result->exists()) {
                        $resultPublished = 1;
                    }

                    if (!$admitCardPublished && $admit->exists()) {
                        $admitCardPublished = 1;
                    }

                    $responseData['my_applications'][] = [
                        'examine_id' => $examine_id,
                        'exam_type' => $exam_type ?? 'None',
                        'exam_category' => $exam_category ?? 'None',
                        'result' => $result /* ->where(['passing_session', '!=', 'NULL']) */ ->first() ? 1 : 0,
                        'payment' => $my_application->payment == 'Paid' ? 1 : 0,
                        'admit_card' => $admit->first() ? 1 : 0,
                    ];
                }

                $responseData['result'] = $resultPublished;
                $responseData['admit_card'] = $admitCardPublished;
            }

            return response()->json(['status' => true, 'authenticated' => auth()->check(), 'message' => '', 'records' => $responseData], 200);
        } catch (Exception $e) {
            return response()->json([$e->getMessage()], 500);
        }

    }

    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * Get ITEE Dashboard Data
     * @created 20-04-24
     * @modified 29-07-24
     *
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function vlmDashboard()
    {
        $userType = auth()->user()->user_type;
        $userId = auth()->user()->id;
        $responseData = [];
        $notifications = auth()->user()->unreadNotifications->map(function ($item, $key) {
            return $item->data['message'];
        });
        $responseData['notifications'] = $notifications->toArray();

        try {
            if ($userType === 'vlm_staff') {
                $pendingTrips = Trip::where('user_id', $userId)->where('status', 'Pending')->orderByDesc('id')->paginate(5, ['*'], 'pending_page');
                $approveTrips = Trip::where('user_id', $userId)->where('status', 'Accepted')->orderByDesc('id')->whereNotNull('driver_with_car_id')->whereNull(['start_trip', 'stop_trip'])->paginate(5, ['*'], 'approved_page');
                $recentTrips = Trip::where('user_id', $userId)->where('status', 'Accepted')->orderByDesc('id')->whereNotNull(['start_trip', 'stop_trip', 'driver_with_car_id'])->paginate(5, ['*'], 'recent_page');

                $responseData['Pending'] = $this->transformTrips($pendingTrips);
                $responseData['Accepted'] = $this->transformTrips($approveTrips);
                $responseData['Recent'] = $this->transformTrips($recentTrips);

                $responseData['pagination']['pending'] = [
                    'next_page' => $pendingTrips->nextPageUrl() ?? 'None',
                    'previous_page' => $pendingTrips->previousPageUrl() ?? 'None',
                ];

                $responseData['pagination']['accepted'] = [
                    'next_page' => $approveTrips->nextPageUrl() ?? 'None',
                    'previous_page' => $approveTrips->previousPageUrl() ?? 'None',
                ];

                $responseData['pagination']['recent'] = [
                    'next_page' => $recentTrips->nextPageUrl() ?? 'None',
                    'previous_page' => $recentTrips->previousPageUrl() ?? 'None',
                ];
            } else if ($userType === 'vlm_senior_officer') {
                $senior = VlmStaffHierarchy::where('seniorStaffId', $userId)->first();
                $userIds = json_decode($senior?->juniorStaffs) ?? [];
                $pendingTrips = Trip::whereIn('user_id', $userIds)->where('status', 'Pending')->orderByDesc('id')->paginate(5, ['*'], 'pending_page');
                $ongoingTrips = Trip::whereIn('user_id', $userIds)->where('status', 'Accepted')->orderByDesc('id')->whereNotNull(['driver_with_car_id', 'start_trip'])->whereNull('stop_trip')->paginate(5, ['*'], 'ongoing_page');

                $responseData['Pending'] = $this->transformTrips($pendingTrips);
                $responseData['Ongoing'] = $this->transformTrips($ongoingTrips);

                $responseData['pagination']['pending'] = [
                    'next_page' => $pendingTrips->nextPageUrl() ?? 'None',
                    'previous_page' => $pendingTrips->previousPageUrl() ?? 'None',
                ];

                $responseData['pagination']['ongoing'] = [
                    'next_page' => $ongoingTrips->nextPageUrl() ?? 'None',
                    'previous_page' => $ongoingTrips->previousPageUrl() ?? 'None',
                ];

            } else if ($userType === 'vlm_admin') {
                $ongoingTripIds = Trip::where('status', 'Accepted')->whereNotNull('driver_with_car_id')->whereNull('stop_trip')->pluck('driver_with_car_id')->toArray();
                $driver = DriverWithCar::with('user', 'car')->whereNotIn('id', $ongoingTripIds)->paginate(5, ['*'], 'driver_page');
                $newTrips = Trip::where('status', 'Accepted')->whereNull(['start_trip', 'stop_trip', 'driver_with_car_id'])->orderByDesc('id')->paginate(5, ['*'], 'newtrip_page');
                $ongoingTrips = Trip::where('status', 'Accepted')->orderByDesc('id')->whereNotNull(['driver_with_car_id', 'start_trip'])->whereNull('stop_trip')->paginate(5, ['*'], 'ongoing_page');

                $responseData['Available_Driver'] = $driver->map(function ($item) {
                    return [
                        'car_id' => $item->id,
                        'name' => $item->user?->name ?? 'None',
                        'phone' => $item->user?->phone ?? 'None',
                        'car_name' => $item->car?->name ?? 'None',
                    ];
                });

                $responseData['New_Trip'] = $this->transformTrips($newTrips);
                $responseData['Ongoing'] = $this->transformTrips($ongoingTrips);

                $responseData['pagination']['driver'] = [
                    'next_page' => $driver->nextPageUrl() ?? 'None',
                    'previous_page' => $driver->previousPageUrl() ?? 'None',
                ];

                $responseData['pagination']['new_trip'] = [
                    'next_page' => $newTrips->nextPageUrl() ?? 'None',
                    'previous_page' => $newTrips->previousPageUrl() ?? 'None',
                ];

                $responseData['pagination']['ongoing'] = [
                    'next_page' => $ongoingTrips->nextPageUrl() ?? 'None',
                    'previous_page' => $ongoingTrips->previousPageUrl() ?? 'None',
                ];
            } else if ($userType === 'vlm_driver') {
                $ongoingTrip = Trip::where('status', 'Accepted')->whereNotNull(['driver_with_car_id', 'start_trip'])->whereNull('stop_trip')->whereHas('driverWithCar', function ($query) use ($userId) {
                    $query->where('user_id', $userId);
                })->get();
                $newTrips = Trip::where('status', 'Accepted')->whereNotNull('driver_with_car_id')->whereNull(['start_trip', 'stop_trip'])->whereHas('driverWithCar', function ($query) use ($userId) {
                    $query->where('user_id', $userId);
                })->orderByDesc('id')->paginate(5, ['*'], 'newtrip_page');
                $recentTrips = Trip::where('status', 'Finished')->whereNotNull(['driver_with_car_id', 'start_trip', 'stop_trip'])->orderByDesc('id')->whereHas('driverWithCar', function ($query) use ($userId) {
                    $query->where('user_id', $userId);
                })->paginate(5, ['*'], 'recent_page');

                $responseData['Ongoing'] = $this->transformTrips($ongoingTrip);
                $responseData['New_Trip'] = $this->transformTrips($newTrips);
                $responseData['Recent'] = $this->transformTrips($recentTrips);

                $responseData['pagination']['new_trip'] = [
                    'next_page' => $newTrips->nextPageUrl() ?? 'None',
                    'previous_page' => $newTrips->previousPageUrl() ?? 'None',
                ];

                $responseData['pagination']['recent'] = [
                    'next_page' => $recentTrips->nextPageUrl() ?? 'None',
                    'previous_page' => $recentTrips->previousPageUrl() ?? 'None',
                ];
            }
            return response()->json(['status' => true, 'message' => '', 'records' => $responseData], 200);
        } catch (Exception $e) {
            return response()->json([$e->getMessage()], 500);
        }

    }

    /**
     * Read Notification
     */
    public function notificationRead()
    {
        try {
            auth()->user()->unreadNotifications->markAsRead();
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Something is error', 'records' => ''], 200);
        }
    }

    /**
     * Transform Trip
     */
    private function transformTrips($trips)
    {
        return $trips->map(function ($item) {
            if (!is_null($item->start_trip) && !is_null($item->stop_trip)) {
                $start_trip = Carbon::parse($item->start_trip);
                $end_trip = Carbon::parse($item->stop_trip_trip);
                $duration = $start_trip->diffInMinutes($end_trip);
                $duration = intval($duration);
            }
            return [
                'trip_id' => $item->id,
                'name' => $item->name ?? 'None',
                'phone' => $item->phone ?? 'None',
                'date' => $item->date ?? 'None',
                'start_time' => $item->start_time ?? 'None',
                'end_time' => $item->end_time ?? 'None',
                'approx_distance' => $item->approx_distance ?? 'None',
                'trip_category' => $item->trip_category ?? 'None',
                'designation' => $item->designation ?? 'None',
                'destination_to' => $item->destination_to ?? 'None',
                'destination_from' => $item->destination_from ?? 'None',
                'department' => $item->department ?? 'None',
                'trip_type' => $item->type ?? 'None',
                'purpose' => $item->purpose ?? 'None',
                'date_time' => $item->date ?? 'None' . ' ' . $item->time ?? 'None',
                'driver' => $item->driverWithCar?->user?->name ?? 'None',
                'car' => $item->driverWithCar?->car?->name ?? 'None',
                'duration' => $duration ?? 'None',
                'start' => $item->start_trip ?? 'None',
            ];
        });
    }

    /**
     * @author Touch and Solve <email>
     * @contributor Monzurul Hasan monzurulhasan1001@gmail.com
     * @contributor Sajjad sajjad.develpr@gmail.com
     * Get BKIICT Dashboard Data
     * @created 30-05-24
     *
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function bkiictDashboard($type)
    {
        $responseData = [];

        $types = ['all', 'long', 'short', 'customized'];
        if (!in_array($type, $types)) {
            return response()->json(['status' => false, 'type' => $type, 'message' => 'Unknown course type', 'records' => ''], 200);
        }

        try {

            $short_courses = [
                'ongoing' => [],
                'upcoming' => []
            ];
            $long_courses = [
                'ongoing' => [],
                'upcoming' => []
            ];
            $customized_courses = [
                'ongoing' => [],
                'upcoming' => []
            ];
            $data = BkiictBatch::whereNot('status', 'deactive')->where('complete', 0)->with('course')->orderByDesc('id')->paginate(10)->through(function ($item) use (&$short_courses, &$long_courses, &$customized_courses, $type) {
                if ($item->course?->type == 'short') {
                    if ($type == 'short' || $type == 'all') {
                        /* if (in_array($item->course?->id, array_column($short_courses[$item->status], 'course_id'), true)) {

                            $short_courses[$item->status][array_search($item->course?->id, array_column($short_courses[$item->status], 'course_id'))]['batch_id'] .= ',' . $item->id;

                            $short_courses[$item->status][array_search($item->course?->id, array_column($short_courses[$item->status], 'course_id'))]['batch_no'] .= ',' . $item->number;
                            return;
                        } */
                        $short_courses[$item->status][] = [
                            'batch_id' => $item->id ?? 'None',
                            'course_id' => $item->course?->id ?? 'None',
                            'course_name' => $item->course?->name ?? 'None',
                            'batch_no' => $item->number ?? 'None',
                            'course_fee' => $item->course?->fee ?? 'None',
                            'classes' => $item->course?->classes ?? 'None',
                            'duration' => $item->course?->duration ?? 'None',
                            'class_start' => $item->class_start ?? 'None',
                            'shift' => $item->course?->shift ?? 'None',
                            'reg_deadline' => $item->course?->deadline ?? 'None',
                            'status' => $item->status,
                            'course_type' => $item->course?->type ?? 'None',
                        ];
                    }
                } else if ($item->course?->type == 'long') {
                    if ($type == 'long' || $type == 'all') {
                        /* if (in_array($item->course?->id, array_column($long_courses[$item->status], 'course_id'), true)) {

                            $long_courses[$item->status][array_search($item->course?->id, array_column($long_courses[$item->status], 'course_id'))]['batch_id'] .= ',' . $item->id;

                            $long_courses[$item->status][array_search($item->course?->id, array_column($long_courses[$item->status], 'course_id'))]['batch_no'] .= ',' . $item->number;
                            return;
                        } */
                        $long_courses[$item->status][] = [
                            'batch_id' => $item->id ?? 'None',
                            'course_id' => $item->course?->id ?? 'None',
                            'course_name' => $item->course?->name ?? 'None',
                            'batch_no' => $item->number ?? 'None',
                            'course_fee' => $item->course?->fee ?? 'None',
                            'classes' => $item->course?->classes ?? 'None',
                            'duration' => $item->course?->duration ?? 'None',
                            'class_start' => $item->class_start ?? 'None',
                            'shift' => $item->course?->shift ?? 'None',
                            'reg_deadline' => $item->course?->deadline ?? 'None',
                            'status' => $item->status,
                            'course_type' => $item->course?->type ?? 'None',
                        ];
                    }
                } else if ($item->course?->type == 'customized') {
                    if ($type == 'customized' || $type == 'all') {
                        /* if (in_array($item->course?->id, array_column($customized_courses[$item->status], 'course_id'), true)) {

                            $customized_courses[$item->status][array_search($item->course?->id, array_column($customized_courses[$item->status], 'course_id'))]['batch_id'] .= ',' . $item->id;

                            $customized_courses[$item->status][array_search($item->course?->id, array_column($customized_courses[$item->status], 'course_id'))]['batch_no'] .= ',' . $item->number;
                            return;
                        } */
                        $customized_courses[$item->status][] = [
                            'batch_id' => $item->id ?? 'None',
                            'course_id' => $item->course?->id ?? 'None',
                            'course_name' => $item->course?->name ?? 'None',
                            'batch_no' => $item->number ?? 'None',
                            'course_fee' => $item->course?->fee ?? 'None',
                            'classes' => $item->course?->classes ?? 'None',
                            'duration' => $item->course?->duration ?? 'None',
                            'class_start' => $item->class_start ?? 'None',
                            'shift' => $item->course?->shift ?? 'None',
                            'reg_deadline' => $item->course?->deadline ?? 'None',
                            'status' => $item->status,
                            'course_type' => $item->course?->type ?? 'None',
                        ];
                    }
                }
            });

            $pagination = [
                'next_page' => $data?->nextPageUrl() ?? 'None',
                'prev_page' => $data?->previousPageUrl() ?? 'None',
                'current_page' => $data->currentPage() ?? 'None',
                'total_page' => $data->lastPage() ?? 'None',
            ];

            if ($type === 'all') {
                $courses = [
                    'ongoing' => array_merge($short_courses['ongoing'], $long_courses['ongoing'], $customized_courses['ongoing']),
                    'upcoming' => array_merge($short_courses['upcoming'], $long_courses['upcoming'], $customized_courses['upcoming'])
                ];
            } else if ($type === 'short') {
                $courses = $short_courses;
            } else if ($type === 'long') {
                $courses = $long_courses;
            } else if ($type === 'customized') {
                $courses = $customized_courses;
            }

            return response()->json([
                'status' => true,
                'type' => $type,
                'message' => '',
                'records' => $courses,
                'pagination' => $pagination
            ], 200);
        } catch (Exception $e) {
            return response()->json([$e->getMessage(), $e->getLine()], 500);
        }
    }
}
