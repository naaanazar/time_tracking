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
                                <div class="control-group row">
                                    <label class="control-label col-sm-2" for="focusedInput">Team name</label>
                                    <div class="controls">
                                        <input name="team_name" class="input-xlarge focused" id="focusedInput" autofocus required type="text">
                                        @if ($errors->has('team_name'))
                                            <span class="help-block">
                                            <strong style="color:#802420">{{ $errors->first('team_name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-actions row">
                                    <label class="control-label col-sm-2" for="focusedInput"></label>
                                    <button type="submit" class="btn btn-large button-orange" formaction="">Save</button> &nbsp;&nbsp;
                                    <a  href="{{ url('/team/all') }}" class="btn btn-large button-orange" style="font-weight: normal;" >Cancel</a>
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
