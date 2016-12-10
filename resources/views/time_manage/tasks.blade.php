@extends('layouts.index_template')

@section('content')
    <?php $status = \Illuminate\Support\Facades\Auth::user()['original']['employe'] ?>

    <div class="modal fade" id="delete-task" role="dialog">
        <div class="modal-dialog"  >
            <!-- Modal content-->
            <div class="modal-content">
                <div id="modalConfirmDeleteTask"></div>
            </div>
        </div>
    </div>

    <div id="conteiner" class="container" data-status="{{\Illuminate\Support\Facades\Auth::user()['original']['employe']}}">
        <div class="row-fluid">
            <div class="span12">
                <h3 class="h3-my">Tasks</h3>
                <a href="/task/create" style="display:inline-block; margin-left: 25px" class="btn btn-large button-orange">
                    <i class="glyphicon glyphicon-plus"></i> Add Task</a>
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
                                <th>Title</th>
                                <th>Company</th>
                                <th>Project</th>
                                <th>Task Type</th>
                                <th>Allocated Hours</th>
                                <th>Assign To</th>
                                <th>Billable</th>
                                <th>Created at</th>
                                @if ($status == 'Admin')
                                    <th style="min-width: 140px">Action</th>
                                @endif
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Title</th>
                                <th>Company</th>
                                <th>Project</th>
                                <th>Task Type</th>
                                <th>Allocated Hours</th>
                                <th>Assign To</th>
                                <th>Billable</th>
                                <th>Created at</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @if (isset($tasksRes))
                                @foreach( $tasksRes as $key )
                                    <tr class="odd gradeX">
                                        <td>{{ $key['title'] }}</td>
                                        <td>{{ $key['company'] }}</td>
                                        <td>{{ $key['project_name'] }}</td>
                                        <td>{{ $key['type'] }}</td>
                                        <td>{{ $key['alloceted_hours'] }}</td>
                                        <td>{{ $key['user_name'] }}</td>
                                        <td style="text-align: center"> <?= ( $key['billable'] == '1') ? 'Yes' : 'No' ?> </td>
                                        <td style="text-align: center">{{ $key['created_at'] }}</td>

                                        @if ($status == 'Admin')
                                            <td>
                                                @if ($status == 'Admin' )

                                                    <a href="/task/update/{{ $key['id']  }}"  class="btn btn-info"> <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit</a>
                                                    <button type="button" class="btn btn-danger  deleteTask" data-url="/task/delete/{{ $key['id'] }}" data-element="{{  $key['title'] }}">
                                                        <span class="glyphicon glyphicon-floppy-remove" aria-hidden="true"></span> Delete</button>
                                                @endif
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
