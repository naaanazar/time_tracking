@extends('layouts.index_template')

@section('content')
    <?php $status = \Illuminate\Support\Facades\Auth::user()['original']['employe'] ?>

    <div class="modal fade" id="delete-client" role="dialog">
        <div class="modal-dialog"  >
            <!-- Modal content-->
            <div class="modal-content">
                <div id="modalConfirmDeleteClient"></div>
            </div>
        </div>
    </div>

    <div id="conteiner" class="container" data-status="{{\Illuminate\Support\Facades\Auth::user()['original']['employe']}}">
        <div class="row-fluid">
            <div class="span12">
                <h3 class="h3-my">Clients</h3>
                <a href="/client/create" style="display:inline-block; margin-left: 25px" class="btn btn-large button-orange">
                    <i class="glyphicon glyphicon-plus"></i> Add Client</a>
            </div>
        </div>

        <div class="row-fluid">

            <!-- block -->
            <div class="block" style="border-bottom: 1px solid #ccc; border-left: none; border-right: none">

                <div class="block-content collapse in">
                    <div class="span12">
                        <script>
                            $(document).ready(function() {
                                $('#usersTable').DataTable();
                            } );
                        </script>

                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="usersTable">
                            <thead>
                            <tr>
                                <th style="min-width: 130px">Company Name</th>
                                <th>Address</th>
                                <th>Website</th>
                                <th>Contact Persone</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th style="min-width: 160px"  class="center">Created at</th>
                                @if ($status == 'HR Manager' || $status == 'Admin')
                                    <th style="min-width: 140px">Action</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>

                            @foreach( $clients as $client )
                                <tr class="odd gradeX">
                                    <td>{{ $client->company_name }}</td>
                                    <td>{{ $client->company_address }}</td>
                                    <td>
                                        <a href="{{ $client->website }}">{{ $client->website }}</a>
                                        </td>
                                    <td>{{ $client->contact_person }}</td>
                                    <td>{{ $client->email }}</td>
                                    <td>{{ $client->phone_number }}</td>
                                    <td style="text-align: center">{{ $client->created_at }}</td>

                                    @if ($status == 'HR Manager' || $status == 'Admin')
                                        <td>
                                            @if ($status == 'Admin' ||
                                             ($status == 'HR Manager'))

                                                <a href="/client/update/{{ $client->id }}"  class="btn btn-info"> <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit</a>
                                                <button type="button" class="btn btn-danger  deleteClient" data-url="/client/delete/{{ $client->id }}" data-element="{{  $client->company_name  }}">
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
