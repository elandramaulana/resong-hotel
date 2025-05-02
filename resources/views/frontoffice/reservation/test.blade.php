<!DOCTYPE html>
<html>

<head>
    <title>Test Form</title>
</head>

<body>
    <form action="/test" method="POST">
        @csrf
        <label>Check-in Time: <input name="res_in_hour" type="time"></label><br><br>
        <label>Check-out Time: <input name="res_out_hour" type="time"></label><br><br>
        <button type="submit">Send</button>
    </form>
</body>

</html>
