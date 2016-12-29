@extends('layouts.index_template')

@section('content')

    <?php var_dump($peopleReport) ?>

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
            <div class="col-md-3 btn-toolbar" style="vertical-align: inherit; font-size: large ">

                <div class="daterange daterange--double one"></div>

            </div>
            <div class="col-md-3 " style="vertical-align: inherit; padding: 20px 20px">


                <select name="assign_to" class=" input-xlarge focused my_input "   id="SelectAllUserReport" style="height: 42px; " data-all="true">
                    @if(isset($users))
                        <option selected disabled value="">Please select Person</option>
                        <optgroup label="Lead">
                            @if (isset($users['Lead']))
                                @foreach($users['Lead'] as $key)
                                    <option value="<?= $key->id ?>"><?= $key->name ?></option>
                                @endforeach
                            @endif

                        </optgroup>
                        <optgroup label="Developer">
                            @if (isset($users['Developer']))
                                @foreach($users['Developer'] as $key)
                                    <option value="<?= $key->id ?>"><?= $key->name ?></option>
                                @endforeach
                            @endif

                        </optgroup>
                        <optgroup label="QA Engineer">
                            @if (isset($users['QA Engineer']))
                                @foreach($users['QA Engineer'] as $key)
                                    <option value="<?= $key->id ?>"><?= $key->name ?></option>
                                @endforeach
                            @endif

                        </optgroup>
                        <optgroup label="Supervisor">
                            @if (isset($users['Supervisor']))
                                @foreach($users['Supervisor'] as $key)
                                    <option value="<?= $key->id ?>"><?= $key->name ?></option>
                                @endforeach
                            @endif

                        </optgroup>
                        <optgroup label="Admin">
                            @if (isset($users['Admin']))
                                @foreach($users['Admin'] as $key)
                                    <option value="<?= $key->id ?>"><?= $key->name ?></option>
                                @endforeach
                            @endif

                        </optgroup>


                    @endif

                        <option selected disabled></option>

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
                                <th width="130px">Person Name</th>
                                <th>Project</th>
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
                                <th class="thFoot" ></th>

                            </tr>
                            </tfoot>

                            <tbody>


                            @if (isset($peopleReport))

                                @foreach( $peopleReport as $key )

                                    <tr class="odd gradeX">
                                        <td>{{ $key->user->name }}</td>
                                        <td>{{ $key->client->company_name }}</td>
                                        <td>{{ $key->project->project_name }}</td>
                                        <td>{{ $key->task_titly }}</td>
                                        <td>{{ $key->task_type }}</td>
                                        <td>{{ $key->total }}</td>
                                        <td>{{ $key->value }}</td>
                                    </tr>
                                @endforeach
                            @endif

                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <strong>Total:</strong><br>
                        <strong>Hours </strong><br>
                        <strong>Value </strong>
                    </div>
                </div>

            </div>

            <!-- /block -->
        </div>




    </div>
    <!--    <script src="/js/jquery/jquery-3.1.1.min.js"></script>-->
    <script src="/js/tasks.js"></script>

@endsection
