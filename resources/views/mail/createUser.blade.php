<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <style type="text/css" rel="stylesheet" media="all">
        /* Media Queries */
        @media only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }
    </style>
</head>


<body style="color:grey">

<img src="http://<?= $_SERVER['SERVER_NAME'] ?>/images/ignatiuz-logo.png" width="247" height="76">
<div>
    <h1>Hellow, {{ $name }} </h1>
    <p>Your account is register!</p>
    <p>Your login: {{ $email }}</p>
    <p>Your password: {{ $password }}</p>
    <p><a href="http://<?= $_SERVER['SERVER_NAME'] ?>"> Login</a></p><br><br>

    Regards,<br>Ignatius
</div>

</body>
</html>
