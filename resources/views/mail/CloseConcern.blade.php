<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(45deg, #e43a15, #e65245)
        }

        .card {
            width: 400px;
            padding: 80px 50px;
            position: relative;
            border-radius: 20px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.2)
        }

        .card h3 {
            color: #111;
            margin-bottom: 50px;
            border-left: 5px solid red;
            padding-left: 10px;
            line-height: 1em
        }

        .inputbox {
            margin-bottom: 50px
        }

        .inputbox input {
            position: absolute;
            width: 300px;
            background: transparent
        }

        .inputbox input:focus {
            color: #495057;
            background-color: #fff;
            border-color: #e54b38;
            outline: 0;
            box-shadow: none
        }

        .inputbox span {
            position: relative;
            top: 7px;
            left: 1px;
            padding-left: 10px;
            display: inline-block;
            transition: 0.5s
        }

        .inputbox input:focus~span {
            transform: translateX(-10px) translateY(-32px);
            font-size: 12px
        }

        .inputbox input:valid~span {
            transform: translateX(-10px) translateY(-32px);
            font-size: 12px
        }
    </style>
</head>

<body>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <div class="card">
        <img src="https://th.bing.com/th/id/OIP.7mLt__Duzbo-CN0xL3JT9gHaHa?pid=ImgDet&rs=1" alt="Barangay South SIgnal Village Logo" class="rounded
                        float-start" alt="southsignal" style="width: 125px ;">

        <h3 class="mb-4">SUBMITTED CONCERN CLOSED</h3>
        <p>Dear {{ $data['fullname'] }},</p>
        <p>We are glad to inform you that your <strong> SUBMITTED CONCERN </strong> with the reference key
            of <STRONG>{{ $data['ref_key'] }}</STRONG> is now CLOSED(Resolved). The update: </p>
        <hr>
        <p><strong><em>{{ $data['request_title'] }}</em> </strong> </p>
        <p>{{ $data['request_details'] }}</p>
        <hr>
        <p>Thank you for submitting your concern to us.</p>
        <p>Best regards,</p>
        <p>Barangay South Signal Village</p>
        <br>
        <P style="font-style: italic; color: gray;">This is a system
            generated message. Please DO NOT REPLY to this email.</P>
    </div>
</body>

</html>