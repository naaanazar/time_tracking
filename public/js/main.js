/**
 * Created by naaanazar on 08.12.2016.
 */
'use strict';
$(document).ready(function(){

    $(document).on( "click", ".deleteTeam", function(e) {
        e.preventDefault();
        var delUrl = $(e.target).data('url');
        var element = $(e.target).data('element');
        Main.displayModal('#delete-team', delUrl,  'You really want to delete this team?', element, '#modalConfirmDeleteTeam');
    });

    $(document).on( "click", ".deleteUser", function(e) {
        e.preventDefault();
        var delUrl = $(e.target).data('url');
        var element = $(e.target).data('element');

        Main.displayModal('#delete-user', delUrl,  'You really want to delete this user?', element, '#modalConfirmDeleteUser');
    });

    $(document).on( "click", ".deleteClient", function(e) {
        e.preventDefault();
        var delUrl = $(e.target).data('url');
        var element = $(e.target).data('element');

        Main.displayModal('#delete-client', delUrl,  'You really want to delete this client?', element, '#modalConfirmDeleteClient');
    });

    $(document).on("change", "#SelectBuckets", function () {
        var bucket = $("#SelectBuckets option:selected").text();

        selectDataFromS3('/ml/select-S3objects', '#SelectDataLocationS3', '.create-datasource-form', bucket);

        $('.select-datasource-field').slideDown();
    });

    $(document).on("change", "#CompanyNameProjectId", function () {
         console.log('1111');
        var clientId = $("#CompanyNameProjectId option:selected").val();
        if (clientId) {
            console.log(clientId);
            var urlSend = '/project/getProjects/' + clientId;
            $.get(urlSend, function (response) {
                console.log('2');
                var result = '';
                for (var key in response.data) {
                    result += '<option value="' + response.data[key].id + '">' + response.data[key].project_name + '</option>';
                };
                $("#CompanyProjectId").html(result);
            });
        } else {
            $("#CompanyProjectId").html('');
        }

    });


});

var Main = {
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