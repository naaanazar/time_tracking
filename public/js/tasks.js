/**
 * Created by antonsoft on 13.12.2016.
 */

'use strict';
$(document).ready(function(){
    $(document).on("change", "#trackProjectId", function () {

        var clientId = $("#trackProjectId option:selected").val();
        if (clientId) {
            var result = '<option selected disabled value="">Please select task</option>';
            var urlSend = '/tasks/get/' + clientId;
            var at = $('#conteiner').data('status');
            $.get(urlSend, function (response) {
                if ( String(at) != 'QA Engineer'){
                    for (var key in response.data) {
                        result += '<option value="' + response.data[key].id + '">' + response.data[key].task_titly + '</option>';
                    }
                } else {
                    for (var key in response.data) {
                        if ($('#conteiner').data('idactiveuser') == response.data[key].assign_to ){
                            result += '<option value="' + response.data[key].id + '">' + response.data[key].task_titly + '</option>';
                        }
                    }
                }
                $("#trackTaskId").html(result);
            });
        } else {
            $("#trackTaskId").html('');
        }

    });
});
