@extends('layouts.index_template')

@section('content')
<?php $status = \Illuminate\Support\Facades\Auth::user()['original']['employe'] ?>
<div class="container" id="conteiner" data-status="{{\Illuminate\Support\Facades\Auth::user()['original']['employe']}}">

    <div class="row">
        <div class="row-fluid">
            <div class="heading-top-margin">

                <div class="heading-without-datepicker">Create Client</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="row-fluid" id="login" >
            <!-- block -->
            <div class="block-content collapse in">
                <div class="span12">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('') }}">
                        {{ csrf_field() }}

                        <div class="control-group row">
                            <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2" style="text-align: right;">
                                <label class="control-label" for="companeMameId" style="text-align: left;">Company Name</label>
                            </div>
                            <div class="controls col-xs-8 col-sm-6 col-md-5 col-lg-4">
                                <input name="" class="input-xlarge focused my_input" id="companeMameId"  autofocus type="text">
                                @if ($errors->has(''))
                                    <span class="help-block">
                                                <strong style="color:#802420">{{ $errors->first('') }}</strong>
                                            </span>
                                @endif
                            </div>
                        </div>

                        <div class="control-group row">
                            <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2" style="text-align: right;">
                                <label class="control-label" for="AddressId" style="text-align: left;">Address</label>
                            </div>
                            <div class="controls col-xs-8 col-sm-6 col-md-5 col-lg-4">
                                <input name="" class="input-xlarge focused my_input" id="AddressId"   type="text">
                                @if ($errors->has(''))
                                    <span class="help-block">
                                                <strong style="color:#802420">{{ $errors->first('') }}</strong>
                                            </span>
                                @endif
                            </div>
                        </div>

                        <div class="control-group row">
                            <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2" style="text-align: right;">
                                <label class="control-label" for="WebsiteId" style="text-align: left;">Website</label>
                            </div>
                            <div class="controls col-xs-8 col-sm-6 col-md-5 col-lg-4">
                                <input name="" class="input-xlarge focused my_input" id="WebsiteId"  type="text">
                                @if ($errors->has(''))
                                    <span class="help-block">
                                                <strong style="color:#802420">{{ $errors->first('') }}</strong>
                                            </span>
                                @endif
                            </div>
                        </div>

                        <div class="control-group row">
                            <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2" style="text-align: right;">
                                <label class="control-label" for="ContactPersonId" style="text-align: left;">Contact Person</label>
                            </div>
                            <div class="controls col-xs-8 col-sm-6 col-md-5 col-lg-4">
                                <input name="" class="input-xlarge focused my_input" id="ContactPersonId"   type="text">
                                @if ($errors->has(''))
                                    <span class="help-block">
                                                <strong style="color:#802420">{{ $errors->first('') }}</strong>
                                            </span>
                                @endif
                            </div>
                        </div>

                        <div class="control-group row">
                            <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2" style="text-align: right;">
                                <label class="control-label" for="emailClientId" style="text-align: left;">Email</label>
                            </div>
                            <div class="controls col-xs-8 col-sm-6 col-md-5 col-lg-4">
                                <input name="" class="input-xlarge focused my_input" id="emailClientId"   type="email">
                                @if ($errors->has(''))
                                    <span class="help-block">
                                                <strong style="color:#802420">{{ $errors->first('') }}</strong>
                                            </span>
                                @endif
                            </div>
                        </div>

                        <div class="control-group row">
                            <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2" style="text-align: right;">
                                <label class="control-label" for="PhoneNumberId" style="text-align: left;">Phone Number</label>
                            </div>
                            <div class="controls col-xs-8 col-sm-6 col-md-5 col-lg-4">
                                <input name="" class="input-xlarge focused my_input" id="PhoneNumberId"   type="text">
                                @if ($errors->has(''))
                                    <span class="help-block">
                                                <strong style="color:#802420">{{ $errors->first('') }}</strong>
                                            </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-actions row">
                            <label class="control-label col-sm-2" for=""></label>
                            <button type="submit" class="btn btn-large button-orange" formaction="">Save</button> &nbsp;&nbsp;
                            <a  href="{{ url('') }}" class="btn btn-large button-orange" style="font-weight: normal;" >Cancel</a>
                        </div>

                    </form>
                </div>
            </div>
            <!-- /block -->
        </div>
    </div>
</div>
<script src="/js/jquery/jquery-3.1.1.min.js"></script>
<script src="/js/registration.js"></script>
@endsection
