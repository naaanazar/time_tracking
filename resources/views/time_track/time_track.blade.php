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
        <div class="row" style="margin-top: 20px">
            <div class="col-md-2 btn-toolbar" style="vertical-align: inherit">
                <div id="timeStep5" class="btn-group">
                    <button class="btn btn-sm">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </button>
                    <button class="btn btn-sm">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </button>
                    <button class="btn btn-sm ">
                        <i class="glyphicon glyphicon-calendar"></i>
                    </button>
                </div>
            </div>
            <h2  class="col-md-10 showDate"  id="timeTrackShowDate"></h2>
        </div>
        <div class="row" style="margin-top: 20px;     color: #999; font-size: 18px">
            <div class="col-md-6" >
                Add track log
            </div>
            <div class="col-md-6">
                Tracked
            </div>
        </div>


        <div class="row" style=" border-top: 1px solid #ccc;">

            <div class="col-sm-6 col-md-6 col-lg-6" style="border-right: 1px solid #ccc; padding-top: 20px">

                <form  method="POST" action="/trecking" id="addTrackForm">
                    {{ csrf_field() }}
                    <div class="form-group form-group-edit col-xs-12 col-sm-12 col-md-12 col-lg-12" >
                        <div class="col-xs-2 col-sm-4 col-md-3 col-lg-3" style="text-align: right;">
                            <label class="control-label labelTrack" for="trackProjectId">Project</label>
                        </div>
                        <div class="controls col-xs-12 col-sm-8 col-md-9 col-lg-9">
                                <select name="project_id" class="inputTrackPadding focused my_input"  id="trackProjectId" style="height: 35px;" required>
                                    <option selected disabled>select project</option>
                                    @foreach( $tasks as $task )
                                        <option value="{{ $task->id }}">{{ $task->project_name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('project_id'))
                                    <span class="help-block">
                                                <strong style="color:#802420">{{ $errors->first('project_id') }}</strong>
                                            </span>
                                @endif
                        </div>
                    </div>

                    <div class="form-group form-group-edit col-xs-12 col-sm-12 col-md-12 col-lg-12" >
                        <div class="col-xs-2 col-sm-4 col-md-3 col-lg-3" style="text-align: right;">
                            <label class="control-label labelTrack" for="trackTaskId">Task</label>
                        </div>
                        <div class="controls col-xs-12 col-sm-8 col-md-9 col-lg-9">

                            <select name="task_id" class="inputTrackPadding focused my_input"  id="trackTaskId"  style="height: 35px;" required>

                            </select>
                            @if ($errors->has('task_id'))
                                <span class="help-block">
                                                <strong style="color:#802420">{{ $errors->first('task_id') }}</strong>
                                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group form-group-edit col-xs-12 col-sm-12 col-md-12 col-lg-12" >
                        <div class="col-xs-2 col-sm-4 col-md-3 col-lg-3" style="text-align: right;">
                            <label class="control-label labelTrack" for="formTrackStart" >Start</label>
                        </div>

                        <div class="controls col-xs-12 col-sm-8 col-md-9 col-lg-9">
                            <div class="col-md-4 col-lg-4" style="padding: 0px">
                            <span class="input-group" >
                                <input type="text" value="" style="width: 60%" class="inputTrackPadding form-control" id="formTrackStart" placeholder="HH:MM" />

                                <span class="input-group-btn" style=" float:left ">
                                    <button type="button" class="btn btn-default" id="formTrackStartNow" style="padding:6px 1px">now</button>
                                    <button type="button" class="btn btn-default" id="formTrackStartInc" style="padding:6px 3px">+</button>
                                    <button type="button" class="btn btn-default" id="formTrackStartDec" style="padding:6px 3px">-</button>
                                </span>
                            </span>
                            </div>

                            <div class="col-sm-12 col-md-2 col-lg-2" style="padding: 0px; text-align: center;">
                                <label class="labelTrack" for="formTrackFinish">Finish</label>
                            </div>

                            <div class="col-md-4 col-lg-4" style="padding: 0px">
                            <span class="input-group" >
                                <input type="text"  style="width: 60%; " class="inputTrackPadding form-control"  id="formTrackFinish" placeholder="HH:MM">
                                <span class="input-group-btn" style=" float:left ">
                                    <button type="button" class="btn btn-default" id="formTrackFinishNow" style="padding:6px 1px">now</button>
                                    <button type="button" class="btn btn-default" id="formTrackFinishInc" style="padding:6px 3px">+</button>
                                    <button type="button" class="btn btn-default" id="formTrackFinishDec" style="padding:6px 3px">-</button>
                                </span>
                            </span>
                            </div>

                            <input id="formTrackStartSend"  type="hidden" name="date_start">
                            <input id="formTrackFinishSend" type="hidden" name="date_finish" >

                            <div class="col-md-2 col-lg-2" style="padding: 0px">
                               <span class="" style="display: inline-block">
                                <label class = "labelTrack">
                                    <input type="checkbox" id="nextDay" name="nextDate"> Next Day
                                </label>
                             </span>
                            </div>

                        </div>
                    </div>

                    <div class="form-group form-group-edit col-xs-12 col-sm-12 col-md-12 col-lg-12" >
                        <div class="col-xs-2 col-sm-4 col-md-3 col-lg-3" style="text-align: right;">
                            <label class="control-label labelTrack" for="timeDuration" style="text-align: left; padding-top: 10px">Duration</label>
                        </div>
                        <div class="controls col-xs-12 col-sm-8 col-md-9 col-lg-9">
                            <input type="text" style="padding: 10px; max-width: 65%;"   class="inputTrackPadding focused my_input" name="duration" id="timeDuration" placeholder="HH:MM">
                            <label class="labelTrack" for="" style="padding-top: 10px">Value($) <span id="insertCost"><span></label>
                        </div>
                    </div>

                    <div class="form-group form-group-edit col-xs-12 col-sm-12 col-md-12 col-lg-12" >
                        <div class="col-xs-2 col-sm-4 col-md-3 col-lg-3" style="text-align: right;">
                            <label class="control-label labelTrack" for="additionalCost">Additional Cost</label>
                        </div>
                        <div class="controls col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="input-group">
                            <div class="input-group-btn" >
                            <input type="number" steep="0.01" style="padding: 10px; max-width: 89%" class="inputTrackPadding focused my_input form-control " name="additional_cost" id="additionalCost">
                            <span class="input-group-addon" style="padding: 9px 12px">$</span>
                            </div>
                            </div>
                        </div>
                        <div class="controls col-xs-12 col-sm-3 col-md-3 col-lg-3">
                        <span class="" style="display: inline-block">
                            <label  class="labelTrack" for="billableTime">
                               Billable Time <input type="checkbox" name="Billable_time" id="billableTime">
                            </label>
                         </span>
                        </div>

                    </div>

                    <div class="form-group form-group-edit col-xs-12 col-sm-12 col-md-12 col-lg-12" >
                        <div class="col-xs-2 col-sm-4 col-md-3 col-lg-3" style="text-align: right;">
                            <label class="control-label labelTrack" for="trackDescription">Description</label>
                        </div>
                        <div class="controls col-xs-12 col-sm-8 col-md-9 col-lg-9">
                           <textarea class="inputTrackPadding focused my_input " rows="7" name="description" id="trackDescription"></textarea>
                        </div>
                        @if ($errors->has('description'))
                            <span class="help-block">
                                                <strong style="color:#802420">{{ $errors->first('description') }}</strong>
                                            </span>
                        @endif
                    </div>

                    <div class="form-group form-group-edit col-xs-12 col-sm-12 col-md-12 col-lg-12" >
                        <div class="col-xs-2 col-sm-4 col-md-3 col-lg-3" style="text-align: right; margin-top: 20px">
                            <label class="control-label labelTrack" for=""></label>
                        </div>
                        <div class="controls col-xs-12 col-sm-8 col-md-9 col-lg-9"  style="margin-top: 20px">
                          <button type="submit" id="" class="btn button-orange">Submit</button>
                        </div>
                    </div>


                </form>


            </div>
            <div class="col-sm-6 col-md-6 col-lg-6"  style="border-right: 1px solid #ccc; padding-top: 20px">
                <table class="col-md-12 trackLogTable" id="trackLogTableId">
                    <tbody>

                    <tr class="trackLog trackLogFirst" id="firstTrack" >
                        <td class="">
                            <span class="ng-binding"></span>
                            <p class="projecttask"> - nazar - ertretret</p>
                        </td>
                        <td class="text-right">
                            <h3 id="timeTrackFirstSegment" style="margin: 7px 0px ">0:00:00</h3>
                            <p class="project" >11:32 - 11:32</p>
                        </td>
                        <td class="text-right table-cell-actions">
                            <div class="btn-group">
                                <button class="btn btn-default" id="startTrack">
                                    <span class="glyphicon glyphicon-play"></span>
                                </button>
                                <button class="btn btn-default" id="editTrack">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </button>
                                <button class="btn btn-default" id="deleteTrack">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </button>
                            </div>
                        </td>
                    </tr>
                   </tbody>
                </table>
            </div>



</div>
    </div>
    <script src="/js/jquery/jquery-3.1.1.min.js"></script>
    <script src="/js/tasks.js"></script>

@endsection
