@extends('layouts.index_template')

@section('content')

<div id="conteiner" data-status="{{\Illuminate\Support\Facades\Auth::user()['original']['employe']}}"></div>
<div class="row-fluid">
    <div class="span12 heading-top-margin">
        <div class="btn-group">
            <button class="btn"><i class="icon-chevron-left"></i></button>
            <button class="btn"><i class="icon-chevron-right"></i></button>
            <button class="btn"><i class="icon-calendar"></i></button>
        </div>
        <div class="heading">December 2016</div>
    </div>
</div>
<div class="row-fluid">
    <div class="span12">
        <h3>Filter</h3>
    </div>
</div>
<div class="row-fluid">
    <div class="span8">
        <!-- block -->

        <div class="control-group">
            <div class="controls">
                <select class="span6 m-wrap approval-filed approval-box" name="category">
                    <option value="">All Users</option>
                    <option value="Category 1">Users 1</option>
                    <option value="Category 2">Users 2</option>
                </select>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <select class="span6 m-wrap approval-filed" name="category">
                    <option value="">All Clients</option>
                    <option value="Category 1">Clients 1</option>
                    <option value="Category 2">Clients 2</option>
                </select>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <select class="span6 m-wrap approval-filed" name="category">
                    <option value="">All Projects</option>
                    <option value="Category 1">Projects 1</option>
                    <option value="Category 2">Projects 2</option>
                </select>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <select class="span6 m-wrap approval-filed" name="category">
                    <option value="">All Tasks</option>
                    <option value="Category 1">Tasks 1</option>
                    <option value="Category 2">Tasks 2</option>
                </select>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <select class="span6 m-wrap approval-filed" name="category">
                    <option value="">All Statuses</option>
                    <option value="Category 1">Statuses 1</option>
                    <option value="Category 2">Statuses 2</option>
                </select>
            </div>
        </div>

        <!-- /block -->
    </div>
    <div class="span4">
        <!-- block -->
        <button type="submit" class="btn btn-large btn-primary">Clear</button>
        <!-- /block -->
    </div>
</div>



<div class="row-fluid">
    <!-- block -->
    <div class="block">
        <div class="navbar navbar-inner block-header heading-table">
            <div class="muted pull-left">Approvals</div>
        </div>
        <div class="block-content collapse in">
            <div class="span12">

                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                    <thead>
                    <tr>
                        <th width="106">People</th>
                        <th class="check-box-center" width="65"><span><input class="uniform_on" id="optionsCheckbox" value="option1" type="checkbox"></span></th>
                        <th>Day</th>
                        <th>Client</th>
                        <th>Project & Task</th>
                        <th>Rate</th>
                        <th width="99">Value</th>
                        <th>Time</th>
                        <th>Duration</th>
                        <th>Status</th>

                    </tr>
                    </thead>
                    <tbody>
                    <tr class="odd gradeX">
                        <td>John</td>
                        <td class="check-box-center"><span><input class="uniform_on" id="optionsCheckbox" value="option1" type="checkbox"></span></td>

                        <td>26-11-2016</td>
                        <td class="center"> Peter </td>
                        <td class="center">Demo - no task -</td>
                        <td> 	$1.00 </td>
                        <td>$0.02</td>
                        <td class="center">6:18 pm - 6:19 pm</td>
                        <td class="center">24.00.20</td>
                        <td class="center">Pending</td>
                    </tr>
                    <tr class="even gradeC">
                        <td>Andy</td>
                        <td class="check-box-center"><span><input class="uniform_on" id="optionsCheckbox" value="option1" type="checkbox"></span></td>
                        <td> 	22-11-2016</td>
                        <td class="center">Denise </td>
                        <td class="center">Demo - no task -</td>
                        <td> 	$1.00 </td>
                        <td>$0.02</td>
                        <td class="center"> 4:00pm - 3:54pm</td>
                        <td class="center">0.00.20</td>
                        <td class="center"> 	Approved </td>
                    </tr>
                    <tr class="odd gradeA">
                        <td>Marisol</td>
                        <td class="check-box-center"><span><input class="uniform_on" id="optionsCheckbox" value="option1" type="checkbox"></span></td>
                        <td>21-11-2016</td>
                        <td class="center">- no client -</td>
                        <td class="center">Demo - no task -</td>
                        <td> 	$2.00 </td>
                        <td>$0.02</td>
                        <td class="center"> 6:18 pm - 6:19 pm</td>
                        <td class="center">0.00.20</td>
                        <td class="center">Pending</td>
                    </tr>
                    <tr class="even gradeA">
                        <td>Kelley</td>
                        <td class="check-box-center"><span><input class="uniform_on" id="optionsCheckbox" value="option1" type="checkbox"></span></td>
                        <td> 	18-11-2016</td>
                        <td class="center">Denise </td>
                        <td class="center">Demo - no task -</td>
                        <td> 	$1.00 </td>
                        <td>$0.02</td>
                        <td class="center"> 4:00pm - 3:54pm</td>
                        <td class="center">0.00.20</td>
                        <td class="center">Pending</td>
                    </tr>
                    <tr class="even gradeA">
                        <td>Kelley</td>
                        <td class="check-box-center"><span><input class="uniform_on" id="optionsCheckbox" value="option1" type="checkbox"></span></td>
                        <td> 	18-11-2016</td>
                        <td class="center">Denise </td>
                        <td class="center">Demo - no task -</td>
                        <td> 	$1.00 </td>
                        <td>$0.02</td>
                        <td class="center"> 4:00pm - 3:54pm</td>
                        <td class="center">0.00.20</td>
                        <td class="center">Pending</td>
                    </tr>


                    </tbody>
                </table>


                <table width="100%" cellspacing="0" cellpadding="0" class="user-total-table">
                    <tbody>
                    <tr>
                        <td width="8%">&nbsp;</td>
                        <td ><strong>User Total</strong></td>
                        <td width="5%">&nbsp; </td>
                        <td width="5%">&nbsp;</td>
                        <td width="5%">&nbsp;</td>
                        <td width="5%">&nbsp;</td>
                        <td width="24%"><strong>$0.32</strong></td>
                        <td width="14%"><strong>24:00:32</strong></td>
                        <td width="5%">&nbsp;</td>
                    </tr>
                    </tbody>
                </table>


            </div>


        </div>
    </div>
    <!-- /block -->
</div>




<hr>
<br/>
<table width="100%" cellspacing="0" cellpadding="0" class="">
    <tbody>
    <tr>
        <td width="8%"><h3>Total</h3> </td>
        <td >&nbsp; </td>
        <td width="5%">&nbsp; </td>
        <td width="5%">&nbsp;</td>
        <td width="5%">&nbsp;</td>
        <td width="5%">&nbsp;</td>
        <td width="24%"><strong>$0.32</strong></td>
        <td width="14%"><strong>24:00:32</strong></td>
        <td width="5%">&nbsp;</td>
    </tr>
    </tbody>
</table>

<br/><br/><br/>

<div class="row-fluid">
    <div class="span6 reject-selected-logs-btn"></div><div class="span6 approve-selected-logs"><button class="btn btn-large btn-primary" type="submit" value="Clear">Reject selected logs</button></div> <button class="btn btn-large btn-primary" type="submit" value="Clear">Approve selected logs</button> </div>

<br/><br/><br/>
</div>


@endsection
