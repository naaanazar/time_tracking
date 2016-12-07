@extends('layouts.index_template')

@section('content')

        <div id="conteiner" data-status="{{\Illuminate\Support\Facades\Auth::user()['original']['employe']}}"></div>

        <div class="container">
            <div class="row-fluid">
                <div class="span12 heading-top-margin">

                    <div class="heading-without-datepicker">Create Team</div>
                </div>
            </div>
            <div class="row-fluid" id="login" >
                <!-- block -->
                <div class="block-content collapse in">
                    <div class="span12">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/team/create') }}">
                            {{ csrf_field() }}
                                <div class="control-group">
                                    <label class="control-label" for="focusedInput">Team name</label>
                                    <div class="controls">
                                        <input name="team_name" class="input-xlarge focused" id="focusedInput" autofocus type="text">
                                        @if ($errors->has('team_name'))
                                            <span class="help-block">
                                            <strong style="color:#802420">{{ $errors->first('team_name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
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
