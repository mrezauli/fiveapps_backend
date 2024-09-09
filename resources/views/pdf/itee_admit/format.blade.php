<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Appointment to NDC</title>
    <style>
        * {
            box-sizing: border-box;
            color: #2d3748;
        }

        .header {
            padding-left: 2.5rem;
            padding-right: 2.5rem;
            text-align: center;
            margin-top: 1.25rem;
        }

        .img1 {
            width: 7.2rem;
            float: left;
            margin-top: 2.8rem;
        }

        .img2 {
            width: 4.2rem;
            margin-left: 1rem;
            float: right;
            margin-top: 1.6rem;
        }

        .header .bditee {
            font-size: 2.3rem;
            margin-bottom: 0.5rem;
        }

        .header p {
            margin-top: 0.5rem;
            font-size: 0.839rem;
        }

        .header h4 {
            margin-top: 0.7rem;

        }

        .header .ac {
            margin-top: 3rem;
            margin-bottom: 0.7rem;
        }

        .body {
            padding-left: 3.5rem;
            padding-right: 3.5rem;
        }

        .field {
            width: 100%;
            border-bottom: 1px dotted #2d3748;
            float: left;
        }

        .field strong {
            background-color: #fff;
            position: relative;
            bottom: -2px;
            padding-right: 5px;
        }

        .field-half {
            width: 50%;
            border-bottom: 1px dotted #2d3748;
        }

        .field-set {
            margin-top: 1.4rem;
            margin-bottom: 1.4rem;
            height: 20px;
        }

        .field-half strong {
            background-color: #fff;
            position: relative;
            bottom: -2px;
            padding-right: 5px;
        }

        .field-left {
            float: left;
        }

        .field-right {
            float: right;
        }

        .img-container {
            height: 100px;
            text-align: right;
            margin-bottom: 2rem;
            margin-right: 3.5rem;
        }

        .profile-img {
            height: 100px;
            width: 83.35px;
            background-color: #c9c7c7;
        }
    </style>
</head>

<body>
    <div class="header">
        <img class="img1" src="{{ asset('assets/images/itec_logo.png') }}" alt="Logo">
        <img class="img2" src="{{ asset('assets/images/gpbd.png') }}" alt="Logo">
        <h1 class="bditee">Bangladesh IT Engineers Examination</h1>
        <p>Bangladesh Computer Council (BCC), ICT Tower (BCC Bhaban), Agargaon, Sher-e-Bangla Nagar, Dhaka-1207</p>
        <h4>{{ $cat->name }} ({{ $type->name }}) - 2024</h4>
        <h2 class="ac">Admit Card</h2>
    </div>
    {{-- <div class="div-1">
        {{ date('d F Y') }}
    </div> --}}
    <div class="img-container">
        <img class="profile-img" src="{{ file_exists(substr(auth()->user()->photo, 1)) ? auth()->user()->photo : asset('assets/images/profile.png') }}" alt="">
    </div>

    <div class="body">
        <div class="field-set">
            <div class="field"><strong>Student's Name: </strong>{{ $student->name }}</div>
        </div>
        <div class="field-set">
            <div class="field-half field-left"><strong>Mobile: </strong>{{ $student->phone }}</div>
            <div class="field-half field-right"><strong>Roll no: </strong>{{ $student->id }}</div>
        </div>
        <div class="field-set">
            <div class="field-half field-left"><strong>Exam Category: </strong>{{ $cat->name }}</div>
            <div class="field-half field-right"><strong>Exam Type: </strong>{{ $type->name }}</div>
        </div>
    </div>
</body>

</html>
