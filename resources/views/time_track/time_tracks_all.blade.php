@extends('layouts.index_template')

@section('content')
    <?php $status = \Illuminate\Support\Facades\Auth::user()['original']['employe'] ?>

    <div class="modal fade" id="delete-track" role="dialog">
        <div class="modal-dialog"  >
            <!-- Modal content-->
            <div class="modal-content">
                <div id="modalConfirmDeleteTrack"></div>
            </div>
        </div>
    </div>

    <div id="conteiner" class="container" data-status="{{\Illuminate\Support\Facades\Auth::user()['original']['employe']}}">
        <div class="row-fluid">
            <div class="span12">
                <h3 class="h3-my">Tracks</h3>
              <!--  <a href="/user/create" style="display:inline-block; margin-left: 25px" class="btn btn-large button-orange">
                    <i class="glyphicon glyphicon-plus"></i> Add User</a> -->
            </div>

        </div>

        <div class="row-fluid">

            <!-- block -->
            <div class="block" style="border-bottom: 1px solid #ccc; border-left: none; border-right: none">

                <div class="block-content collapse in">
                    <div class="span12">


                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="usersTable">
                            <thead>
                            <tr>
                                <th width="130px">Project</th>
                                <th>Task</th>
                                <!--  <th>User</th> -->
                                <th>Approve</th>
                               <!--  <th>Date Start</th>
                                <th>Date Finish</th>-->
                                <th>Duration</th>
                                <th>total_time</th>
                                <th>Billable</th>
                                <th>Cost</th>
                                <th>Status</th>
                                <th>Created at</th>
                                <th>Finish at</th>
                                @if ($status == 'Lead' || $status == 'Admin' || $status == 'Supervisor')
                                    <th style="min-width:250px; width: 250px;" class="center">Action</th>
                                @endif
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th class="thFoot" width="130px">Project</th>
                                <th class="thFoot" >Task</th>
                               <!-- <th class="thFoot" >User</th>-->
                                <th class="thFoot" >Approv</th>
                              <!--  <th class="thFoot" >Date Start</th>
                                <th class="thFoot" >Date Finish</th>-->
                                <th class="thFoot" >Duration</th>
                                <th class="thFoot" >total_time</th>
                                <th class="thFoot" >Billable</th>
                                <th class="thFoot" >Cost</th>
                                <th class="thFoot" >Status</th>
                                <th class="thFoot" >Created at</th>
                                <th class="thFoot" >Finish at</th>
                                @if ($status == 'Lead' || $status == 'Admin' || $status == 'Supervisor')
                                    <th  class="removeSelect">Action</th>
                                @endif

                            </tr>
                            </tfoot>
                            <tbody>

                            @if (isset($tracks))
                                @foreach( $tracks as $key )
                                    <tr class="odd gradeX <?= $key->approve == 1 ? 'done_tr' : ($key->done == 1 ? 'done_tr2' : '')?>">
                                        <td>{{ $key->project->project_name }}</td>
                                        <td>{{ $key->task->task_titly }}</td>
                                        <td>{{ $key->approve == 1 ? 'Yes' : 'No' }}</td>
                                        <?php  $hours = (int)($key->duration/60);
                                        $minutes = bcmod($key->duration, 60);
                                        if (strlen($hours) < 2){
                                            $hours = '0' . $hours;
                                        }
                                        if (strlen($minutes) < 2){
                                            $minutes = '0' . $minutes;
                                        }
                                        ?>
                                        <td>{{ $key->duration ==null ? '-' :  $hours . ':' . $minutes }}</td>
                                        <td>{{ $key->total_time ==null ? '-' : date('H:i:s', $key->total_time) }}</td>
                                        <td>{{ $key->billable_time == 1 ? 'Yes' : 'No' }}</td>
                                        <td>{{ $key->additional_cost }}</td>
                                        <td>{{ $key->done == 1 ? 'Done' : 'In proccess' }}</td>
                                        <td>{{ $key->created_at }}</td>
                                        <td>{{ $key->finish_track }}</td>

                                        @if ($status == 'Lead' || $status == 'Admin' || $status == 'Supervisor')
                                            <td>
                                                @if($key->approve == 0 )
                                                <button  type="button" class="btn btn-success approvTrack"
                                                         <?= $key->done == 0 ? 'disabled' : '' ?>
                                                         data-url="/trask/approve/{{ $key->id }}" data-element="{{ $key->project->project_name . '-' . $key->task->task_titly}}">
                                                    <span class="glyphicon glyphicon-ok span_no_event" aria-hidden="true"></span> Approve
                                                </button>
                                                @endif
                                                @if($key->approve == 1)
                                                    <button  type="button" class="btn btn-warning  rejectTrack" data-url="/trask/reject/{{ $key->id }}" data-element="{{ $key->project->project_name . '-' . $key->task->task_titly}}">
                                                        &nbsp&nbsp<span class="glyphicon glyphicon-remove span_no_event" aria-hidden="true"></span> Reject &nbsp
                                                    </button>
                                                @endif

                                                <a href="/track/update/{{ $key->id }}"  class="btn btn-info"> <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit</a>
                                                    <button type="button" class="btn btn-danger deleteTrack" data-url="/track/delete/{{ $key->id }}" data-element="{{ $key->project->project_name . '-' . $key->task->task_titly}}">
                                                        <span class="glyphicon glyphicon-floppy-remove span_no_event" aria-hidden="true"></span> Delete</button>
                                            </td>
                                        @endif
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

@endsection
