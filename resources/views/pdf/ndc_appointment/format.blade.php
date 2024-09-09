<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Appointment to NDC</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        .parent {
            position: relative;
        }

        .main_bg {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: 50% 50%;
            display: block;
        }

        .sector_container {
            position: absolute;
            top: 555px;
            left: 480px;
            width: 1422px;
            height: 106px;
            text-align: center;
            font-weight: bold;
            margin-top: 20px;
        }

        .field_name {
            position: absolute;
            top: 742px;
            left: 515px;
            width: 1669px;
            height: 53px;
            font-size: 45px;
        }

        .field_nid {
            position: absolute;
            top: 857px;
            left: 515px;
            width: 1669px;
            height: 53px;
            font-size: 45px;
        }

        .field_phone {
            position: absolute;
            top: 972px;
            left: 515px;
            width: 1669px;
            height: 53px;
            font-size: 45px;
        }

        .field_ogd {
            position: absolute;
            top: 1087px;
            left: 515px;
            width: 1669px;
            height: 53px;
            font-size: 45px;
        }

        .field_email {
            position: absolute;
            top: 1202px;
            left: 515px;
            width: 1669px;
            height: 53px;
            font-size: 45px;
        }

        .field_rdt {
            position: absolute;
            top: 1317px;
            left: 515px;
            width: 1669px;
            height: 53px;
            font-size: 45px;
        }

        .field_purpose {
            position: absolute;
            top: 1499px;
            left: 496px;
            width: 1686px;
            height: 56px;
            font-size: 40px;
            margin-top: 5px;
        }

        .field_device_model {
            position: absolute;
            top: 1561px;
            left: 661px;
            width: 1512px;
            height: 58px;
            font-size: 40px;
        }

        .field_device_serial {
            position: absolute;
            top: 1623px;
            left: 593px;
            width: 1580px;
            height: 58px;
            font-size: 40px;
        }

        .field_device_description {
            position: absolute;
            top: 1684px;
            left: 753px;
            width: 1420px;
            height: 58px;
            font-size: 40px;
        }

        .field_auth_name {
            position: absolute;
            top: 2140px;
            left: 1548px;
            width: 628px;
            height: 38px;
            font-size: 40px;
            margin-top: 5px;
        }

        .field_designation_name {
            position: absolute;
            top: 2200px;
            left: 1548px;
            width: 628px;
            height: 38px;
            font-size: 40px;
            margin-top: 5px;
        }

        .field_email_name {
            position: absolute;
            top: 2270px;
            left: 1548px;
            width: 628px;
            height: 38px;
            font-size: 40px;
            margin-top: 5px;
        }

        .field_phone_name {
            position: absolute;
            top: 2335px;
            left: 1548px;
            width: 628px;
            height: 38px;
            font-size: 40px;
            margin-top: 5px;
        }

        .tick_approved {
            position: absolute;
            top: 2651px;
            left: 863px;
            width: 62px;
            height: 62px;
        }

        .tick_rejected {
            position: absolute;
            top: 2651px;
            left: 1228px;
            width: 62px;
            height: 62px;
        }

        .tick_img {
            width: 160%;
            height: 160%;
            margin-top: -30px;
            margin-left: -10px;
        }
    </style>
    {{-- <script>
        window.print();
    </script> --}}
</head>

<body>
    <div class="parent">
        <img src="{{ asset('assets/images/ndc_access_form.jpg') }}" alt="" class="main_bg">
        <div class="sector_container"><span>{{ $data->sector }} - {{ getUserType($data->user?->user_type) ?? 'Guest' }}</span></div>
        <div class="field_name"><span>{{ $data->name_of_personnel ?? $data->guest_name }}</span></div>
        <div class="field_nid"><span>{{ $data->identification ?? $data->guest_identification }}</span></div>
        <div class="field_phone"><span>{{ $data->phone ?? $data->guest_phone }}</span></div>
        <div class="field_ogd"><span>{{ $data->organization ?? $data->guest_organization }} ({{ $data->designation ?? $data->guest_designation }})</span></div>
        <div class="field_email"><span>{{ $data->email ?? $data->guest_email }}</span></div>
        <div class="field_rdt"><span>{{ $data->date . ' ' . $data->entry_time }}</span></div>
        <div class="field_purpose"><span>{{ $data->purpose }}</span></div>
        <div class="field_device_model"><span>{{ $data->device_model ?? '' }}</span></div>
        <div class="field_device_serial"><span>{{ $data->device_serial ?? '' }}</span></div>
        <div class="field_device_description"><span>{{ $data->device_description ?? '' }}</span></div>

        <div class="field_auth_name">{{ $data->user?->name ?? $data->guest_name }}</div>
        <div class="field_designation_name">{{ $data->user?->designation ?? $data->guest_designation }}</div>
        <div class="field_email_name">{{ $data->user?->email ?? $data->guest_email }}</div>
        <div class="field_phone_name">{{ $data->user?->phone ?? $data->guest_phone }}</div>

        @if ($data->status == 'Accepted')
            <div class="tick_approved">
                <img src="{{ asset('assets/images/tick.png') }}" alt="" class="tick_img">
            </div>
        @elseif ($data->status == 'Rejected')
            <div class="tick_rejected">
                <img src="{{ asset('assets/images/tick.png') }}" alt="" class="tick_img">
            </div>
        @endif
    </div>
</body>

</html>
