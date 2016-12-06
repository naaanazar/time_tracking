'use strict';
$(document).ready(function(){
    Registration.display($('#conteiner').data('status'));
    $('#selectTeam').change(function() {
        $( "#selectTeam option:selected" ).each(function() {
            Registration.selectTeam($( this ).text());
        });
    });
    $('#selectTeam').change(function() {
        $( "#selectTeam option:selected" ).each(function() {
            Registration.hourlyRate($( this ).text());
        });
    });

    $( "#selectTeam option:selected" ).each(function() {
        Registration.hourlyRate($( this ).text());
        Registration.selectTeam($(this).text());
    });

});

var Registration = {
    display: function($status) {
        if( $status == 'HR Manager' ) {
            $('#team_name').show();
        }
    },

    selectTeam: function(status){
        if(status == 'Lead' || status == 'Developer') {
            $('#team_name').show();
        } else {
            $('#team_name').hide();
        }
    },

    hourlyRate:function(status){
        if((status == 'Lead' || status == 'Developer' || status == 'QA Engineer' || status == 'Supervisor') && $('#conteiner').data('status') == 'Admin') {
            $('#hourlyRate').show();
        } else {
            $('#hourlyRate').hide();
        }
    },
};