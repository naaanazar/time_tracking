@extends('layouts.index_template')

@section('content')
    <a href="#" data-toggle="tooltip" title="Текст всплывающей подсказки">

        <div class="container">
            <div class="row-fluid">
                <div class="span12 heading-top-margin">

                    <div class="heading-without-datepicker">Manage Client</div>
                </div>
            </div>


            <div class="row-fluid">
                <!-- block -->
                <div class="block-content collapse in">
                    <div class="span12">
                        <form class="form-horizontal">
                            <fieldset>
                                <div class="control-group">
                                    <label class="control-label" for="focusedInput">Name</label>
                                    <div class="controls">
                                        <input class="input-xlarge focused" id="focusedInput"  type="text">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="focusedInput">Contact person</label>
                                    <div class="controls">
                                        <input class="input-xlarge focused" id="focusedInput"  type="text">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="focusedInput">Email</label>
                                    <div class="controls">
                                        <input class="input-xlarge focused" id="focusedInput" placeholder="info@ignatiuz.com" type="text">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="focusedInput">Phone</label>
                                    <div class="controls">
                                        <input class="input-xlarge focused" id="focusedInput" placeholder="+91-731-2970115" type="text">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="textarea2">Address</label>
                                    <div class="controls">
                                        <textarea class="input-xlarge textarea" placeholder="Enter text ..." style="width: 810px; height: 200px"></textarea>
                                    </div>
                                </div>

                                <hr>
                                <div class="control-group">
                                    <label class="control-label" for="focusedInput">Approval</label>
                                    <div class="controls">
                                        <label class="uniform">
                                            <input class="uniform_on manage-client" type="checkbox" id="optionsCheckbox" value="option1">

                                        </label>
                                        <span class="check-box-title"> Admin must approve track logs for this client </span>
                                    </div>
                                </div>


                                <div class="form-actions">
                                    <button type="submit" class="btn btn-large btn-primary" formaction="approval.html">Save</button> &nbsp;&nbsp;
                                    <button type="submit" class="btn btn-large btn-primary" formaction="login.html">Cancel</button>
                                </div>

                    </div>
                </div>
                <!-- /block -->
            </div>



        </div>
@endsection
