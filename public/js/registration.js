'use strict';
$(document).ready(function(){
    Registration.display($('#conteiner').data('status'));
    $('#selectTeam').change(function() {
        console.log('test');
        $( "#selectTeam option:selected" ).each(function() {
            Registration.selectTeam($( this ).text());
        });
    });
});

var Registration = {
    display: function($status) {
        if( $status == 'HR Manager' ) {
            $('#team_name').show();
        }
    },

    selectTeam: function(status){
        console.log('test');
        if(status == 'Lead' || status == 'Developer') {
            $('#team_name').show();
        } else {
            $('#team_name').hide();
        }
    }
};