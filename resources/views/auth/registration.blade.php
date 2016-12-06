@extends('layouts.index_template')

@section('content')

        <div id="conteiner" data-status="{{\Illuminate\Support\Facades\Auth::user()['original']['employe']}}"></div>

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

                                <div class="control-group" >
                                    <label class="control-label" for="focusedInput">User type</label>
                                    <div class="controls">
                                        <select name="employe" class="input-xlarge focused" id="selectTeam" style="height: 42px;width: 37%" >

                                            <option>Admin</option>
                                            <option>Supervisor</option>
                                            <option>Lead</option>
                                            <option>Developer</option>
                                            <option>QA Engineer</option>
                                            <option>HR Manager</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="focusedInput">Name</label>
                                    <div class="controls">
                                        <input name="name" class="input-xlarge focused" id="focusedInput"  type="text">
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                            <strong style="color:#802420">{{ $errors->first('name') }}</strongstyle>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="focusedInput">Email</label>
                                    <div class="controls">
                                        <input name="email" class="input-xlarge focused"   type="email" required>
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="control-group" id="hourlyRate"  style="display:none;">
                                    <label class="control-label" for="hourlyRateId">Hourly rate</label>
                                    <div class="controls">
                                        <input name="hourlyRate" class="input-xlarge focused"  id="hourlyRateId"  type="number" step="0.01" required>
                                        @if ($errors->has('hourlyRate'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('hourlyRate') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div id="team_name" style="display:none;" class="control-group">
                                    <label class="control-label" for="focusedInput">Team</label>

                                    @if( $teams == true )

                                    <div class="controls">
                                        <select name="team_name" class="input-xlarge focused" style="height: 42px;width: 37%">
                                            <option value="" disabled selected>Select team</option>

                                        @foreach( $teams as $team )

                                        <!--<input name="team_name" class="input-xlarge focused" id="focusedInput"  type="textl" required> -->
                                            <option>{{ $team->team_name }}</option>

                                        @endforeach

                                        </select>
                                    </div>

                                    @endif

                                    @if ($errors->has('team_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('team_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-large btn-primary" formaction="">Save</button> &nbsp;&nbsp;
                                    <a  href="{{ url('/') }}" class="btn btn-large btn-primary" style="font-weight: normal;" >Cancel</a>
                                </div>

                        </form>
                    </div>
                </div>
                <!-- /block -->
            </div>
        </div>
        <script src="/js/jquery/jquery-3.1.1.min.js"></script>
        <script src="/js/registration.js"></script>
@endsection
