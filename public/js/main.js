/**
 * Created by naaanazar on 08.12.2016.
 */
'use strict';
$(document).ready(function(){


    $(window).load(function(){

        if ($('#additionalCost').val()) {

            if ($('#additionalCost').val().length > 0 && $("#timeDuration").val().length > 0) {
                var cost = $('#additionalCost').val() / 60 * moment.duration($("#timeDuration").val()).asMinutes();
                console.log(cost);
                $('#insertCost').html(Math.round(cost * 100) / 100);
            }
        }

        //report calendar
        var dateStart = $('#conteiner').data('start');
        var dateEnd = $('#conteiner').data('end');
        //console.log(dateStart);
        //console.log(dateEnd);

        if(dateStart && dateEnd) {
            if (dateStart.length > 0 && dateEnd.length > 0) {

                $('.dr-date-start').text(moment(dateStart, 'YYYY-MM-DD').format('MMMM D, YYYY'));
                $('.dr-date-end').text(moment(dateEnd, 'YYYY-MM-DD').format('MMMM D, YYYY'));

            }
        }

        var i = 0;
        setInterval(function () {
            if (t) {
                var idActiveLog = $('#conteiner').data('log-active');
                $.get('/get/timestart/' + idActiveLog, function (date) {

                    var duration = SecondsTohhmmss((moment(date.data.now, "YYYY-MM-DD hh:mm:ss") - moment(date.data.start, "YYYY-MM-DD hh:mm:ss")) / 1000);
                    //console.log(duration);

                    seconds = duration.slice(6,7) == 0 ? duration.slice(7) : duration.slice(6);
                    minutes = duration.slice(3,4) == 0 ? duration.slice(4,5) : duration.slice(3,5);
                    hours = duration.slice(1,2) == 0 ? duration.slice(1,2) : duration.slice(0,2);
                });
            }

            i++;
        },1000)




        $(".removeSelect").html('');

        if (($('#bodyData').data('msg').length > 0) && ($('#bodyData').data('theme').length > 0)) {
            $.jGrowl($('#bodyData').data('msg'), {
                theme: $('#bodyData').data('theme'),
                life: 4000,
                position:'center',
            });
        };

        if ($('#conteiner').data('msg')) {
            if (($('#conteiner').data('msg').length > 0) && ($('#conteiner').data('theme').length > 0)) {
                $.jGrowl($('#conteiner').data('msg'), {
                    theme: $('#conteiner').data('theme'),
                    life: 4000,
                    position: 'center',
                });
            }
        }
    });


    //calendar


    var dd = new Calendar({
        element: $('.one'),
        earliest_date: 'January 1, 2000',
        latest_date: moment(),
        start_date: moment().subtract(29, 'days'),
        end_date: moment(),

        callback: function() {
            var start = moment(this.start_date).format('YYYY-MM-DD'),
                end = moment(this.end_date).format('YYYY-MM-DD');

            var userId = $("#SelectAllUserReport option:selected").val();

            if (userId.length > 0) {

                window.location.href = "/reports/people/" + start + '/' + end + '/' + userId;
            }

            console.debug('Start Date: '+ start +'\nEnd Date: '+ end);
        }
    });

    var ds = new Calendar({
        element: $('.one2'),
        earliest_date: 'January 1, 2000',
        latest_date: moment(),
        start_date: moment().subtract(29, 'days'),
        end_date: moment(),

        callback: function() {
            var start = moment(this.start_date).format('YYYY-MM-DD'),
                end = moment(this.end_date).format('YYYY-MM-DD');

            var userId = $("#SelectAllProjectReport option:selected").val();

            if (userId.length > 0) {

                window.location.href = "/reports/project/" + start + '/' + end + '/' + userId;
            }

            console.debug('Start Date: '+ start +'\nEnd Date: '+ end);
        }
    });



    //reports

    $(document).on("change", "#SelectAllUserReport", function () {

        var userId = $("#SelectAllUserReport option:selected").val();
        var start = moment($('.dr-date-start').text(), 'MMMM D, YYYY').format('YYYY-MM-DD');
        var end = moment($('.dr-date-end').text(), 'MMMM D, YYYY').format('YYYY-MM-DD');
        console.debug('Start Date: '+ start +'\nEnd Date: '+ end);
        window.location.href = "/reports/people/" + start + '/' + end + '/' + userId;

    });

    $(document).on("change", "#SelectAllProjectReport", function () {

        var userId = $("#SelectAllProjectReport option:selected").val();
        var start = moment($('.dr-date-start').text(), 'MMMM D, YYYY').format('YYYY-MM-DD');
        var end = moment($('.dr-date-end').text(), 'MMMM D, YYYY').format('YYYY-MM-DD');
        console.debug('Start Date: '+ start +'\nEnd Date: '+ end);
        window.location.href = "/reports/project/" + start + '/' + end + '/' + userId;

    });




    //  $('#datetimepicker').datetimepicker('setInitialDate', '2016-12-31');

  /*  $('.day').on('click', function(){
        var date = setTimeout(" console.log($('#dtp_input2').val());"  , 500);


//console.log(date + '-----');
    //    window.location ='/trecking/' + date;
        window.onload=function() {
            console.log($('#dtp_input2').val());
        }


    });


    $('.form_date').datetimepicker({

        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0,

    });

    $(document).on('dp.change', '.form_date', function() {
        alert('changed');
    });*/




    $(".d4").datepicker({
            autoclose: true,
            todayBtn: "linked",
            todayHighlight: true
        }
    ).on('changeDate', function (e) {
            var dateCalendar = e.format();
            dateCalendar = moment(dateCalendar, 'MM/DD/YYYY').format('DD-MM-YYYY');
            window.location.href = "/tracking/" + dateCalendar;
    });

    $('#sandbox-container .input-group.date').datepicker({
        autoclose: true
    });

    $('.d4').datepicker('update', new Date(moment($('#conteiner').data('date'), 'DD-MM-YYYY')));

    $(document).on("click", ".calendarNextDay", function(){
        var dateCalendar = moment($('#conteiner').data('date'), 'DD-MM-YYYY').add('days', 1).format('DD-MM-YYYY');
        window.location.href = "/tracking/" + dateCalendar;
    });

    $(document).on("click", ".calendarPrevDay", function(){
        var dateCalendar = moment($('#conteiner').data('date'), 'DD-MM-YYYY').add('days', -1).format('DD-MM-YYYY');
        window.location.href = "/tracking/" + dateCalendar;
    });


    //report


    $(".d5").datepicker({
            autoclose: true,
            todayBtn: "linked",
            todayHighlight: true
        }
    ).on('changeDate', function (e) {
            var dateCalendar = e.format();
            dateCalendar = moment(dateCalendar, 'MM/DD/YYYY').format('DD-MM-YYYY');
            window.location.href = "/reports/daily/" + dateCalendar;
        });

    $('#sandbox-container .input-group.date').datepicker({
        autoclose: true
    });

    $('.d5').datepicker('update', new Date(moment($('#conteiner').data('date'), 'DD-MM-YYYY')));

    $(document).on("click", ".calendarNextReport", function(){
        var dateCalendar = moment($('#conteiner').data('date'), 'DD-MM-YYYY').add('days', 1).format('DD-MM-YYYY');
        window.location.href = "/reports/daily/" + dateCalendar;
    });

    $(document).on("click", ".calendarPrevDayReport", function(){
        var dateCalendar = moment($('#conteiner').data('date'), 'DD-MM-YYYY').add('days', -1).format('DD-MM-YYYY');
        window.location.href = "/reports/daily/" + dateCalendar;
    });



    $(document).on("change", "#trackTaskId", function () {

        var taskId = $("#trackTaskId option:selected").val();
        if (taskId) {

            var urlSend = '/track/getdesckription/' + taskId;
            $.get(urlSend, function (response) {


                $("#trakingTaskDescription").html(response.data[0].task_description);
            });
        } else {
            $("#trakingTaskDescription").html('');
        }

    });


    $(document).on('click', '.webClick', function(e){
        e.stopImmediatePropagation();
        window.open($(e.target).html(),'_blank');
    })




    //timetrack



    $(document).on('change', '#billableTime', function() {
        if(this.checked) {
            console.log('1');
           if($('#additionalCost').val().length >0 &&  $("#timeDuration").val().length > 0){
             var cost =  $('#additionalCost').val() / 60 * moment.duration($("#timeDuration").val()).asMinutes();
               console.log(cost);
               $('#insertCost').html(Math.round(cost * 100) / 100);
           }
        } else {
            $('#insertCost').html('');

        }
    });

    $(document).on('mousemove', '#additionalCost', function(){

        var attr = $('#billableTime').prop('checked');
        console.log(attr)
        if (typeof attr !== typeof undefined && attr !== false) {
            console.log('1');
            if($('#additionalCost').val().length >0 &&  $("#timeDuration").val().length > 0){
                var cost =  $('#additionalCost').val() / 60 * moment.duration($("#timeDuration").val()).asMinutes();
                console.log(cost);
                $('#insertCost').html(Math.round(cost * 100) / 100);
            }
        } else {
            $('#insertCost').html('');

        }
    });


    $(document).on('mousemove', '#timeDuration', function(){

        var attr = $('#billableTime').prop('checked');
        console.log(attr)
        if (typeof attr !== typeof undefined && attr !== false) {
            console.log('1');
            if($('#additionalCost').val().length >0 &&  $("#timeDuration").val().length > 0){
                var cost =  $('#additionalCost').val() / 60 * moment.duration($("#timeDuration").val()).asMinutes();
                console.log(cost);
                $('#insertCost').html(Math.round(cost * 100) / 100);
            }
        } else {
            $('#insertCost').html('');

        }
    });





    // button now
    var dStart,
        dFinish,
        duration ;

    $(document).on('click', '#formTrackStartNow', function(){
        $.get('/tracking-getTime', function (response) {
            $('#formTrackStart').val(moment(response.data, "YYYY-MM-DD hh:mm:ss").format('HH:mm'));
            trackStart();
        });
    });

    $(document).on('click', '#formTrackFinishNow', function(){
        $.get('/tracking-getTime', function (response) {
            $('#formTrackFinish').val(moment(response.data, "YYYY-MM-DD hh:mm:ss").format('HH:mm'));
            trackFinish();
        });
    });

    //button + -
    $(document).on('click', '#formTrackStartInc', function(){
        addTime('#formTrackStart', 10);
        trackStart();
    });

    $(document).on('click', '#formTrackFinishInc', function(){
        addTime('#formTrackFinish' , 10);
        trackFinish();
    });

    $(document).on('click', '#formTrackStartDec', function(){
        addTime('#formTrackStart', -10);
        trackStart();
    });

    $(document).on('click', '#formTrackFinishDec', function(){
        addTime('#formTrackFinish' , -10);
        trackFinish();
    });
    $(document).on('click', '#resetTime', function(){
        event.preventDefault();
        $('#formTrackStart').val('');
        $('#formTrackDuration').val('');
        $('#formTrackFinishSend').val('');
        $('#formTrackStartSend').val('');
        $('#formTrackFinish').val('');
        $('#formTrackStart').val('');
        $('#timeDuration').val('');
        $('#timeDuration').removeAttr('readonly');

        dStart ='';
        dFinish = '';

    });



    $(document).on('change', '#nextDay', function() {
        if(this.checked) {
            if(!dFinish){
                dFinish = new Date();
            }
            dFinish.setDate(new Date().getDate()+ 1);

            trackFinish();
        } else {
            if(dFinish){
                dFinish.setDate(new Date().getDate());
                trackFinish();
            }
        }
    });


    function addTime(element , addMinutes){
        var timeSet = $(element).val();
        if(moment(timeSet, "HH:mm").isValid()){
            timeSet =  moment(timeSet, "HH:mm").add(addMinutes, 'minutes');
        } else {
            timeSet =  moment('00:00', 'HH:mm' ).add(addMinutes, 'minutes');
        }
        $(element).val(moment(timeSet, "HH:mm").format('HH:mm'));
    }


    //time + duratiot



    $('#formTrackStart').on('mouseleave',function(){
        trackStart();

    });

    $('#formTrackFinish').on('mouseleave',function(){
        trackFinish();
    });

    $("#timeDuration").on('mouseleave',function(){

   //     fixTime("#timeDuration");
    });

    $("#timeDuration").on('click',function(){

   //     fixTime("#timeDuration");
    });

    $(".button-orange").on('mousemove',function(){

    //    fixTime("#timeDuration");
    });




    function fixTime(element) {
        if($(element).val().length >0) {
            $(element).val();
            var fixTime = moment.duration($(element).val(), "HH:mm").format('HH:mm');
            console.log(fixTime);
            $(element).val(fixTime);
        }
    }


    function timeDuration(dFinish,  dStart) {

        if (dFinish > dStart) {
            if (dFinish.getHours() == dStart.getHours && dFinish.getMinutes() == dStart.getMinutes()) {

                $("#timeDuration").val('00:00');

            } else {
                var duration = dFinish - dStart;

                var hours;

                if (Math.floor(duration / 60000) < 60) {
                    hours = '00';
                } else {
                    var hours = Math.floor(Math.floor(duration / 60000) / 60);
                    if (hours < 10) {
                        hours = '0' + hours;
                    }

                }

                var minuts = Math.floor(duration / 60000) % 60;

                if (minuts < 10) {
                    minuts = '0' + minuts;
                }

                $("#timeDuration").val(hours + ':' + minuts);
                $("#formTrackDuration").val(hours + ':' + minuts);

                console.log(minuts + 'mm' + 'hh' + hours);
            }
        } else {
            $("#timeDuration").val('incorect');
            $("#formTrackFinish").val($('#formTrackStart').val());
        }
    }

    function timeDuration(dFinish,  dStart) {

        if (dFinish > dStart) {
            if (dFinish.getHours() == dStart.getHours && dFinish.getMinutes() == dStart.getMinutes()) {

                $("#timeDuration").val('00:00');

            } else {
                var duration = dFinish - dStart;

                var hours;

                if (Math.floor(duration / 60000) < 60) {
                    hours = '00';
                } else {
                    var hours = Math.floor(Math.floor(duration / 60000) / 60);
                    if (hours < 10) {
                        hours = '0' + hours;
                    }

                }

                var minuts = Math.floor(duration / 60000) % 60;

                if (minuts < 10) {
                    minuts = '0' + minuts;
                }

                $("#timeDuration").val(hours + ':' + minuts);
                $("#formTrackDuration").val(hours + ':' + minuts);

                console.log(minuts + 'mm' + 'hh' + hours);
            }
        } else {
            $("#timeDuration").val('incorect');
            $("#formTrackFinish").val($('#formTrackStart').val());
        }
    }

    function trackStart(){
        console.log('11');
        if (hasValue("#formTrackStart") || hasValue("#formTrackFinish")){
            // console.log('2');
            $("#timeDuration").attr('readonly', 'readonly');
            var dateStringStart = $("#formTrackStart").val();
            //      console.log(moment(dateString, "HH:mm").isValid() + moment(dateString, "HH:mm").format('HH:mm'));

            if(moment(dateStringStart, "HH:mm").isValid()){
                var dateString = moment(dateStringStart, "HH:mm").format('HH:mm');
                $('#formTrackStart').val(dateString);
                dStart = new Date();
                dStart.setHours(dateString.slice(0,2));
                dStart.setMinutes(dateString.slice(3));
                dStart.setSeconds('0');
                dStart.setMilliseconds('0');
                $('#formTrackStartSend').val(dStart);
            } else {
                $('#formTrackStart').val('incorect');
                $('#formTrackStartSend').val('');
            }


        } else{
            $("#timeDuration").removeAttr('readonly');
        }

        if(dFinish && dStart){

            timeDuration(dFinish,  dStart)
        }
    }

    function trackFinish(){

        console.log('11');
        if (hasValue("#formTrackStart") || hasValue("#formTrackFinish")){
            // console.log('2');
            $("#timeDuration").attr('readonly', 'readonly');
            var dateStringFinish = $("#formTrackFinish").val();
            //      console.log(moment(dateString, "HH:mm").isValid() + moment(dateString, "HH:mm").format('HH:mm'));

            if(moment(dateStringFinish, "HH:mm").isValid()){
                var dateString = moment(dateStringFinish, "HH:mm").format('HH:mm');
                $('#formTrackFinish').val(dateString);
                if (!dFinish) {
                    dFinish = new Date();
                };
                dFinish.setHours(dateString.slice(0,2));
                dFinish.setMinutes(dateString.slice(3));
                dFinish.setSeconds('0');
                dFinish.setMilliseconds('0');
                $('#formTrackFinishSend').val(dFinish);
            } else {
                $('#formTrackFinish').val('incorect');
                $('#formTrackFinishSend').val('');
            }


        } else{
            $("#timeDuration").removeAttr('readonly');
        }



        if(dFinish && dStart){

            timeDuration(dFinish,  dStart);
        }

    }




    function timeDuration(dFinish,  dStart) {

        if (dFinish > dStart) {
            if (dFinish.getHours() == dStart.getHours && dFinish.getMinutes() == dStart.getMinutes()) {

                $("#timeDuration").val('00:00');

            } else {
                var duration = dFinish - dStart;

                var hours;

                if (Math.floor(duration / 60000) < 60) {
                    hours = '00';
                } else {
                    var hours = Math.floor(Math.floor(duration / 60000) / 60);
                    if (hours < 10) {
                        hours = '0' + hours;
                    }

                }

                var minuts = Math.floor(duration / 60000) % 60;

                if (minuts < 10) {
                    minuts = '0' + minuts;
                }

                $("#timeDuration").val(hours + ':' + minuts);
                $("#formTrackDuration").val(hours + ':' + minuts);

                console.log(minuts + 'mm' + 'hh' + hours);
            }
        } else {
            $("#timeDuration").val('incorect');
            $("#formTrackFinish").val($('#formTrackStart').val());
        }
    }




    function hasValue(elem) {
        var valElement = $(elem).val();
        if (valElement) {
            console.log(valElement);
            console.log('tru');
            return true;
        } else {
            console.log('false');
            return false;
        }
    }












    //timetrack log


     $('#timeTrackShowDate').html(moment($('#conteiner').data('date'), 'DD-MM-YYYY').format('dddd, MMMM Do YYYY'));


    /* //h1 = document.getElementsByTagName('h1')[0],
     var   showTime = $('#timeTrackSegmentDuration').text();
     if (!showTime){
     showTime = '00:00:00';
     }
     //var timeDuration;*/

     //start = document.getElementById('start'),
     var
      /*stop = document.getElementById('stop'),
     clear = document.getElementById('clear'),*/
     seconds = 0, minutes = 0, hours = 0,
     t;



     function add(timeSet) {

     /*    if (timeSet){
          //   hours = timeSet.slice(0,2);
       //      minutes =
             console.log (timeSet.slice(3,5));
         }*/

         seconds++;
         if (seconds >= 60) {
             seconds = 0;
             minutes++;
             if (minutes >= 60) {
                 minutes = 0;
                 hours++;
             }
         }
         var timeDurationSet = (hours ? (hours > 9 ? hours : "0" + hours) : "00") + ":" + (minutes ? (minutes > 9 ? minutes : "0" + minutes) : "00") + ":" + (seconds > 9 ? seconds : "0" + seconds);
         $('#timeTrackSegmentDuration').html(timeDurationSet);

         $('.timeTrackSegmentTotalActive').html(SecondsTohhmmss((moment.duration(timeDurationSet) + (moment.duration($('.timeTrackSegmentTotalActive').data('total'))))/1000));

         timer();
     }

     function timer() {
     t = setTimeout(add, 1000);
     }
    // timer();
     clearTimeout(t);



     $(document).on('click' , '#startTrack',  function(e){

         $.post('/create/timelog',
             { project_id: $(e.target).parents("tr").data('project_id'),
                task_id: $(e.target).parents("tr").data('task_id'),
                track_id: $(e.target).parents("tr").data('id'),
                 _token: $('#conteiner').data('token'),
                 create: true },
             function (response){
         console.log(response);
                 window.location ='/tracking/' + $('#conteiner').data('date');
            /* var responseDate = response.data;
             var dateStartTrack = moment(responseDate * 1000).format('HH:mm')

                 console.log( response.data[0].id);
             var id = $(e.target).parents("tr").data('id');

            // console.log(showTime);
           //  console.log('1111');
                var track_id =  $(e.target).parents("tr").data('id');
                var project_name =    $(e.target).parents("tr").data('project_name');
                var task_title =   $(e.target).parents("tr").data('task_titly');*/



               //  showStartLogBlock(moment(response.data[0].start, "YYYY-MM-DD hh:mm:ss").format('HH:mm'), response.data[0].id, track_id, project_name,  task_title, e);

           //  $('#add-' + id).show();

            // timer();
         });
     });
     //clearTimeout(t);
    var actibeTimetrackId = false;

     $(document).on('click' , '#stopTrack',  function(event){
         console.log('stop');
         event.preventDefault();

      //   var timeSegment = $('#timeTrackSegmentDuration').text();
         clearTimeout(t);
         document.getElementById('stop-form').submit();

     });

    $(document).on('click' , '#stopTrack2',  function(event){
        console.log('stop');
        event.preventDefault();
        clearTimeout(t);
        document.getElementById('stop-form-track').submit();

    });



    //time log show

    $(document).on('click' , '.showTimelog',  function(e){
        showTimeLog(e);
    });

    function showTimeLog(e, add) {
        var id = $(e.target).parents("tr").data('id');
        $('#add-' + id).show();
        $('#track-' + id).find('.showTimelog').hide();

        $.get('/track-getTimeLogById/' + id, function (response) {
            console.log(response.data);

            var html;

                for (var key in response.data) {

                    console.log(response.data[key].finish);
                    if (response.data[key].finish != null) {

                    html += '' +
                        '<tr class="trackLog"  data-idTrack="' + response.data[key].track_id + '">' +
                            '<td class="">' +
                                '<span class="ng-binding"></span>' +
                                '<p class="projecttask"> - ' + response.data[key].project.project_name + ' - ' + response.data[key].task.task_titly + '</p>' +
                            '</td>' +
                            '<td class="text-right">' +
                                '<h3 id="" style="margin: 7px 0px ">' +
                                SecondsTohhmmss((moment(response.data[key].finish, "YYYY-MM-DD hh:mm:ss") - moment(response.data[key].start, "YYYY-MM-DD hh:mm:ss")) / 1000) + '</h3>' +
                                '<p class="project" >' +
                                moment(response.data[key].start, "YYYY-MM-DD hh:mm:ss").format('HH:mm') + ' - ' + moment(response.data[key].finish, "YYYY-MM-DD hh:mm:ss").format('HH:mm') + '</p>' +
                            '</td>' +
                            '<td class="text-right table-cell-actions">' +
                                '<div class="btn-group">' +
                                    '<button type="button" class="btn btn-default deleteLog"' +
                                        'data-url="/log/delete/' + response.data[key].id + '" data-element="' + SecondsTohhmmss((moment(response.data[key].finish, "YYYY-MM-DD hh:mm:ss") - moment(response.data[key].start, "YYYY-MM-DD hh:mm:ss")) / 1000) + '">' +
                                        '<span class="glyphicon glyphicon-trash span_no_event" aria-hidden="true"></span>' +
                                    '</button>' +
                                '</div>' +
                            '</td>' +
                        '</tr>';
                    }

                    if(response.data[key].finish == null) {
                        actibeTimetrackId = response.data[key].id;

                        console.log('dddddddddddddddddddddd');

                        $.get('/tracking-getTime', function (date) {
                        console.log('blablablablabla');
                          var duration = SecondsTohhmmss((moment(date.data, "YYYY-MM-DD hh:mm:ss") - moment(response.data[key].start, "YYYY-MM-DD hh:mm:ss")) / 1000)

                       var  html2 = '' +
                            '<tr class="trackLog activeTrack trackLogWrite" data-stop-id ="' + response.data[key].id + '"  >' +
                                '<td class="">' +
                                    '<span class="ng-binding"></span>' +
                                    '<p class="projecttask"> - ' + response.data[key].project.project_name + ' - ' + response.data[key].task.task_titly + '</p>' +
                                '</td>' +
                                '<td class="text-right">' +
                                    '<h3 id="timeTrackSegmentDuration" style="margin: 7px 0px ">' + duration + '</h3>' +
                                    '<p class="project" >' + moment(response.data[key].start, "YYYY-MM-DD hh:mm:ss").format('HH:mm') + ' - --:--</p>' +
                                '</td>' +
                                '<td class="text-right table-cell-actions">' +
                                    '<div class="btn-group">' +
                                        '<a href="#" class="btn btn-danger" id="stopTrack" >' +
                                        '<span class="glyphicon glyphicon-stop"></span>' +
                                        '</a>' +

                                        '<form id="stop-form" action="/create/timelog/" method="POST" style="display: none;">' +
                                            '<input type="hidden" name="_token" id="csrf-token" value="' + $('#conteiner').data('token') + '" />' +
                                            '<input type="hidden" name="id" value="' + response.data[key].id + '">' +
                                        '</form>' +
                                    '</div>' +
                                '</td>' +
                            '</tr>';

                            $('#add-' + id).find('table').append(html2);

                            var formFinish = '' +
                                '<form id="stop-form-track" action="/create/timelog/" method="POST" style="display: none;">' +
                                    '<input type="hidden" name="_token" id="csrf-token" value="' + $('#conteiner').data('token') + '" />' +
                                    '<input type="hidden" name="id" value="' + response.data[key].id + '">' +
                                '</form>';

                            $('#track-' + response.data[key].track_id).find('.addTrackFinishForm').html(formFinish);

                            $('#track-' + response.data[key].track_id).find('#startTrack').hide();
                            $('#track-' + response.data[key].track_id).find('#stopTrack2').show();




                            seconds = duration.slice(6,7) == 0 ? duration.slice(7) : duration.slice(6);
                                minutes = duration.slice(3,4) == 0 ? duration.slice(4,5) : duration.slice(3,5);
                                hours = duration.slice(1,2) == 0 ? duration.slice(1,2) : duration.slice(0,2);

                            if (!t) {
                                timer();
                            }
                        });
                    }
                };


           /* if (add) {
                html += add;
            }*/


            $('#add-' + id).find('table').html(html);
            $(e.target).parents('a').hide();
            $(e.target).parents('tr').find('.hideTimelog').show();

        });
    };

   /* function showStartLogBlock(time, id, track_id, project_name,  task_title, e)
    {
        var html = '' +
            '<tr class="trackLog activeTrack trackLogWrite" data-stop-id ="' + track_id + '"  >' +
            '<td class="">' +
            '<span class="ng-binding"></span>' +
            '<p class="projecttask"> - ' + project_name + ' - ' + task_title + '</p>' +
            '</td>' +
            '<td class="text-right">' +
            '<h3 id="timeTrackSegmentDuration" style="margin: 7px 0px ">0:00:00</h3>' +
            '<p class="project" >' + time + ' - --:--</p>' +
            '</td>' +
            '<td class="text-right table-cell-actions">' +
            '<div class="btn-group">' +
            '<a href="#" class="btn btn-danger" id="stopTrack" >' +
            '<span class="glyphicon glyphicon-stop"></span>' +
            '</a>' +

            '<form id="stop-form" action="/create/timelog/" method="POST" style="display: none;">' +
            '<input type="hidden" name="_token" id="csrf-token" value="' + $('#conteiner').data('token') + '" />' +
            '<input type="hidden" name="id" value="' + id + '">' +
            '</form>' +
            '</div>' +
            '</td>' +
            '</tr>';


        showTimeLog(e, html);
    }*/


    $(document).on('click' , '.hideTimelog',  function(e){
        e.preventDefault();
        e.stopImmediatePropagation();
        $(e.target).parents('a').hide();
        $(e.target).parents('tr').find('.showTimelog').show();
        var id =$(e.target).parents("tr").data('id');
        $('#add-'+  id).hide();
    });


    var SecondsTohhmmss = function(totalSeconds) {
        var hours   = Math.floor(totalSeconds / 3600);
        var minutes = Math.floor((totalSeconds - (hours * 3600)) / 60);
        var seconds = totalSeconds - (hours * 3600) - (minutes * 60);

        // round seconds
        seconds = Math.round(seconds * 100) / 100

        var result = (hours < 10 ? "0" + hours : hours);
        result += ":" + (minutes < 10 ? "0" + minutes : minutes);
        result += ":" + (seconds  < 10 ? "0" + seconds : seconds);
        return result;
    }



    //cockies

    if(getCookie('logTrackActiveLogId')){
        timer();
    }
    // ( document.cookie );





    //datatables


        $('#usersTable').DataTable({
           // "order": [[ 5, "desc" ]],
            "aaSorting": [],

            initComplete: function () {
                this.api().columns().every(function () {
                    var column = this;
                    var select = $('<select><option value="">All</option></select>')
                        .appendTo($(column.footer()).empty())
                        .on('change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                            column
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });

                    column.data().unique().sort().each(function (d, j) {
                        select.append('<option value="' + d + '">' + d + '</option>')
                    });
                });
            }
        });
    $('#usersTable tfoot tr').insertAfter($('#usersTable thead tr'))


    $('#usersTable').parent().addClass('table_container');

    //$('#usersTable').find('select').addClass('input-xlarge focused my_input');
    //console.log ($('#usersTable').find("th").text());

    //   getProjects =

        $(document).on("click", ".getProjects", function (e) {
          var  id = $(e.target).parent('tr').data('id');
            var urlGet = '/client/projects/' + id;
            console.log(urlGet);
            if (urlGet) {
                window.location.href = urlGet;
            } else {

            }

        });

    $(document).on("click", ".getTasks", function (e) {
        var  id = $(e.target).parent('tr').data('id');
        var urlGet = '/project/tasks/' + id;
        console.log(urlGet);
        if (urlGet) {
            window.location.href = urlGet;
        } else {

        }

    });

    $(document).on( "click", ".deleteTeam", function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        var delUrl = $(e.target).data('url');
        var element = $(e.target).data('element');
        var massage = 'Do you want to remove <strong> ' + element + '</strong>?'
        Main.displayModal('#delete-team', delUrl,   massage, '#modalConfirmDeleteTeam');
    });

    $(document).on( "click", ".deleteUser", function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        var delUrl = $(e.target).data('url');
        var element = $(e.target).data('element');
        var massage = 'Do you want to remove <strong> ' + element + '</strong> user?'

        Main.displayModal('#delete-user', delUrl, massage, '#modalConfirmDeleteUser');
    });

    $(document).on( "click", ".deleteClient", function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        var delUrl = $(e.target).data('url');
        var element = $(e.target).data('element');
        var massage = 'Do you want to remove <strong> ' + element + '</strong>?'

        Main.displayModal('#delete-client', delUrl,  massage, '#modalConfirmDeleteClient');
    });

    $(document).on( "click", ".deleteProject", function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        var delUrl = $(e.target).data('url');
        var element = $(e.target).data('element');
        var massage = 'Do you want to remove <strong> ' + element + '</strong>?'

        Main.displayModal('#delete-project', delUrl,  massage, '#modalConfirmDeleteProject');
    });

    $(document).on( "click", ".deleteTask", function(e) {
        e.preventDefault();
        var delUrl = $(e.target).data('url');
        var element = $(e.target).data('element');
        var massage = 'Do you want to remove <strong> ' + element + '</strong>?'

        Main.displayModal('#delete-task', delUrl,  massage, '#modalConfirmDeleteTask');
    });

    $(document).on( "click", ".deleteTrack", function(e) {
        e.preventDefault();
        console.log('11')
    //    e.stopImmediatePropagation();
        var delUrl = $(e.target).data('url');
        var element = $(e.target).data('element');
        var massage = 'Do you want to remove track <strong> ' + element + '</strong>?'

        Main.displayModal('#delete-track', delUrl,  massage, '#modalConfirmDeleteTrack');
    });

    $(document).on( "click", ".deleteLog", function(e) {
        e.preventDefault();
        console.log('11')
        //    e.stopImmediatePropagation();
        var delUrl = $(e.target).data('url');
        var element = $(e.target).data('element');
        var massage = 'Do you want to remove log <strong> ' + element + '</strong>?'

        Main.displayModal('#delete-track', delUrl,  massage, '#modalConfirmDeleteTrack');
    });


    $(document).on( "click", ".approvTrack", function(e) {
        e.preventDefault();

        var delUrl = $(e.target).data('url');
        var element = $(e.target).data('element');
        var massage = 'Do you want to approve track <strong> ' + element + '</strong>?'

        Main.displayModalApprove('#delete-track', delUrl,  massage, '#modalConfirmDeleteTrack');
    });

    $(document).on( "click", ".rejectTrack", function(e) {
        e.preventDefault();

        var delUrl = $(e.target).data('url');
        var element = $(e.target).data('element');
        var massage = 'Do you want to reject track <strong> ' + element + '</strong>?'

        Main.displayModalReject('#delete-track', delUrl,  massage, '#modalConfirmDeleteTrack');
    });



    $(document).on("change", "#CompanyTaskId", function () {

        var clientId = $("#CompanyTaskId option:selected").val();
        if (clientId) {
            var result = '<option selected disabled value="">Please select Project</option>';
            var urlSend = '/project/getProjects/' + clientId;
            $.get(urlSend, function (response) {

                for (var key in response.data) {
                    result += '<option value="' + response.data[key].id + '">' + response.data[key].project_name + '</option>';
                };

                $("#taskProjectId").html(result);
            });
        } else {
            $("#taskProjectId").html('');
        }

    });

    $(document).on("change", "#taskProjectId", function () {
        Main.all_users();
    });

    var list = $('#AssignToId').data('all');

    if(list) {
        //  $(document).on("mouseenter", "#AssignToId", function () {
        console.log('asdsd');
        Main.all_users();
    }
   // });
});

