@extends('layouts.index_template')

@section('content')
    <?php $status = \Illuminate\Support\Facades\Auth::user()['original']['employe'] ?>

    <div class="modal fade" id="delete-project" role="dialog">
        <div class="modal-dialog"  >
            <!-- Modal content-->
            <div class="modal-content">
                <div id="modalConfirmDeleteProject"></div>
            </div>
        </div>
    </div>

    <div id="conteiner" class="container" data-status="{{\Illuminate\Support\Facades\Auth::user()['original']['employe']}}">
        <div class="row-fluid">
            <div class="span12">
                <h3 class="h3-my">Projects</h3>
                <a href="/project/create" style="display:inline-block; margin-left: 25px" class="btn btn-large button-orange">
                    <i class="glyphicon glyphicon-plus"></i> Add Project</a>
            </div>
        </div>

        <div class="row-fluid">

            <!-- block -->
            <div class="block" style="border-bottom: 1px solid #ccc; border-left: none; border-right: none">

                <div class="block-content collapse in">
                    <div class="span12">
                        <script>

                        </script>



                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="usersTable">
                            <thead>
                            <tr>

                                <th>Project</th>
                                <th>Company</th>
                                <th>Lead</th>
                                <th>Hourly Rate</th>
                                <th>Created at</th>
                                @if ($status == 'Admin')
                                    <th style="min-width: 140px">Action</th>
                                @endif
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>

                                <th>Project</th>
                                <th>Company</th>
                                <th>Lead</th>
                                <th>Hourly Rate</th>
                                <th>Created at</th>

                            </tr>
                            </tfoot>
                            <tbody>


                            @foreach( $projects as $project )
                                <tr class="odd gradeX">
                                    <td>{{ $project->project_name }}</td>
                                    <td>{{ $project->company_name }}</td>
                                    <td>{{ $project->name }}</td>
                                    <td>{{ $project->hourly_rate }}</td>
                                    <td style="text-align: center">{{ $project->created_at }}</td>

                                    @if ($status == 'Admin')
                                        <td>
                                            @if ($status == 'Admin' )

                                                <a href="/project/update/{{ $project->id }}"  class="btn btn-info"> <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit</a>
                                                <button type="button" class="btn btn-danger  deleteProject" data-url="/project/delete/{{ $project->id }}" data-element="{{  $project->project_name  }}">
                                                    <span class="glyphicon glyphicon-floppy-remove" aria-hidden="true"></span> Delete</button>
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /block -->
        </div>
    </div>

@endsection
