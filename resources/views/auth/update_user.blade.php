@extends('layouts.index_template')

@section('content')
    <?php $status = \Illuminate\Support\Facades\Auth::user()['original']['employe'] ?>
    <div id="conteiner" data-status="{{\Illuminate\Support\Facades\Auth::user()['original']['employe']}}"></div>

    <div class="container">
        <div class="row-fluid">
            <div class="span12 heading-top-margin">

                <div class="heading-without-datepicker">Edit User</div>
            </div>
        </div>
        <div class="row-fluid" id="login" >
            <!-- block -->
            <div class="block-content collapse in">
                <div class="span12">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/user/update/' . $user->id) }}">
                        {{ csrf_field() }}

                        <div class="control-group row" >
                            <label class="control-label col-sm-2" for="focusedInput">User type</label>
                            <div class="controls">
                                <select name="employe" class="input-xlarge focused" id="selectTeam" style="height: 42px;" >
                                    <option>{{ $user->employe }}</option>
                                    @if ($status == 'Admin')
                                        <option>Admin</option>
                                        <option>Supervisor</option>
                                        <option>HR Manager</option>
                                    @endif
                                    <option>Lead</option>
                                    <option>Developer</option>
                                    <option>QA Engineer</option>
                                </select>

                            </div>
                        </div>
                        <div class="control-group row">
                            <label class="control-label col-sm-2" for="focusedInput">Name</label>
                            <div class="controls">
                                <input name="name" class="input-xlarge focused" id="focusedInput" value="{{ $user->name }}"  type="text">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                            <strong style="color:#802420">{{ $errors->first('name') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="control-group row" id="hourlyRate"  style="display:none;">
                            <label class="control-label col-sm-2" for="hourlyRateId">Hourly rate</label>
                            <div class="controls">

                                <input name="hourlyRate" class="input-xlarge focused"  id="hourlyRateId" value="<?= $user->hourly_rate ?>" type="number" step="0.01">

                                @if ($errors->has('hourlyRate'))
                                    <span class="help-block">
                                                <strong>{{ $errors->first('hourlyRate') }}</strong>
                                            </span>
                                @endif
                            </div>

                        </div>
                        <div id="team_name" style="display:none;" class="control-group row">
                            <label class="control-label col-sm-2" for="focusedInput">Team</label>

                            @if( $teams == true )

                                <div class="controls">
                                    <select name="users_team_id" class="input-xlarge focused" style="height: 42px;">
                                        @if (isset($teamActive))
                                            <option value="{{ $teamActive->id }}" selected>{{ $teamActive->team_name }}</option>
                                        @else
                                            <option selected disabled>Please change Team</option>
                                        @endif

                                        @foreach( $teams as $team )

                                                <!--<input name="team_name" class="input-xlarge focused" id="focusedInput"  type="textl" required> -->
                                        <option value="{{ $team->id }}">{{ $team->team_name }}</option>

                                        @endforeach
                                            <option></option>

                                    </select>
                                </div>

                            @endif

                            @if ($errors->has('team_name'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('team_name') }}</strong>
                                        </span>
                            @endif
                        </div>
                        <div class="form-actions row">
                            <label class="control-label col-sm-2" for=""></label>
                            <button type="submit" class="btn btn-large button-orange" formaction="">Save</button> &nbsp;&nbsp;
                            <a  href="{{ url('/user/all') }}" class="btn btn-large button-orange" style="font-weight: normal;" >Cancel</a>
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

