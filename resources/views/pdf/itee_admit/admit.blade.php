<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ITEE Exam Admit Card</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        .parent1 {
            position: relative;
        }

        .parent2 {
            position: relative;
        }

        .main_bg {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: 50% 50%;
            display: block;
        }

        .page_break {
            page-break-before: always;
        }

        .topdate {
            position: absolute;
            top: 365px;
            width: 615px;
            height: 34px;
            color: red;
            font-size: 33px;
            text-align: center;
        }

        .topdate1 {
            left: 522px;
        }

        .topdate2 {
            right: 562px;
        }

        .exam-cat-fl1 {
            position: absolute;
            top: 521px;
            left: 1163px;
            width: 302px;
            height: 144.4px;
            text-align: center;
            padding-top: 25px;
            color: red;
        }

        .exam-cat-fr1 {
            position: absolute;
            top: 679px;
            left: 1980px;
            width: 340px;
            height: 91px;
            text-align: center;
            color: red;
        }

        .exam-cat-fl1 .c1,
        .exam-cat-fr1 .c1 {
            font-size: 43px;
            display: block;
        }

        .exam-cat-fl1 .c2,
        .exam-cat-fr1 .c2 {
            font-size: 30px;
            display: block;
        }

        .area-name-fl1 {
            position: absolute;
            text-align: center;
            top: 695px;
            left: 1161px;
            width: 304px;
            height: 38px;
            font-size: 35px;
        }

        .examine-no-fl1 {
            position: absolute;
            text-align: center;
            top: 696px;
            left: 191px;
            width: 684px;
            height: 41px;
            font-size: 35px;
        }

        .dob-fl1 {
            position: absolute;
            text-align: center;
            top: 824px;
            left: 191px;
            width: 538px;
            height: 41px;
            font-size: 35px;
        }

        .examine-name-fl1 {
            position: absolute;
            text-align: center;
            top: 807px;
            left: 928px;
            width: 541px;
            height: 41px;
            font-size: 35px;
        }

        .area-name-fl2 {
            position: absolute;
            text-align: center;
            top: 918px;
            left: 729.5px;
            width: 738px;
            height: 41px;
            font-size: 35px;
            font-size: 30px;
        }

        .area-address-fl1 {
            position: absolute;
            text-align: center;
            top: 997px;
            left: 729.5px;
            width: 738px;
            height: 99px;
            font-size: 35px;
            font-size: 30px;
        }

        .area-image {
            position: absolute;
            text-align: center;
            top: 1236px;
            left: 205px;
            width: 1247px;
            height: 877px;
            font-size: 35px;
            font-size: 30px;
            overflow: hidden;
        }

        .area-image img {
            width: 100%;
        }

        .area-name-fr1 {
            position: absolute;
            top: 703px;
            left: 2320px;
            width: 374px;
            height: 41px;
            text-align: center;
            font-size: 36px;
        }

        .examine-no-fr1 {
            position: absolute;
            top: 854px;
            left: 1981px;
            width: 713px;
            height: 41px;
            text-align: center;
            font-size: 36px;
        }

        .dob-fr1 {
            position: absolute;
            top: 1011px;
            left: 1981px;
            width: 713px;
            height: 41px;
            text-align: center;
            font-size: 36px;
        }

        .examine-name-fr1 {
            position: absolute;
            top: 1181px;
            left: 2245px;
            width: 823px;
            height: 41px;
            text-align: center;
            font-size: 36px;
        }

        .examine-sex-fr1 {
            position: absolute;
            top: 1208px;
            left: 3072px;
            width: 187px;
            height: 41px;
            text-align: center;
            font-size: 36px;
        }

        .examine-postal-fr1 {
            position: absolute;
            top: 1278px;
            left: 2243px;
            width: 223px;
            height: 41px;
            text-align: center;
            font-size: 36px;
        }

        .examine-tel-fr1 {
            position: absolute;
            top: 1278px;
            left: 2735px;
            width: 524px;
            height: 41px;
            text-align: center;
            font-size: 36px;
        }

        .examine-address-fr1 {
            position: absolute;
            top: 1363px;
            left: 2244px;
            width: 1015px;
            height: 81px;
            text-align: center;
            font-size: 36px;
        }

        /* Seconds Page */
        .exam-date-sl1 {
            position: absolute;
            top: 326px;
            left: 590px;
            width: 250px;
            height: 41px;
            text-align: left;
            font-size: 44px;
            font-weight: bold;
        }

        .exam-start-time-sl1 {
            position: absolute;
            top: 386px;
            left: 418px;
            width: 215px;
            height: 31px;
            text-align: left;
            font-weight: bold;
            font-size: 37px;
        }

        .exam-start-time-sl2 {
            position: absolute;
            top: 1610px;
            left: 735px;
            width: 367px;
            height: 35px;
            text-align: center;
            font-size: 44px;
            font-weight: bold;
            color: red;
        }

        .exam-start-time-sl3 {
            position: absolute;
            top: 439px;
            left: 1434px;
            width: 151px;
            height: 22px;
            text-align: center;
            font-size: 36px;
            font-weight: bold;
        }
    </style>
