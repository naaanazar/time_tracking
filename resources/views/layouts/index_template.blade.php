<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Ignatiuz</title>

    <!-- Styles -->
   <!-- <link href="/css/app.css" rel="stylesheet">-->
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="/assets/styles.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="/assets/font-awesome.css">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>

<body id="">
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a>
            <div class="nav-collapse collapse">
                <ul class="nav">
                    <li class="active"> <a href="{{ url('/user/create') }}">Create User</a> </li>
                    <li class="dropdown"> <a href="#" data-toggle="dropdown" class="dropdown-toggle">Report <i class="caret"></i></a>
                        <ul class="dropdown-menu">
                            <li> <a tabindex="-1" href="#">Activity</a> </li>
                            <li> <a tabindex="-1" href="#">Dashboard</a> </li>
                        </ul>
                    </li>
                    <li class="dropdown"> <a href="manage-client.html" role="button" class="dropdown-toggle" data-toggle="dropdown">Manage <i class="caret"></i></a>
                        <ul class="dropdown-menu">
                            <li> <a tabindex="-1" href="manage-client.html">Clients</a> </li>
                            <li> <a tabindex="-1" href="#">Projects</a> </li>
                            <li> <a tabindex="-1" href="#">Tasks</a> </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="{{ url('/logout') }}"
                           onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                            Sing Out
                        </a>

                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
</div>
<div class="alert alert-success"><a href="/"><img src="/images/ignatiuz-logo.png" width="247" height="76" /></a></div>

@yield('content')

<div class="navbar-inner ftr">
    <div>&copy; Ignatiuz</div>
</div>

<!-- /container -->
<script src="/assets/jquery-1.9.1.min.js"></script>
<script src="/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>