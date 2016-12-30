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

    <div id="conteiner" class="container" data-date=""
         data-status="{{\Illuminate\Support\Facades\Auth::user()['original']['employe']}}"
         data-token="{{ Session::token() }}"
         data-log-active = "<?= isset($_COOKIE['logTrackActiveLogId']) ? $_COOKIE['logTrackActiveLogId'] : ''?>">

        <div class="row" style="margin-top: 20px">
            <span class="col-md-4 col-lg-3   btn-toolbar" style="vertical-align: inherit; font-size: large ">

                <div class="daterange daterange--double one2" style=""></div>

            </span>
            <div class="col-md-3 col-lg-3" style=" padding: 20px 20px">


                <select name="users" class=" input-xlarge focused my_input "   id="SelectAllProjectReport" style="height: 42px; " data-all="true">

                        <option selected disabled >Please select Project</option>
                    @if(isset($projectsList))

                            @foreach($projectsList as $key)

                                    <option value="<?= $key->id ?>"><?= $key->project_name ?></option>

                            @endforeach

                    @endif



                </select>

            </div>

            <!-- <h2  class="col-md-10 showDate"  id="timeTrackShowDate"></h2>-->
        </div>



        <div class="row-fluid">

            <!-- block -->
            <div class="block" style="border-bottom: 1px solid #ccc; border-left: none; border-right: none">

                <div class="block-content collapse in">
                    <div class="span12">


                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="usersTable">
                            <thead>
                            <tr>
                                <th width="130px">Person</th>
                                <!--  <th>User</th> -->

                                <!--  <th>Date Start</th>
                                 <th>Date Finish</th>-->
                                <th>Task</th>
                                <th>Task Type</th>
                                <th>Hours</th>
                                <th>Value</th>
                                <th>Cost</th>
                                <th>Economy</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th class="thFoot" width="130px"></th>
                                <th class="thFoot" ></th>
                                <!-- <th class="thFoot" >User</th>-->

                                <!--  <th class="thFoot" >Date Start</th>
                                  <th class="thFoot" >Date Finish</th>-->

                                <th class="thFoot" ></th>
                                <th class="thFoot" ></th>
                                <th class="thFoot" ></th>
                                <th class="thFoot" ></th>
                                <th class="thFoot" ></th>

                            </tr>
                            </tfoot>

                            <tbody>


                            @if (isset($projectReport))
                                @foreach( $projectReport as $key => $task )
                                    <tr class="odd gradeX">
                                        <td>{{ $task->user->name }}</td>
                                        <td>{{ $task->task_titly }}</td>
                                        <td>{{ $task->task_type }}</td>
                                        <td>{{ $task->hours }}</td>
                                        <td>{{ $task->value }}</td>
                                        <td>{{ $task->cost }}</td>
                                        <td>{{ $task->economy }}</td>
                                    </tr>
                                @endforeach
                            @endif

                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                    @if( isset( $total ) )
                        <strong>Total:</strong><br>
                        <strong>Value: <?= $total['totalValue'] ?> </strong> |
                        <strong>Cost: <?= $total['totalCost'] ?> </strong> |
                        <strong>Economy: <?= $total['totalEconomy'] ?> </strong>
                    @else
                        <strong>Total:</strong><br>
                        <strong>Value: 0 </strong> |
                        <strong>Cost: 0 </strong> |
                        <strong>Economy: 0 </strong>
                    @endif
                    </div>
                </div>

            </div>

            <!-- /block -->
        </div>




    </div>
    <!--    <script src="/js/jquery/jquery-3.1.1.min.js"></script>-->
    <script src="/js/tasks.js"></script>

@endsection
