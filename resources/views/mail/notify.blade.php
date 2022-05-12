<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Successful</title>
</head>
<body>
    <div>
        You have an appointment with Sense Hair on {{$booking->booking_time->toDateString()}} at {{$booking->booking_time->format('H:i')}} at Central Plaza 12. See you there!

    </div>
</body>
</html>
