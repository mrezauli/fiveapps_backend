<?php

namespace App\Http\Controllers;

use App\Models\IteeAdmitCardData;
use App\Models\IteeExamCategory;
use App\Models\IteeExamRegistration;
use App\Models\IteeExamType;
use App\Models\NdcAppointment;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Elibyy\TCPDF\Facades\TCPDF;
use Exception;
use Illuminate\Http\Request;

class PdfDownloadController extends Controller
{
    public function ndc($id)
    {
        $d_id = decode_id($id);
        if (!$d_id) {
            return json_encode(['status' => 'error', 'message' => 'Invalid ID']);
        }
        $data = NdcAppointment::with('user')->findOrFail($d_id);
        // $pdf = Pdf::loadView('pdf.ndc_appointment.format', compact('data'))->setPaper('a4', 'portrait');
        // return $pdf->download('appointment_' . substr($id, 0, 12) . rand(1111111, 999999) . '_' . now()->day . '-' . now()->format('M') . '.pdf');
        // // return view('pdf.ndc_appointment.format', compact('data'));
        $pdf = Pdf::loadView('pdf.ndc_appointment.format', compact('data'))->setPaper('a4', 'portrait')->set_option("dpi", 286.5);
        return $pdf->download('appointment_' . substr($id, 0, 12) . rand(1111111, 999999) . '_' . now()->day . '-' . now()->format('M') . '.pdf');
        // return view('pdf.ndc_appointment.format', compact('data'));
    }

    // public function itee_admit($id)
    // {
    //     $d_id = base64_decode($id);
    //     if (!$d_id) {
    //         return json_encode(['status' => 'error', 'message' => 'Invalid ID']);
    //     }
    //     // Admit card data

    //     $acd = IteeAdmitCardData::where('id', $d_id)->first();
    //     $pdf = Pdf::loadView('pdf.itee_admit.format', compact('acd'))->setPaper('a4', 'landscape');
    //     return $pdf->download('admit_card_id' . $d_id . '_' . now()->day . '-' . now()->format('M') . '.pdf');
    //     // return view('pdf.itee_admit.format', compact('acd'));
    // }

    // public function itee_admit($id) {
    //     $pdffname = "";

    //     $data = [];

    //     $view_side1 = \View::make('pdf.itee_admit.side1', $data);
    //     $html_side1 = $view_side1->render();
    //     $view_side2 = \View::make('pdf.itee_admit.side2', $data);
    //     $html_side2 = $view_side2->render();

    //     // return $html_side1;

    //     $pdf = new TCPDF();

    //     $pdf::SetTitle('Admit Card');
    //     $pdf::SetPageOrientation('landscape');
    //     $pdf::AddPage(/* 'L' */);
    //     $pdf::writeHTML($html_side1, true, false, true, false);
    //     $pdf::AddPage(/* 'L' */);
    //     $pdf::writeHTML($html_side2, true, false, true, false);

    //     return $pdf::Output($pdffname, 'I');
    // }

    public function itee_admit($id)
    {
        try {
            $d_id = base64_decode($id);
            if (!$d_id) {
                throw new Exception('Invalid ID 1');
            }
            $data = IteeAdmitCardData::where('id', $d_id)->first();
            if (!$data) {
                throw new Exception('Invalid ID 2');
            }
            $exam_registration = IteeExamRegistration::where('examine_id', $data->examine_id)->first();
            if (!$exam_registration) {
                throw new Exception('Invalid ID 3');
            }
            // dd($data->e_area);
            $pdf = Pdf::loadView('pdf.itee_admit.admit', compact('data', 'exam_registration'))->setPaper('a4', 'landscape')->set_option("dpi", 300 /* 286.5 */);
            return $pdf->stream('admit_' . substr($id, 0, 12) . rand(1111111, 999999) . '_' . now()->day . '-' . now()->format('M') . '.pdf');
            // return view('pdf.itee_admit.admit');
        } catch (Exception $e) {
            return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
