@extends('layouts.index_template')

@section('content')
    <?php $status = \Illuminate\Support\Facades\Auth::user()['original']['employe'] ?>
    <div class="container" id="conteiner" data-status="{{\Illuminate\Support\Facades\Auth::user()['original']['employe']}}">

        <div class="row">
            <div class="row-fluid">
                <div class="heading-top-margin">

                    <div class="heading-without-datepicker"><?= ( isset( $task ) ) ? 'Edit' : 'Add' ;?> task</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="row-fluid" id="login" >
                <!-- block -->
                <div class="block-content collapse in">
                    <div class="span12">
                        <form class="form-horizontal" role="form" method="POST" action="<?= ( isset( $task ) ) ? '/project/update' . $task[0]->id : '/project/create' ;?>">
                            {{ csrf_field() }}
                            @if (isset($task))

                            @endif
                            @if( $status != 'Developer' || $status != 'Developer' )
                            <div class="control-group row">
                                @if( isset( $client ) )
                                <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2" style="text-align: right;">
                                    <label class="control-label" for="CompanyTaskId" style="text-align: left;">Client *</label>
                                </div>
                                <div class="controls col-xs-8 col-sm-6 col-md-5 col-lg-4">
                                        <select name="company_id" class="input-xlarge focused my_input" id="CompanyTaskId" style="height: 42px;" required>

                                        @if( !isset( $task ) )
                                            <option  defaul>Please change Company</option>

                                            @if (isset($client->company_name))
                                                <option value="{{ $client->id }}" selected>{{ $client->company_name }}</option>

                                            @endif

                                            @foreach( $client as $key )

                                                <option  value="{{ $key->id}}">{{ $key->company_name }}</option>
                                            @endforeach

                                        @elseif( isset( $task ) )
                                            @foreach( $client as $key )
                                                @if( $task[0]->company_id == $key->id )
                                                    <option value="{{ $key->id }}" selected>{{ $key->company_name }}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                        </select>

                                            @if ($errors->has('company_id'))
                                                <span class="help-block">
                                                        <strong style="color:#802420">{{ $errors->first('company_id') }}</strong>
                                                    </span>
                                            @endif
                                </div>
                                @endif
                            </div>
                            @endif
                            <div class="control-group row">
                                <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2" style="text-align: right;">
                                    <label class="control-label" for="taskProjectId" style="text-align: left;">Project *</label>
                                </div>
                                <div class="controls col-xs-8 col-sm-6 col-md-5 col-lg-4">
                                    @if( $status == 'Developer' )
                                        <select name="project_id" class="input-xlarge focused my_input" id="taskProjectId" style="height: 42px;" required
                                                <?= ( $status == 'Developer') ? ' disabled' : '' ?>>
                                        @if( isset( $projects ) )
                                            @foreach( $projects as $project )
                                                    <option value="{{ $project->id }}" selected>{{ $project->project_name }}</option>
                                            @endforeach
                                        @else
                                            <option>No project avelable</option>
                                        @endif
                                        </select>
                                    @else
                                        <select name="project_id" class="input-xlarge focused my_input"  id="taskProjectId" style="height: 42px;" required>
                                            @if( isset( $task ) )
                                                @foreach( $project as $key )
                                                    @if( $task[0]->project_id == $key->id )
                                                        <option value="{{ $key->id }}" selected>{{ $key->project_name }}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    @endif

                                    @if ($errors->has('project_id'))
                                        <span class="help-block">
                                                <strong style="color:#802420">{{ $errors->first('project_id') }}</strong>
                                            </span>
                                    @endif

                                </div>
                            </div>

                            <div class="control-group row">
                                <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2" style="text-align: right;">
                                    <label class="control-label" for="taskTypeId" style="text-align: left;">Task Type *</label>
                                </div>
                                <div class="controls col-xs-8 col-sm-6 col-md-5 col-lg-4">
                                    <select name="task_type" class="input-xlarge focused my_input"  id="taskTypeId" style="height: 42px;"
                                    <?= ( $status == 'Developer') ? ' disabled' : '' ?>>

                                        @if( isset( $task ) )
                                            <?php $array = ['New Feature', 'Bug Fixing', 'Quality Assurance', 'Estimates Required']; ?>
                                            <option selected>{{ $task[0]->task_type }}</option>
                                            <?php foreach( $array as $value ) : ?>
                                                <?php if( $task[0]->task_type != $value ) : ?>
                                                    <option><?= $value ?></option>
                                                <?php endif ?>
                                            <?php endforeach ?>
                                        @else
                                            <option>New Feature</option>
                                            <option>Bug Fixing</option>
                                            <option>Quality Assurance</option>
                                            <option>Estimates Required</option>
                                        @endif
                                    </select>
                                    @if ($errors->has('task_type'))
                                        <span class="help-block">
                                                <strong style="color:#802420">{{ $errors->first('task_type') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>

                            <div class="control-group row">
                                <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2" style="text-align: right;">
                                    <label class="control-label" for="taskTittleId" style="text-align: left;">Task Title *</label>
                                </div>
                                <div class="controls col-xs-8 col-sm-6 col-md-5 col-lg-4">

                                    <input name="task_titly" class="input-xlarge focused my_input" id="taskTittleId"   type="text" required
                                         value="<?= ( isset( $task[0]->task_titly ) ) ? $task[0]->task_titly : (( old('task_titly') ) ? old('task_titly') : '') ;?>"
                                        <?= ( $status == 'Developer') ? ' disabled' : '' ?>>
                                    @if ($errors->has('task_titly'))
                                        <span class="help-block">
                                                <strong style="color:#802420">{{ $errors->first('task_titly') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>

                            <div class="control-group row">
                                <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2" style="text-align: right;">
                                    <label class="control-label" for="taskDescriptionId" style="text-align: left;">Description</label>
                                </div>
                                <div class="controls col-xs-8 col-sm-6 col-md-5 col-lg-4">
                                    <textarea name="task_description" class="input-xlarge focused my_input" id="taskDescriptionId" rows="6"  type="text"
                                            ><?= ( isset( $task[0]->task_description ) ) ? $task[0]->task_description : ( old('task_description') ? old('task_description') : '' ) ;?></textarea>
                                    @if ($errors->has('task_description'))
                                        <span class="help-block">
                                                <strong style="color:#802420">{{ $errors->first('task_description') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>

                            <div class="control-group row">
                                <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2" style="text-align: right;">
                                    <label class="control-label" for="HourlyRateProhectId" style="text-align: left;">Allocated Hours</label>
                                </div>
                                <div class="controls col-xs-8 col-sm-6 col-md-5 col-lg-4">
                                    <input name="alloceted_hours" class="input-xlarge focused my_input" id="HourlyRateProhectId"  type="number"
                                            value="<?= ( isset( $task[0]->alloceted_hours ) ) ? $task[0]->alloceted_hours : '' ;?>"
                                        <?= ( $status == 'Developer') ? ' disabled' : '' ?>/>
                                    @if ($errors->has('alloceted_hours'))
                                        <span class="help-block">
                                                <strong style="color:#802420">{{ $errors->first('alloceted_hours') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>

                            <div class="control-group row">
                                <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2" style="text-align: right;">
                                    <label class="control-label" for="AssignToId" style="text-align: left;">Assign To</label>
                                </div>
                                <div class="controls col-xs-8 col-sm-6 col-md-5 col-lg-4">
                                    <select name="assign_to" class=" input-xlarge focused my_input "   id="AssignToId" style="height: 42px;" data-all="true">
                                        @if( isset( $task[0]->assign_to ) )
                                            @if (isset($user->name))
                                            <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                                            @endif
                                        @else
                                            <option selected disabled></option>
                                        @endif
                                    </select>
                                    @if ($errors->has('assign_to'))
                                        <span class="help-block">
                                                <strong style="color:#802420">{{ $errors->first('assign_to') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>

                            <div class="control-group row">
                                <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2" style="text-align: right;">

                                </div>
                                <div class="controls col-xs-8 col-sm-6 col-md-5 col-lg-4" >
                                    <label class="control-label" for="BillableId" style="">Billable</label>
                                    <input type="checkbox"  name="billable" id="BillableId" value="1"
                                        @if( isset( $task[0]->billable ) && $task[0]->billable == true )
                                            checked
                                        @endif
                                    ><br>
                                </div>
                            </div>

                            <div class="form-actions row">
                                <label class="control-label col-sm-2" for=""></label>
                                <button type="submit" class="btn btn-large button-orange" formaction="">Save</button> &nbsp;&nbsp;
                                <a  href="{{ url('/task/all') }}" class="btn btn-large button-orange" style="font-weight: normal;" >Cancel</a>
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
