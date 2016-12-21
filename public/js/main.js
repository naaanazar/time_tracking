/**
 * Created by naaanazar on 08.12.2016.
 */
'use strict';
$(document).ready(function(){

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
            window.location.href = "/trecking/" + dateCalendar;
    });

    $('#sandbox-container .input-group.date').datepicker({
        autoclose: true
    });

    $('.d4').datepicker('update', new Date(moment($('#conteiner').data('date'), 'DD-MM-YYYY')));

    $(document).on("click", ".calendarNextDay", function(){
        var dateCalendar = moment($('#conteiner').data('date'), 'DD-MM-YYYY').add('days', 1).format('DD-MM-YYYY');
        window.location.href = "/trecking/" + dateCalendar;
    });

    $(document).on("click", ".calendarPrevDay", function(){
        var dateCalendar = moment($('#conteiner').data('date'), 'DD-MM-YYYY').add('days', -1).format('DD-MM-YYYY');
        window.location.href = "/trecking/" + dateCalendar;
    });







    $(window).load(function(){



        $(".removeSelect").html('');

        if (($('#bodyData').data('msg').length > 0) && ($('#bodyData').data('theme').length > 0)) {
            $.jGrowl($('#bodyData').data('msg'), {
                theme: $('#bodyData').data('theme'),
                life: 4000,
                position:'center',
            });
        };

        if (($('#conteiner').data('msg').length > 0) && ($('#conteiner').data('theme').length > 0)) {
            $.jGrowl($('#conteiner').data('msg'), {
                theme: $('#conteiner').data('theme'),
                life: 4000,
                position:'center',
            });
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



    // button now
    var dStart,
        dFinish,
        duration ;

    $(document).on('click', '#formTrackStartNow', function(){
        $.get('/trecking/getTime', function (response) {
            $('#formTrackStart').val(moment(response.data * 1000).format('HH:mm'));
            trackStart();
        });
    });

    $(document).on('click', '#formTrackFinishNow', function(){
        $.get('/trecking/getTime', function (response) {
            $('#formTrackFinish').val(moment(response.data * 1000).format('HH:mm'));
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

        fixTime("#timeDuration");
    });

    $("#timeDuration").on('click',function(){

        fixTime("#timeDuration");
    });

    $(".button-orange").on('mousemove',function(){

        fixTime("#timeDuration");
    });




    function fixTime(element) {
        if($(element).val().length >0) {
            $(element).val();
            var fixTime = moment($(element).val(), "HH:mm").format('HH:mm')
            $(element).val(fixTime);
        }
    }






    function trackStart(){
        console.log('11');
        if (hasValue("#formTrackStart") || hasValue("#formTrackFinish")){
            // console.log('2');
            $("#timeDuration").attr('disabled', 'disabled');
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
            $("#timeDuration").removeAttr('disabled');
        }

        if(dFinish && dStart){

            timeDuration(dFinish,  dStart)
        }
    }

    function trackFinish(){

        console.log('11');
        if (hasValue("#formTrackStart") || hasValue("#formTrackFinish")){
            // console.log('2');
            $("#timeDuration").attr('disabled', 'disabled');
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
            $("#timeDuration").removeAttr('disabled');
        }



        if(dFinish && dStart){

            timeDuration(dFinish,  dStart)
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


     //h1 = document.getElementsByTagName('h1')[0],
    var   showTime = $('#timeTrackSegmentDuration').text();
    if (!showTime){
        showTime = '00:00:00';
    }
    //var timeDuration;

        //start = document.getElementById('start'),
    var   stop = document.getElementById('stop'),
        clear = document.getElementById('clear'),
        seconds = 0, minutes = 0, hours = 0,
        t;

    function add() {
        seconds++;
        if (seconds >= 60) {
            seconds = 0;
            minutes++;
            if (minutes >= 60) {
                minutes = 0;
                hours++;
            }
        }

       var timeDuration = (hours ? (hours > 9 ? hours : "0" + hours) : "00") + ":" + (minutes ? (minutes > 9 ? minutes : "0" + minutes) : "00") + ":" + (seconds > 9 ? seconds : "0" + seconds);
       $('#timeTrackSegmentDuration').html(timeDuration);
        timer();
    }
    function timer() {
        t = setTimeout(add, 1000);
    }

    timer();

   clearTimeout(t);

    $(document).on('click' , '#startTrack',  function(){
        console.log(showTime);
        console.log('1111');

        var html = '' +
            '<tr class="trackLog activeTrack trackLogWrite"  >' +
            '<td class="">' +
            '<span class="ng-binding"></span>' +
            '<p class="projecttask"> - nazar - ertretret</p>' +
            '</td>' +
            '<td class="text-right">' +
            '<h3 id="timeTrackSegmentDuration" style="margin: 7px 0px ">0:00:00</h3>' +
            '<p class="project" >11:32 - 11:32</p>' +
            '</td>' +
            '<td class="text-right table-cell-actions">' +
            '<div class="btn-group">' +
            '<button class="btn btn-danger" id="stopTrack">' +
            '<span class="glyphicon glyphicon-stop"></span>' +
            '</button>' +
            '</div>' +
            '</td>' +
            '</tr>';
        $('#trackLogTableId').append(html);

        timer();
    });
    //clearTimeout(t);

    $(document).on('click' , '#stopTrack',  function(){
        console.log('stop');

        var timeSegment = $('#timeTrackSegmentDuration').text();

        clearTimeout(t);

        var html = '' +
            '<td class="">' +
            '<span class="ng-binding"></span>' +
           '<p class="projecttask"> - nazar - ertretret</p>' +
           '</td>' +
            '<td class="text-right">' +
            '<h3 id="timeTrackSegmentFinish" style="margin: 7px 0px ">' + timeSegment + '</h3>' +
        '<p class="project" >11:32 - 11:32</p>' +
        '</td>' +
        '<td class="text-right table-cell-actions">' +
            '<div class="btn-group">' +
            '<button class="btn btn-default" id="startTrack">' +
            '<span class="glyphicon glyphicon-play"></span>' +
            '</button>' +
            '<button class="btn btn-default" id="editTrack">' +
            '<span class="glyphicon glyphicon-pencil"></span>' +
            '</button>' +
            '<button class="btn btn-default" id="deleteTrack">' +
            '<span class="glyphicon glyphicon-trash"></span>' +
            '</button>' +
            '</div>' +
            '</td>';

        if ($('#firstTrack').hasClass('trackLogFirst')) {
            $('#firstTrack').html(html);
            $('.activeTrack').remove();
            $('#firstTrack').removeClass('trackLogFirst');
        }else {

            $('.activeTrack').html(html);
            $('.activeTrack').removeClass('trackLogWrite');
            $('.activeTrack').removeClass('activeTrack');
        }


    })
    /* Start button */
   // start.onclick = timer;

    /* Stop button */
   // stop.onclick = function() {
   //     clearTimeout(t);
    //}

    /* Clear button
    clear.onclick = function() {
        h1.textContent = "00:00:00";
        seconds = 0; minutes = 0; hours = 0;
    }*/


    //datatables


        $('#usersTable').DataTable({
           // scrollX : true,
         //   scrollCollapse : true,
          //  "sScrollXInner": "100%",


            initComplete: function () {
                this.api().columns().every(function () {
                    var column = this;
                    var select = $('<select><option value="">all</option></select>')
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



    $(document).on("change", "#CompanyTaskId", function () {

        var clientId = $("#CompanyTaskId option:selected").val();
        if (clientId) {
            var result = '<option selected disabled>Please change Project</option>';
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
    $.get('/trecking/getTime', function (response) {
        console.log(response.data + '2222222222');
        return response.data;
    });
}

var Main = {
    displayModal: function(idModal, delUrl, massage, appendContainer) {
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

    all_users: function() {
        var clientId = $("#taskProjectId option:selected").val();
        var employe = ($('#conteiner').data('status'));
        if (clientId) {

            var urlSend = '/get/team/' + clientId;
            var result = '<option selected disabled>Please change User</option>';

            $.get(urlSend, function (response) {
                var lead = '<optgroup label="Lead">' +
                    '<option value="' + response.data.lead[0].id + '">' + response.data.lead[0].name + ' - ' + response.data.lead[0].employe + '</option>' +
                    '</optgroup>';

                var team = '<optgroup label="Team">';
                for ( var i  in response.data.team) {
                    if ( response.data.team[i].employe != 'Lead')
                        team += '<option value="' + response.data.team[i].id + '">' + response.data.team[i].name + ' - ' + response.data.team[i].employe + '</option>';
                };
                team += '</optgroup>';

                var qa = '<optgroup label="QA Engineer">';
                for ( var i  in response.data.qa) {
                    qa += '<option value="' + response.data.qa[i].id + '">' + response.data.qa[i].name + ' - ' + response.data.qa[i].employe + '</option>';
                };
                qa += '</optgroup>';

                console.log(employe);

                if (employe == 'Admin' || employe == 'Lead' || employe == 'Supervisor') {
                    var other = '<optgroup label="Other">';
                    for (var i  in response.data.other) {
                        other += '<option value="' + response.data.other[i].id + '">' + response.data.other[i].name + ' - ' + response.data.other[i].employe + '</option>';
                    }
                    ;
                    other += '</optgroup>';
                }

                $("#AssignToId").append(lead + team + qa + other);
            });
        } else {
            $("#AssignToId").html('');
        }
    }

};