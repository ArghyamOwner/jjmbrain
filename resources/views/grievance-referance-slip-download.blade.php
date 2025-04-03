<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Grievance Reference slip</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'sans-serif', Times, serif;
        }

        .text-center {
            text-align: center;
        }

        .mb-0 {
            margin-bottom: 0;
        }

        .underline {
            text-decoration: underline
        }

        .dotted-underline {
            text-decoration-style: dotted;
        }

        .h-12 {
            height: 48px
        }
    </style>
</head>

<body>
    <div style="padding-top: 16px; padding-bottom: 16px;">
        <div class="header">
            <div class="text-center">
                <a href="#" aria-label="Home" class="items-center shrink-0">
                    <img class="h-12 md:h-12 object-contain" src="{{ url('img/logo-grievance.png') }}" alt="jjm-Logo"
                        loading="lazy">
                </a>
                <h2 style="line-height: 0.4">Jal Jeevan Mission Assam</h2>
                <h4 style="line-height: 0.4">State Grievance Management System</h4>
                <h4 style="line-height: 0.4">Reference Slip</h4>
            </div>


            <table style="width: 100%; margin-left: auto; margin-right: auto; margin-top: 16px; margin-bottom: 16px;">
                <tr>
                    <td>
                        No: <span style="border-bottom: 1px dotted #222;">{{ $refNo }}</span>
                    </td>
                    <td align="right">
                        Dated: <span style="border-bottom: 1px dotted #222;">{{ $date }}</span>
                    </td>
                </tr>
            </table>

            <div>Dear Citizen</div>

            <div style="margin-bottom: 16px;">
                <p style="text-indent: 50px;">Your complaint tracking ID is {{ $refNo }}. You can track your
                    complaint by clicking on the link below</p>
                <p style="text-indent: 30px;">{{ $url }}</p>
            </div>

            <hr style="border-bottom: 1px dashed #222;">

            <div style="font-size: 16px;">প্ৰিয় নাগৰিক</div>

            <div style="margin-bottom: 16px; font-size: 16px;">
                <p style="text-indent: 50px;">আপোনাৰ অভিযোগ অনুসৰণ আইডি হৈছে {{ $refNo }}. তলৰ লিংকটোত ক্লিক কৰি
                    আপোনাৰ অভিযোগ অনুসৰণ কৰিব পাৰিব</p>
                <p style="text-indent: 30px;">{{ $url }}</p>
            </div>

            <hr style="border-bottom: 1px dashed #222;">

            <div style="font-size: 16px;">প্রিয় নাগরিক</div>

            <div style="margin-bottom: 16px; font-size: 16px;">
                <p style="text-indent: 50px;">আপনার অভিযোগ ট্র্যাকিং আইডি হল {{ $refNo }}. আপনি নীচের লিঙ্কে
                    ক্লিক করে আপনার অভিযোগ ট্র্যাক করতে পারেন</p>
                <p style="text-indent: 30px;">{{ $url }}</p>
            </div>

            <hr style="border-bottom: 1px dashed #222;">

            <ul style="margin-top: 50px; font-size: 16px;" class="text-center">
                <li style="font-size:14px; ">Call us at our call centre 78575958500 for further issue.</li>
                <li>অধিক সমস্যাৰ বাবে আমাৰ কল চেণ্টাৰ ৭৮৫৭৫৯৫৮৫০০ ত ফোন কৰক</li>
                <li>আরও সমস্যার জন্য আমাদের কল সেন্টার ৭৮৫৭৫৯৫৮৫০০ এ কল করুন</li>
            </ul>
        </div>

    </div>
</body>

</html>
