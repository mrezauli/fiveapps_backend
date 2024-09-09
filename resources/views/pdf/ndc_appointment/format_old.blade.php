<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Appointment to NDC</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 0.875rem;
            line-height: 1.25rem;
            color: #4b5563;
        }

        .header {
            padding: 1.5rem 2rem;
            height: 40px;
        }

        .div-1 {
            font-weight: bold;
            padding: 0 2rem;
        }

        .header>.div-2 {
            float: right;
        }

        img.first {
            width: 6.8rem;
        }

        img.second {
            width: 3.7rem;
            margin-left: 1rem;
        }

        .body {
            position: relative;
            margin-top: 1.75rem;
            margin-bottom: 1.75rem;
            overflow: hidden;
            padding: 0.2rem 2rem;
        }

        .title {
            text-align: center;
            font-size: 1.2rem;
            font-weight: bold;
            color: #2d3748;
            margin-bottom: 1.2rem;
        }

        .information {
            margin-top: 0.7rem;
        }

        .information p {
            margin: 4px;
        }

        .footer {
            text-align: center;
            color: rgb(100 116 139 / 1);
        }
    </style>
    <script>
        // window.print();
        // setInterval(() => {
        //     if (document.hasFocus()) {
        //         window.close();
        //     }
        // }, 200);
    </script>
</head>

<body>
    <div class="header">
        <div class="div-2">
            <img class="first" src="{{ asset('assets/images/ndc_logo_full.png') }}" alt="Logo">
            <img class="second" src="{{ asset('assets/images/gpbd.png') }}" alt="Logo">
        </div>
    </div>
    <div class="div-1">
        {{ date('d F Y') }}
    </div>

    <div class="body">
        {{-- A title --}}
        <h1 class="title">Appointment Report</h1>
        <div class="information">
            <p>
                <strong>Visitor's name:</strong> {{ $data->user->name ?? $data->guest_name }}
            </p>
            <p>
                <strong>Organization:</strong> {{ $data->user?->organization ?? $data->guest_organization }}
            </p>
            <p>
                <strong>Purpose:</strong> {{ $data->purpose }}
            </p>
            <p>
                <strong>Belongs:</strong> {{ $data->belong }}
            </p>
            <p>
                <strong>Designation:</strong> {{ $data->user?->designation ?? '' }}
            </p>
            <p>
                <strong>Appointment Time:</strong> {{ $data->date . ', ' . $data->time }}
            </p>
            <p>
                <strong>Entry Time:</strong> {{ $data->entry_time }}
            </p>
        </div>
    </div>
</body>

</html>
