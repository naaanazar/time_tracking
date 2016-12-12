@extends('layouts.index_template')

@section('content')
    <?php $status = \Illuminate\Support\Facades\Auth::user()['original']['employe'] ?>

    <div class="modal fade" id="delete-user" role="dialog">
        <div class="modal-dialog"  >
            <!-- Modal content-->
            <div class="modal-content">
                <div id="modalConfirmDeleteUser"></div>
            </div>
        </div>
    </div>

    <div id="conteiner" class="container" data-status="{{\Illuminate\Support\Facades\Auth::user()['original']['employe']}}">
        <div class="row">
            <div class="col-md-2 btn-toolbar">
                <div id="timeStep5" class="btn-group">
                    <button class="btn btn-sm" ng-click="prevDay()" ns-popover="" ns-popover-timeout="0" ns-popover-plain="true" ns-popover-template="previous day" ns-popover-trigger="mouseover" ns-popover-placement="top|center">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </button>
                    <button class="btn btn-sm" ng-click="nextDay()" ns-popover="" ns-popover-timeout="0" ns-popover-plain="true" ns-popover-template="next day" ns-popover-trigger="mouseover" ns-popover-placement="top|center">
                        <span class="glyphicon glyphicon-chevron-right"></span>			</button>			<button class="btn btn-sm ng-isolate-scope ng-pristine ng-valid" date-range-picker="" name="date" ng-model="date" options="datePickerOptions" ns-popover="" ns-popover-timeout="0" ns-popover-plain="true" ns-popover-template="jump to specific date" ns-popover-trigger="mouseover" ns-popover-placement="top|center" value="2016-12-12">
                        <i class="glyphicon glyphicon-calendar"></i></button>
                </div>
            </div>


        </div>


    </div>


@endsection
