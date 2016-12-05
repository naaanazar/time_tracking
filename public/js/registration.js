'use strict';
$(document).ready(function(){
    Registration.display($('#conteiner').data('status'));
});

var Registration = {
    display: function($status) {
        if( $status == 'HR Manager' ) {
            $('#team_name').show();
        }
    },
};