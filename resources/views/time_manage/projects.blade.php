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

    <div id="conteiner" class="container" data-status="{{\Illuminate\Support\Facades\Auth::user()['original']['employe']}}"
            data-msg="<?= isset($notyfi['msg']) ? $notyfi['msg'] : '' ?>" data-theme="<?=isset($notyfi['theme']) ? $notyfi['theme'] : '' ?>">
        @if (!isset($projectsForClient))
            <div class="row-fluid">
                <div class="span12">
                        <h3 class="h3-my">Projects</h3>
                    @if ($status == 'Admin'  || $status == 'Supervisor' || $status == 'Lead')
                        <a href="/project/create" style="display:inline-block; margin-left: 25px" class="btn btn-large button-orange">

                            <i class="glyphicon glyphicon-plus"></i> Add Project
                        </a>
                    @endif
                </div>
            </div>
        @else

            <div class="row-fluid">
              <!--  <div class="span12 add-border-bottom">
                    <h2 class="h3-my">Projects: <strong>{{ $client->company_name }}</strong></h2>
                </div>-->
            </div>
            <br>
        <div class="row my_row">
            <div class = "col-lg-7 col-md-7 col-sm-8 col-xs-12">
                
                <div class="bs-calltoaction bs-calltoaction-default">
                    <div class="row">
                        <div class="col-md-9 cta-contents">
                            <div class="span12 add-border-bottom">
                                <h1 class="h3-my">Client: <strong>{{ $client->company_name }}</strong></h1>
                            </div>
                            <div class="cta-desc" style="margin-top: 20px">
                                <div class="row ">
                                    <div class="col-xs-6 col-sm-6 col-md-5 col-lg-5" style="text-align: right;">
                                        <label class="control-label" for="ProjectNameId" style="text-align: left;">Company</label>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-7 col-lg-7">
                                        {{ $client->company_name }}
                                    </div>
                                </div>
                                <div class="row my_row">
                                    <div class="col-xs-6 col-sm-6 col-md-5 col-lg-5" style="text-align: right;">
                                        <label class="control-label" for="ProjectNameId" style="text-align: left;">Address</label>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-7 col-lg-7">
                                        {{ $client->company_address }}
                                    </div>
                                </div>
                                <div class="row my_row">
                                    <div class="col-xs-6 col-sm-6 col-md-5 col-lg-5" style="text-align: right;">
                                        <label class="control-label" for="ProjectNameId" style="text-align: left;">Website</label>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-7 col-lg-7" >
                                        <a href="{{ $client->website }}">{{ $client->website }}</a>
                                    </div>
                                </div>
                                <div class="row my_row">
                                    <div class="col-xs-6 col-sm-6 col-md-5 col-lg-5" style="text-align: right;">
                                        <label class="control-label" for="ProjectNameId" style="text-align: left;">Contact Person</label>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-7 col-lg-7">
                                        {{ $client->contact_person }}
                                    </div>
                                </div>

                                </div>
                                <div class="row my_row">
                                    <div class="col-xs-6 col-sm-6 col-md-5 col-lg-5" style="text-align: right;">
                                        <label class="control-label" for="ProjectNameId" style="text-align: left;">Email</label>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-7 col-lg-7" >
                                        {{ $client->email }}
                                    </div>
                                </div>
                                <div class="row my_row">
                                    <div class="col-xs-6 col-sm-6 col-md-5 col-lg-5" style="text-align: right;">
                                        <label class="control-label labelMy" for="ProjectNameId" style="text-align: left;">Phone number</label>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-7 col-lg-7" >
                                        {{ $client->phone_number }}
                                    </div>
                                </div>
                            </div>


                        <div class="col-md-3 cta-button">

                            <a href="/client/update/{{ $client->id }}" style="display:inline-block; margin-left: 25px" class="btn btn-info">
                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit Client
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


            <div class="row my_row">

            </div>

        <div class="add-border-bottom row my_row">

        </div>


        @endif
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
                                    <th style="min-width: 140px; width: 140px;" class="center">Action</th>
                                @endif
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th class="thFoot">Project</th>
                                <th class="thFoot">Company</th>
                                <th class="thFoot">Lead</th>
                                <th class="thFoot">Hourly Rate</th>
                                <th class="thFoot">Created at</th>
                                @if ($status == 'Admin')
                                <th class="removeSelect" >Action</th>
                                @endif

                            </tr>
                            </tfoot>
                            @if(isset($projects))
                                <tbody>

                                @foreach( $projects as $project )
                                    <tr class="odd gradeX getTasks" data-id="{{ $project->id }}">
                                        <td>{{ $project->project_name }}</td>
                                        <td>{{ (isset($client->company_name)) ? $client->company_name : $project->company_name }}</td>
                                        <td>{{ $project->name }}</td>
                                        <td style="text-align: center;">{{ $project->hourly_rate }}</td>
                                        <td style="text-align: center" >{{ $project->created_at }}</td>

                                        @if ($status == 'Admin')
                                            <td class="actionForms" style="text-align: center;">
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
                            @endif
                        </table>
                    </div>
                </div>
            </div>
            <!-- /block -->
        </div>
    </div>

@endsection
