@extends('layouts.index_template')

@section('content')
    <?php $status = \Illuminate\Support\Facades\Auth::user()['original']['employe'] ?>
    <script type="text/javascript" src="/data/daterangepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="/data/daterangepicker.css" />

    <div class="modal fade" id="delete-track" role="dialog">
        <div class="modal-dialog"  >
            <!-- Modal content-->
            <div class="modal-content">
                <div id="modalConfirmDeleteTrack"></div>
            </div>
        </div>
    </div>

    <div id="conteiner" class="container" data-date="<?= isset($date)? $date : '' ?>"
         data-status="{{\Illuminate\Support\Facades\Auth::user()['original']['employe']}}"
         data-token="{{ Session::token() }}"
         data-log-active = "<?= isset($_COOKIE['logTrackActiveLogId']) ? $_COOKIE['logTrackActiveLogId'] : ''?>">

        <div class="row" style="margin-top: 20px">
            <div class="col-md-2 btn-toolbar" style="vertical-align: inherit">
                <div id="timeStep5" class="btn-group">
                    <button class="btn btn-sm calendarPrevDay">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </button>
                    <button class="btn btn-sm calendarNextDay">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </button>
                    <button class="btn btn-sm d4">
                        <span class="glyphicon glyphicon-th"></span>
                    </button>

                </div>
            </div>

            <h2  class="col-md-10 showDate"  id="timeTrackShowDate"></h2>
        </div>


        <div class="row-fluid">

            <!-- block -->
            <div class="block" style="border-bottom: 1px solid #ccc; border-left: none; border-right: none">

                <div class="block-content collapse in">
                    <div class="span12">


                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="usersTable">
                            <thead>
                            <tr>
                                <th width="130px">Person Name</th>
                                <th>Client</th>
                                <!--  <th>User</th> -->
                                <th>Project</th>
                                <!--  <th>Date Start</th>
                                 <th>Date Finish</th>-->
                                <th>Task</th>
                                <th>Task Type</th>
                                <th>Hours</th>
                                <th>Value</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th class="thFoot" width="130px"></th>
                                <th class="thFoot" ></th>
                                <!-- <th class="thFoot" >User</th>-->
                                <th class="thFoot" ></th>
                                <!--  <th class="thFoot" >Date Start</th>
                                  <th class="thFoot" >Date Finish</th>-->
                                <th class="thFoot" ></th>
                                <th class="thFoot" ></th>
                                <th class="thFoot" ></th>
                                <th class="thFoot" >Cost</th>

                            </tr>
                            </tfoot>
                            <tbody>

                            @if (isset($dayReport))
                                @foreach( $dayReport as $key )
                                    <tr class="odd gradeX">
                                        <td>{{ $key->project->project_name }}</td>
                                        <td>{{ $key->project->project_name }}</td>
                                        <td>{{ $key->project->project_name }}</td>
                                        <td>{{ $key->project->project_name }}</td>
                                        <td>{{ $key->project->project_name }}</td>
                                        <td>{{ $key->project->project_name }}</td>


                                    </tr>
                                @endforeach
                            @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /block -->
        </div>



    </div>
    <!--    <script src="/js/jquery/jquery-3.1.1.min.js"></script>-->
    <script src="/js/tasks.js"></script>

@endsection
