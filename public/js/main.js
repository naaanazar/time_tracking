/**
 * Created by naaanazar on 08.12.2016.
 */
'use strict';
$(document).ready(function(){

    $(document).on( "click", ".deleteTeam", function(e) {
        e.preventDefault();
        var delUrl = $(e.target).data('url');
        var element = $(e.target).data('element');
        Teams.displayModal('#delete-team', delUrl,  'You really want to delete this team?', element, '#modalConfirmDeleteTeam');
    });

    $(document).on( "click", ".deleteUser", function(e) {
        e.preventDefault();
        var delUrl = $(e.target).data('url');
        var element = $(e.target).data('element');

        Teams.displayModal('#delete-user', delUrl,  'You really want to delete this user?', element, '#modalConfirmDeleteUser');
    });

    $(document).on( "click", ".deleteClient", function(e) {
        e.preventDefault();
        var delUrl = $(e.target).data('url');
        var element = $(e.target).data('element');

        Teams.displayModal('#delete-client', delUrl,  'You really want to delete this client?', element, '#modalConfirmDeleteClient');
    });


});

var Teams = {
    displayModal: function(idModal, delUrl, massage, element , appendContainer) {
        var htmlDelete = '' +
            '<div class="modal-header">' +
                '<button type="button" class="close" data-dismiss="modal">&times;</button>' +
                '<h4 class="modal-title">Delete</h4>' +
            '</div>' +
            '<div class="modal-body">' +
                '<p>' + massage + '<strong> ' + element + '</strong></p>' +
            '</div>' +
            '<div class="modal-footer">' +
                '<a href="' + delUrl + '" type="button" class="btn btn-danger" >Delete</a>' +
                '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>' +
                '</div>';

        $(appendContainer).html(htmlDelete)
        $(idModal).modal('toggle');
    },


};