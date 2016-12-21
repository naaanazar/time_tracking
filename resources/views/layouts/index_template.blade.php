<?php $status = \Illuminate\Support\Facades\Auth::user()['original']['employe'] ?>
<!DOCTYPE html>
<html lang="en">
<head>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="cache-control" content="private, max-age=0, no-cache">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="expires" content="0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Ignatiuz</title>

    <link href="/css/main.css" rel="stylesheet" media="screen">

    <link rel="shortcut icon" href="http://faviconka.ru/ico/faviconka_ru_1127.png" type="image/png">
    <link href="/css/jquery.jgrowl.css" rel="stylesheet" media="screen">

    <link rel="stylesheet" href="/assets/font-awesome.css">




    <link rel="" href="/assets/fonts/glyphicons-halflings-regular.eot">

    <link href="/bootstrap3/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="/bootstrap3/css/bootstrap-theme.css.map" rel="stylesheet" media="screen">

   <link href="/css/bootstrap-datetimepicker.css" rel="stylesheet" media="screen">



    <link rel="stylesheet" type="text/css" href="/datatables/DataTables-1.10.12/css/dataTables.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="/datatables/Buttons-1.2.2/css/buttons.bootstrap.min.css"/>
    <script type="text/javascript" src="/datatables/jQuery-2.2.3/jquery-2.2.3.min.js"></script>




    <script src="/js/moment.js"></script>


    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token(), ]); ?>
    </script>
</head>
<body id="bodyData" data-msg="<?=isset($msg) ? $msg : '' ?>" data-theme="<?=isset($theme) ? $theme : '' ?>">
<div class="navbar-inner navbar-style">
    <nav class="navbar navbar-top nav-my" style="float:right; display:inline-block; z-index: 3">
        <div class="container-fluid" style="min-height: 61px;">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div>
                <div class="collapse navbar-collapse " id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right" style="margin-right: 20px;">
                    @if ($status != 'HR Manager')
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle menuFirst" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"
                                   onclick="event.preventDefault();   window.location = '/trecking';">
                                    TRACK
                                </a>

                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle menuFirst" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    Report <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-my" style="background-color: #ff6d00; top: 58px;" >
                                    <li><a href="#">-----</a></li>
                                    <li><a href="#">------</a></li>
                                    <li><a href="#">------</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#">------</a></li>
                                </ul>
                            </li>
                        @endif
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle menuFirst" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                Manage <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu"  style="background-color: #ff6d00; top: 58px;">
                                @if ($status == 'Admin' || $status == 'HR Manager')
                                    <li> <a tabindex="-1" href="/user/all">Users</a> </li>
                                @endif
                                @if ($status == 'Admin' || $status == 'Supervisor')
                                    <li> <a tabindex="-1" href="/client/all">Clients</a> </li>
                                @endif
                                @if ($status == 'Admin' || $status == 'Supervisor' || $status == 'Lead' || $status == 'Developer' || $status == 'QA Engineer')
                                    <li> <a tabindex="-1" href="/project/all">Projects</a> </li>
                                    <li> <a tabindex="-1" href="/task/all">Tasks</a> </li>
                                @endif
                                @if ($status == 'Admin' || $status == 'Supervisor' || $status == 'Lead')
                                    <li> <a tabindex="-1" href="/team/all">Teams</a> </li>
                                @endif
                                <li role="separator" class="divider"></li>
                                <li> <a tabindex="-1" href="#">--</a> </li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle menuFirst" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" onclick="event.preventDefault();
                               location.replace('/user/logout')">
                                Sign Out
                            </a>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div>
        </div><!-- /.container-fluid -->
    </nav>
</div>
</div>
<div style=" border-bottom: solid 3px #808080">
    <div class="container" style="position: relative">
          <a href="http://webdevelop.it-dev-lab.com"><img src="http://webdevelop.it-dev-lab.com/images/ignatiuz-logo.png" width="247" height="102" style="margin-top:7px"></a>

        <div style="display: inline-block; float: right; position: relative; margin-top: 61px;     position: absolute;
    right: 10px;">
            <img src="http://webdevelop.it-dev-lab.com/images/log.png" width="65" height="65" style="position: absolute;
                    left: -27px;
                    bottom: -2px;">
            <span style="    display: inline-block;
                background-color: #808080;
                color: #ccc;
                padding: 5px 60px;">
                 <strong>{{\Illuminate\Support\Facades\Auth::user()['original']['name']}}<br> {{\Illuminate\Support\Facades\Auth::user()['original']['employe']}}</strong>
            </span>
        </div>
    </div>
</div>


@yield('content')


<div class="navbar-inner" style="bottom: 0;
    position: fixed;
    width: 100%;
    min-height: 63px;
    padding-right: 20px;
    padding-left: 20px;
    background-color: #808080;
    border: 1px solid #d4d4d4;
        margin-top: 50px;
        z-index:10;">
    <div style="    color: #cccccc;
    font-size: 20px;
    margin: 0 auto;
    padding: 20px 0 0;
    width: 83%;
    ">&copy Ignatiuz</div>
</div>
<!-- /container -->
<script src="/assets/jquery-1.9.1.min.js"></script>

<script src="/assets/scripts.js"></script>

    <script type="text/javascript" src="/datatables/jQuery-2.2.3/jquery-2.2.3.min.js"></script>
    <script type="text/javascript" src="/datatables/DataTables-1.10.12/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="/datatables/DataTables-1.10.12/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="/datatables/Buttons-1.2.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="/datatables/Buttons-1.2.2/js/buttons.bootstrap.min.js"></script>
    <script type="text/javascript" src="/datatables/Buttons-1.2.2/js/buttons.colVis.min.js"></script>





    <script src="/bootstrap3/js/bootstrap.min.js"></script>
    <script src="/js/jquery.jgrowl.js"></script>


    <script src="/js/main.js"></script>

<script type="text/javascript" src="/js/bootstrap-datetimepicker.js"></script>


  <!--  <script src="/assets/datatables/js/jquery.dataTables.min.js"></script>
<script src="/assets/DT_bootstrap.js"></script>-->
<script>
    $(function() {

    });
</script>
</body>
</html>