function getServerTime() {
    $.get('/tracking-getTime', function (response) {
        console.log(response.data);
        return response.data;
    });
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return false;
}

var Main = {
    displayModal: function(idModal, delUrl, massage, appendContainer) {

        console.log('2222');
        var htmlDelete = '' +
            '<div class="modal-header">' +
                '<button type="button" class="close" data-dismiss="modal">&times;</button>' +
                '<h4 class="modal-title">Delete Confirmation</h4>' +
            '</div>' +
            '<div class="modal-body">' +
                '<p>' + massage + '</p>' +
            '</div>' +
            '<div class="modal-footer">' +
                '<a href="' + delUrl + '" type="button" class="btn btn-danger" >Delete</a>' +
                '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>' +
                '</div>';

        $(appendContainer).html(htmlDelete)
        $(idModal).modal('toggle');
    },
    displayModalApprove: function(idModal, delUrl, massage, appendContainer) {
        var htmlDelete = '' +
            '<div class="modal-header">' +
            '<button type="button" class="close" data-dismiss="modal">&times;</button>' +
            '<h4 class="modal-title">Approve Confirmation</h4>' +
            '</div>' +
            '<div class="modal-body">' +
            '<p>' + massage + '</p>' +
            '</div>' +
            '<div class="modal-footer">' +
            '<a href="' + delUrl + '" type="button" class="btn btn-success" >Approve</a>' +
            '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>' +
            '</div>';

        $(appendContainer).html(htmlDelete)
        $(idModal).modal('toggle');
    },
    displayModalReject: function(idModal, delUrl, massage, appendContainer) {
        var htmlDelete = '' +
            '<div class="modal-header">' +
            '<button type="button" class="close" data-dismiss="modal">&times;</button>' +
            '<h4 class="modal-title">Reject Confirmation</h4>' +
            '</div>' +
            '<div class="modal-body">' +
            '<p>' + massage + '</p>' +
            '</div>' +
            '<div class="modal-footer">' +
            '<a href="' + delUrl + '" type="button" class="btn btn-warning" >Reject</a>' +
            '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>' +
            '</div>';

        $(appendContainer).html(htmlDelete)
        $(idModal).modal('toggle');
    },

    all_users: function() {
        var clientId = $("#taskProjectId option:selected").val();
        var employe = ($('#conteiner').data('status'));
        if (clientId) {

            var urlSend = '/get/team/' + clientId;
            var result = '<option selected disabled value="null">Please select Assign to</option>';

            if ('' != ($("#username").text())) {
                result = null;
            }


            var idActiveuser = null;
            if($('#username').data('id')){
                 idActiveuser = $('#username').data('id');
            }

            $.get(urlSend, function (response) {

                    var lead = '<optgroup label="Lead">';
  

                if( response.data.lead.hasOwnProperty('id') ) {
                    //  console.log(response.data.lead[0].id + '-----' + idActiveuser);
                    if (idActiveuser !== response.data.lead[0].id) {
                        lead += '<option value="' + response.data.lead[0].id + '">' + response.data.lead[0].name + ' - ' + response.data.lead[0].employe + '</option>';
                    }
                }
                lead += '</optgroup>';


                var team = '<optgroup label="Team">';
                if(response.data.team !== undefined) {
                    for (var i  in response.data.team) {
                        if (response.data.team[i].employe != 'Lead') {

                            if (idActiveuser !== response.data.team[i].id) {
                                team += '<option value="' + response.data.team[i].id + '">' + response.data.team[i].name + ' - ' + response.data.team[i].employe + '</option>';
                            }
                        }
                    }
                }
                    team += '</optgroup>';

                var qa = '<optgroup label="QA Engineer">';
                for ( var i  in response.data.qa) {
                    if ( idActiveuser !== response.data.qa[i].id) {
                        qa += '<option value="' + response.data.qa[i].id + '">' + response.data.qa[i].name + ' - ' + response.data.qa[i].employe + '</option>';
                    }
                };
                qa += '</optgroup>';

                console.log(employe);

                if (employe == 'Admin' || employe == 'Lead' || employe == 'Supervisor' &&  idActiveuser !== response.data.other[i].id){
                    var other = '<optgroup label="Other">';
                    for (var i  in response.data.other) {
                        other += '<option value="' + response.data.other[i].id + '">' + response.data.other[i].name + ' - ' + response.data.other[i].employe + '</option>';
                    }
                    ;
                    other += '</optgroup>';
                }

                $("#AssignToId").append(result + lead + team + qa + other);
            });
        } else {
            $("#AssignToId").html('');
        }
    }


};