@extends('layouts.index_template')

@section('content')
<div id="conteiner" class="container" data-status="{{\Illuminate\Support\Facades\Auth::user()['original']['employe']}}">

        <div class="modal fade" id="delete-team" role="dialog">
            <div class="modal-dialog"  >
                <!-- Modal content-->
                <div class="modal-content">
                    <div id="modalConfirmDeleteTeam">

                    </div>
                </div>
            </div>
        </div>

        <div class="row-fluid">
            <div class="span12">
                <h3 class="h3-my">Teams</h3>
                <a href="/team/create" style="display:inline-block; margin-left: 25px" class="btn btn-large button-orange">
                    <i class="glyphicon glyphicon-plus"></i> Add Team</a>
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
                                <th width="300px">Teams</th>
                                <th width="300px">Lead</th>
                                <th width="60px">Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach( $teams as $team )
                                <tr class="odd gradeX">
                                    <td>{{ $team->team_name }}</td>
                                    <td>{{ $team->name }}</td>

                                    <td style="text-align: center">
                     <button type="button" class="btn btn-danger  deleteTeam" data-url="/team/delete/{{ $team->id }}" data-element="{{ $team->team_name }}">
                                            <span class="glyphicon glyphicon-floppy-remove" aria-hidden="true"></span> Delete</button>

                                    </td>
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
</div>



@endsection
