@extends('layouts.index_template')

@section('content')
<?php $status = \Illuminate\Support\Facades\Auth::user()['original']['employe'] ?>
<div class="container" id="conteiner" data-status="{{\Illuminate\Support\Facades\Auth::user()['original']['employe']}}">

    <div class="row">
        <div class="row-fluid">
            <div class="heading-top-margin">
                <div class="heading-without-datepicker"><?= isset($client) ? 'Edit' : 'Add' ?> Client</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="row-fluid" id="login" >
            <!-- block -->
            <div class="block-content collapse in">
                <div class="span12">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/client/create') }}">
                        {{ csrf_field() }}

                        <div class="control-group row">
                            <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2" style="text-align: right;">
                                <label class="control-label" for="companeMameId" style="text-align: left;">Company Name</label>
                            </div>
                            <div class="controls col-xs-8 col-sm-6 col-md-5 col-lg-4">

                                <input name="company_name" class="input-xlarge focused my_input" id="companeMameId"  autofocus type="text"
                                        value="<?= isset($client->company_name) ? $client->company_name : ((old('company_name')) ? old('company_name') : '') ?>"/>
                                @if ($errors->has('company_name'))
                                    <span class="help-block">
                                                <strong style="color:#802420">{{ $errors->first('company_name') }}</strong>
                                            </span>
                                @endif
                            </div>
                        </div>

                        <div class="control-group row">
                            <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2" style="text-align: right;">
                                <label class="control-label" for="AddressId" style="text-align: left;">Address</label>
                            </div>
                            <div class="controls col-xs-8 col-sm-6 col-md-5 col-lg-4">
                                <input name="company_address" class="input-xlarge focused my_input" id="AddressId"   type="text"
                                       value="<?= isset($client->company_address) ? $client->company_address : ((old('company_address')) ? old('company_address') :'') ?>"/>
                                @if ($errors->has('compane_address'))
                                    <span class="help-block">
                                                <strong style="color:#802420">{{ $errors->first('compane_address') }}</strong>
                                            </span>
                                @endif
                            </div>
                        </div>

                        <div class="control-group row">
                            <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2" style="text-align: right;">
                                <label class="control-label" for="WebsiteId" style="text-align: left;">Website</label>
                            </div>
                            <div class="controls col-xs-8 col-sm-6 col-md-5 col-lg-4">
                                <input name="website" class="input-xlarge focused my_input" id="WebsiteId"  type="text"
                                       value="<?= isset($client->website) ? $client->website : ((old('website')) ? old('website') :'') ?>"/>
                                @if ($errors->has('website'))
                                    <span class="help-block">
                                                <strong style="color:#802420">{{ $errors->first('website') }}</strong>
                                            </span>
                                @endif
                            </div>
                        </div>

                        <div class="control-group row">
                            <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2" style="text-align: right;">
                                <label class="control-label" for="ContactPersonId" style="text-align: left;">Contact Person</label>
                            </div>
                            <div class="controls col-xs-8 col-sm-6 col-md-5 col-lg-4">
                                <input name="contact_person" class="input-xlarge focused my_input" id="ContactPersonId"   type="text"
                                       value="<?= isset($client->contact_person) ? $client->contact_person : ((old('contact_person')) ? old('contact_person') :'') ?>"/>
                                @if ($errors->has('contact_person'))
                                    <span class="help-block">
                                                <strong style="color:#802420">{{ $errors->first('contact_person') }}</strong>
                                            </span>
                                @endif
                            </div>
                        </div>

                        <div class="control-group row">
                            <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2" style="text-align: right;">
                                <label class="control-label" for="emailClientId" style="text-align: left;">Email</label>
                            </div>
                            <div class="controls col-xs-8 col-sm-6 col-md-5 col-lg-4">
                                <input type="email" name="email" class="input-xlarge focused my_input" id="emailClientId"  required
                                       value="<?= isset($client->email) ? $client->email : ((old('email')) ? old('email') :'') ?>"/>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                                <strong style="color:#802420">{{ $errors->first('email') }}</strong>
                                            </span>
                                @endif
                            </div>
                        </div>

                        <div class="control-group row">
                            <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2" style="text-align: right;">
                                <label class="control-label" for="PhoneNumberId" style="text-align: left;">Phone Number</label>
                            </div>
                            <div class="controls col-xs-8 col-sm-6 col-md-5 col-lg-4">
                                <input name="phone_number" class="input-xlarge focused my_input" id="PhoneNumberId"   type="text"
                                value="<?= isset($client->phone_number) ? $client->phone_number : ((old('phone_number')) ? old('phone_number') :'') ?>">
                                @if ($errors->has('phone_number'))
                                    <span class="help-block">
                                                <strong style="color:#802420">{{ $errors->first('phone_number') }}</strong>
                                            </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-actions row">
                            <label class="control-label col-sm-2" for=""></label>
                            <button type="submit" class="btn btn-large button-orange" formaction="">Save</button> &nbsp;&nbsp;
                            <a  href="{{ url('/client/all') }}" class="btn btn-large button-orange" style="font-weight: normal;" >Cancel</a>
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
