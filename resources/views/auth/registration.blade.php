@extends('layouts.index_template')

@section('content')


        <div class="container">
            <div class="row-fluid">
                <div class="span12 heading-top-margin">

                    <div class="heading-without-datepicker">Manage Client</div>
                </div>
            </div>


            <div class="row-fluid" id="login" >
                <!-- block -->
                <div class="block-content collapse in">
                    <div class="span12">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/user/create') }}">
                            {{ csrf_field() }}
                                <div class="control-group">
                                    <label class="control-label" for="focusedInput">User type</label>
                                    <div class="controls">
                                        <select name="employe" class="input-xlarge focused" id="focusedInput" >
                                            <option>Admin</option>
                                            <option>Supervisor</option>
                                            <option>Lead</option>
                                            <option>Developer</option>
                                            <option>QA Engineer</option>
                                            <option>HR Manager</option>
                                        </select>

                                    </div>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif

                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="focusedInput">Name</label>
                                    <div class="controls">
                                        <input name="name" class="input-xlarge focused" id="focusedInput"  type="text">
                                    </div>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif

                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="focusedInput">Email</label>
                                    <div class="controls">
                                        <input name="email" class="input-xlarge focused" id="focusedInput"  type="email" required>
                                    </div>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="focusedInput">Team</label>
                                    <div class="controls">
                                        <input name="team_name" class="input-xlarge focused" id="focusedInput"  type="textl" required>
                                    </div>
                                    @if ($errors->has('team_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('team_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-large btn-primary" formaction="">Save</button> &nbsp;&nbsp;
                                    <button type="submit" class="btn btn-large btn-primary" formaction="{{ url('/') }}">Cancel</button>
                                </div>
                    </div>
                </div>
                <!-- /block -->
            </div>



        </div>
@endsection
