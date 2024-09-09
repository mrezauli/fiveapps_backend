<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Email Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #eeeeee;
        }

        .header h1 {
            font-size: 24px;
            color: #20a7db;
            margin: 0;
        }

        .content {
            padding: 20px;
            text-align: center;
        }

        .content h3 {
            font-size: 16px;
            color: #333333;
            font-weight: 300;
        }

        .content h3 strong {
            color: #20a7db;
        }

        .content p {
            font-size: 13px;
            color: #666666;
            margin: 10px 0;
        }

        .otp {
            display: inline-block;
            font-size: 32px;
            color: #20a7db;
            margin: 20px auto;
            padding: 5px 15px;
            letter-spacing: 5px;
            font-family: monospace;
            background-color: #efefef;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .footer {
            text-align: center;
            padding: 20px;
            border-top: 1px solid #eeeeee;
            font-size: 12px;
            color: #999999;
        }

        .social-icons img {
            width: 24px;
            margin: 0 10px;
        }

        .social-icons {
            padding-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Registration Verification</h1>
        </div>
        <div class="content">
            <h3>Hello <strong>{{ $fname }}</strong>,</h3>
            <p>
                Thank you for registering with us! To complete your registration,
                please verify your email address by entering the OTP provided below:
            </p>
            <div class="otp">{{ $otp }}</div>
            <p>
                This code is valid for the next <strong>30 minutes</strong>. Please do not share
                this code with anyone.<br />If you did not request this email, please
                ignore it.
            </p>
        </div>
        <div class="footer">
            <p>
                This email was auto-generated. Please do not reply to this email.<br />If
                you need any further information, please contact to the authors.
            </p>
        </div>
    </div>
</body>

</html>