</head>

<body>

    @php
        $exam_type = ['FE', 'IP'][str_contains($exam_registration->examType->name, 'IP')];
    @endphp

    {{-- #Page1 Starts --}}
    <div class="parent1">
        @if ($exam_type == 'FE')
            <img src="{{ asset('assets/images/admit_card/FE-Side-1.jpg') }}" alt="" class="main_bg">
        @else
            <img src="{{ asset('assets/images/admit_card/IP-Side-1.jpg') }}" alt="" class="main_bg">
        @endif
        {{-- >> start --}}
        <div class="topdate topdate1">{{ date('Y-m-d', strtotime($exam_registration->fee->exam_start)) }}</div>
        <div class="topdate topdate2">{{ date('Y-m-d', strtotime($exam_registration->fee->exam_start)) }}</div>
        {{-- left > --}}
        <div class="exam-cat-fl1">
            <b class="c1">{{ $exam_type }}</b>
            <b class="c2">{{ str_contains($exam_registration->examType->name, 'Both') ? 'Morning & Afternoon' : (str_contains($exam_registration->examType->name, 'Morning') ? 'Morning' : (str_contains($exam_registration->examType->name, 'Afternoon') ? 'Afternoon' : '')) }}</b>
        </div>
        <div class="area-name-fl1">{{ $data->e_area->name }}</div>
        <div class="examine-no-fl1">{{ $data->examine_id }}</div>
        <div class="dob-fl1">{{ $data->dob }}</div>
        <div class="examine-name-fl1">{{ $data->name }}</div>
        <div class="area-name-fl2">{{ $data->e_area->name }}</div>
        <div class="area-address-fl1">{{ $data->e_area->address }} ({{ $data->room_no }})</div>
        <div class="area-image">
            {{-- <img src="{{ asset('/uploads/itee/venue/1722670403.png') }}" alt=""> --}}
            <img src="{{ asset($data->e_area->photo) }}" alt="">
        </div>
        {{-- right > --}}
        <div class="exam-cat-fr1">
            <b class="c1">{{ $exam_type }}</b>
            <b class="c2">{{ str_contains($exam_registration->examType->name, 'Both') ? 'Morning & Afternoon' : (str_contains($exam_registration->examType->name, 'Morning') ? 'Morning' : (str_contains($exam_registration->examType->name, 'Afternoon') ? 'Afternoon' : '')) }}</b>
        </div>
        <div class="area-name-fr1">{{ $data->e_area->name }}</div>
        <div class="examine-no-fr1">{{ $data->examine_id }}</div>
        <div class="dob-fr1">{{ $data->dob }}</div>
        <div class="examine-name-fr1">{{ $data->name }}</div>
        <div class="examine-sex-fr1">{{ $data->sex }}</div>
        <div class="examine-postal-fr1">{{ $data->post_code }}</div>
        <div class="examine-tel-fr1">{{ $data->phone }}</div>
        <div class="examine-address-fr1">{{ $data->address }}, {{ $data->email }}</div>
    </div>
    {{-- #Page1 Ends --}}

    <div class="page_break"></div>

    {{-- #Page2 Starts --}}
    <div class="parent2">
        <img src="{{ asset('assets/images/admit_card/FE-Side-2.jpg') }}" alt="" class="main_bg">
        {{-- >> start --}}
        <div class="exam-date-sl1">{{ date('Y-m-d', strtotime($exam_registration->fee->exam_start)) }}</div>
        <div class="exam-start-time-sl1">10:00 AM</div>
        <div class="exam-start-time-sl2">10:00 AM</div>
        <div class="exam-start-time-sl3">9:45 AM</div>
    </div>
    {{-- #Page2 Ends --}}

</body>

</html>
