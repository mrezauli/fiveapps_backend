<?php

namespace App\Exports;

use App\Models\IteeExamRegistration;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class IteeApplicantsExport implements FromQuery, WithHeadings
{

    use Exportable;
    private $from_date;
    private $to_date;
    private $payment_status;
    private $status;

    public function __construct($from_date, $to_date, $payment_status, $status)
    {
        $this->from_date = $from_date;
        $this->to_date = $to_date;
        $this->payment_status = $payment_status;
        $this->status = $status;
    }

    public function query()
    {
        return IteeExamRegistration::query()->select('examine_id', 'exam_center', 'dob', 'gender', 'full_name', 'post_code', 'address', 'phone', 'email')->whereBetween('created_at', [$this->from_date, $this->to_date])->where('status', $this->status)->where('payment', $this->payment_status);
    }

    public function headings(): array
    {
        return ['ID', 'Exam center', 'dob', 'gender', 'name', 'postal code', 'address', 'mobile', 'email'];
    }
}
