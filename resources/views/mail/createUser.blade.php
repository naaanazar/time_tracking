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

<img src="http://<?= $_SERVER['SERVER_NAME'] ?>/images/ignatiuz-logo.png" width="250" height="102">
<div>
    <h3>Hello {{ $name }} </h3>
    <p>You have been invited to collaborate with your team members on myHub. Please find the login details below</p>
    <p>Login: {{ $email }}</p>
    <p>Password: {{ $password }}</p>
    <p>Visit myHub portal at  <a href="http://<?= $_SERVER['SERVER_NAME'] ?>">http://myhub.ignatiuz.com</a> to get started.</p><br><br>

    Cheers!<br>Team Ignatiuz
</div>

</body>
</html>
