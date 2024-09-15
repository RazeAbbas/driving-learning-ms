<!DOCTYPE html>
<html>
<head>
    <title>Certificate</title>
    <meta http-equiv="Content-Type" content="charset=utf-8" />
    <style type="text/css">
        html {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            margin: 0;
            padding: 0;
            font-family: 'Times New Roman', Times, serif;
            font-weight: 700;
        }
        .certificate-container {
            width: 100%;
            max-width: 100%; /* Adjust based on the aspect ratio */
            height: auto;
            position: relative;
        }
        .certificate-image {
            width: 100%;
            height: auto;
            display: block;
        }
        .name {
            position: absolute;
            margin-top: 16rem!important;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 50px;
            color: #ffffff;
        }
        .date {
            position: absolute;
            margin-top: -5.98rem!important;
            left: 69%;
            transform: translateX(-50%);
            color: #D6B94B;
            font-size: 20px;
        }
    </style>
</head>

<body>
    <div class="certificate-container">
        <img class="certificate-image" src="{{ url($result->course->certification) }}">
        <p class="name"><b>{{ ucfirst($result->user->name . ' ' . $result->user->surname) }}</b></p>
        <p class="date"><b>{{ date('m/d/Y', strtotime($result->created_at)) }}</b></p>
    </div>
</body>

</html>
