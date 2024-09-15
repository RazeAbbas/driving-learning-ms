<!DOCTYPE html>
<html lang="tr" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="utf-8">
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="x-apple-disable-message-reformatting">
    <title>Mail Submitted</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />


    <style type="text/css">
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif !important;
            line-height: 1.5;
            font-size: 14px;
            -webkit-font-smoothing: antialiased;
            margin: 0;
            padding: 0;
        }

        @media (prefers-color-scheme: dark) {
            body {
                background-color: #efefef !important;
                color: #001;
            }

            p,
            a {
                color: #001 !important;
            }

            body div>div {
                background-color: #ffffff !important;
                background: #fff !important;
                color: #001 !important;
            }

            body div {
                background-color: #ffffff !important;
                background: #fff !important;
                color: #001 !important;
            }
        }
    </style>
</head>

<body style="margin:0;padding:0;word-spacing:normal;">

        <table role="presentation" width="630" style="width:100%; border:0;border-spacing:0;max-width:600px;" align="center">
            <tr>
                <td align="center">
                    <div class="outer" style="width:96%; max-width:630px; margin:0 auto;">
                        <div
                            style="text-align:center; background:#ffffff; -webkit-border-radius: 10px !important; -moz-border-radius: 10px !important; border-radius: 10px !important; margin-top: 30px;">

                            <div class="spacer" style="line-height:30px; height:30px; ">&nbsp;</div>

                            <table
                                style="font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;text-align:center;font-size:14px; width:100%;">
                                <tr>
                                    <td align="center">
                                        <img src="https://nemtguard.com/public/assets/images/logo/nemt_white_header_icon.png" height="60" width="380" alt=""><hr />

                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align:center; padding: 0 15px;" align="center">
                                        <p style="font-size: 18px; line-height: 24px; font-weight: bold; margin: 30px 0 10px;">
                                            Greetings!
                                        </p>
                                        <p style="font-size:14px; line-height:20px; text-align: center; margin: 0 30px 15px;">
                                            <br>You are receiving this email from <strong>{{ $formData['name'] }}</strong> on {{ date('F j, Y', strtotime($formData['created_at'])) }}.
                                            <h3>Message</h3>
                                            <br>{{ $formData['message'] }}
                                        </p>
                                    </td>
                                    
                                </tr>
                            </table><hr/>
                            <p style="margin:0 30px 0;font-size:14px;"> <a href="{{url('https://www.nemtguard.com')}}">NEMTGUARD.COM</a></p>
                            <div class="spacer" style="line-height:30px;height:30px; ">&nbsp;</div>

                        </div>
                    </div>
                    <div class="spacer" style="line-height:30px;height:30px; ">&nbsp;</div>
                </td>
            </tr>
        </table>
</body>

</html>
