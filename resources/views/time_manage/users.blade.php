@extends('layouts.index_template')

@section('content')

<div id="conteiner" class="container" data-status="{{\Illuminate\Support\Facades\Auth::user()['original']['employe']}}">
    <div class="row-fluid">
        <div class="span12">
            <h3 style="display:inline-block">Users</h3>
            <a href="/user/create" style="display:inline-block; margin-left: 25px" class="btn btn-large btn-primary">
                <i class="glyphicon glyphicon-plus"></i>Add User</a>
        </div>

    </div>
    <div class="row-fluid">

        <!-- block -->
        <div class="block" style="border-bottom: 1px solid #ccc; border-left: none; border-right: none">

            <div class="block-content collapse in">
                <div class="span12">

                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                        <thead>
                        <tr>
                            <th width="130px">Users</th>
                            <th>Email</th>
                            <th>Team</th>
                            <th>Hourly rate</th>
                            <th>User type</th>
                            <th width="160px"  class="center">Created at</th>


                            <th width="125px">

                            </th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach( $users as $user )
                            <tr class="odd gradeX">
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->team_name }}</td>
                                <td  style="text-align: center" class="center">{{ $user->hourly_rate }}</td>
                                <td>{{ $user->employe }}</td>
                                <td style="text-align: center">{{ $user->created_at }}</td>
                                <td>
                                    <a href="/user/update/{{ $user->id }}" class="btn btn-info"><span class="glyphicon glyphicon-floppy-remove" aria-hidden="true"></span>Edit</a>
                                    <a href="/user/delete/{{ $user->id }}" class="btn btn-danger"><span class="glyphicon glyphicon-floppy-remove" aria-hidden="true"></span>Delete</a>
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









@endsection
