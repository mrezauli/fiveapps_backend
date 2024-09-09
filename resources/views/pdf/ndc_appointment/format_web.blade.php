<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Appointment to NDC</title>
    {{-- <style>
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
    </style> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        window.print();
        window.addEventListener("afterprint", (e) => {
            window.close();
        });

        // const win = window.open('', '', 'left=0,top=0,width=595.2756,height=841.8898,toolbar=0,scrollbar=0,status=0');
        // const content = document.querySelector('html').innerHTML;
        // win.document.write(content);
        // setTimeout(() => {
        //     win.print();
        // }, 200);
    </script>

</head>

<body id="testt" class="p-4">
    <div class="grid grid-cols-[auto_1fr_auto] justify-center items-start gap-2">
        <img class="w-28" src="{{ asset('assets/images/bcc_logo_named.png') }}" alt="Logo">
        <div class="flex flex-col justify-center items-center text-center">
            <h2 class="text-2xl font-bold mb-1">Bangladesh Computer Council</h2>
            <h4 class="text-[15px] font-bold">Information and Communications Technology Division</h4>
            <h5 class="text-xs font-bold">Ministry of Posts, Telecommunications and information Technology</h5>
            <p class="text-xs">ICT Tower, Plot# 13-E/X, Agargaon, Sher-e-Bangla Nagar, Dhaka 1207</p>
            <p class="text-[11px]">55006840/55007185/550071866, datacenter@bcc.gov.bd, Web Site: <u>www.ndc.bcc.gov.bd</u></p>
        </div>
        <img class="w-24" src="{{ asset('assets/images/ndc_logo_full.png') }}" alt="Logo">
    </div>
    <hr class="border-0 border-t-[4px] border-t-black my-2">
    <div class="flex justify-center items-center">
        <div class="text-center p-2 px-6 border border-black font-bold">{{ $data->sector }}</div>
    </div>
    <div class="my-3 mt-6 mx-[30px]">
        <div class="grid grid-cols-[110px_1fr]">
            <div class="font-bold">Full Name of applicant:</div>
            <div class="border-b-[1px] border-b-black"></div>
        </div>
        <div class="grid grid-cols-[110px_1fr]">
            <div class="font-bold">NID/Passport Number:</div>
            <div class="border-b-[1px] border-b-black"></div>
        </div>
    </div>
</body>

</html>
