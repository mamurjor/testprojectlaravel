<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Status Update</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        /* Reset */
        body,
        table,
        td,
        p {
            margin: 0;
            padding: 0;
        }

        img {
            border: 0;
            max-width: 100%;
            height: auto;
            display: block;
        }

        table {
            border-collapse: collapse;
        }

        /* Responsive */
        @media screen and (max-width: 600px) {
            .container {
                width: 100% !important;
                padding: 15px !important;
            }

            .content {
                padding: 20px !important;
            }

            h2 {
                font-size: 20px !important;
            }

            h3 {
                font-size: 18px !important;
            }

            p {
                font-size: 15px !important;
            }
        }
    </style>
</head>

<body style="margin:0; padding:0; font-family:Segoe UI, sans-serif; background:#f0f2f5;">

    <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td align="center" style="padding:20px;">
                <!-- Main Container -->
                <table class="container" width="600" cellpadding="0" cellspacing="0"
                    style="max-width:600px; background:#fff; border-radius:12px; overflow:hidden;">

                    <!-- Header -->
                    <tr>
                        <td style="background:#4CAF50; padding:20px; text-align:center;">
                            <h2 style="color:#fff; margin:0;">{{ config('app.name') }}</h2>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td class="content" style="padding:30px;">
                            <h3 style="margin-top:0;">Hello {{ $doctorName }},</h3>
                            <p style="margin-bottom:20px;">We wanted to let you know your profile status has been
                                updated:</p>

                            <!-- Status Box -->
                            <div
                                style="border:1px solid #ddd; border-radius:8px; padding:20px; margin:20px 0; text-align:center; font-size:18px;">
                                <strong>Status:</strong> {{ $status }}
                            </div>

                            <p style="line-height:1.6;">
                                @if ($status == 'Pending')
                                    ⏳ Your application is under review. Please wait for confirmation.
                                @elseif($status == 'Approved')
                                    🎉 Awesome news! You are now officially approved.
                                @elseif($status == 'Rejected')
                                    ❌ Sorry, your request was not approved.
                                @endif
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background:#f9f9f9; padding:15px; text-align:center; font-size:12px; color:#777;">
                            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                        </td>
                    </tr>
                </table>
                <!-- End Main -->
            </td>
        </tr>
    </table>
</body>

</html>
