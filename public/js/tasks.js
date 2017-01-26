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
            $.get(urlSend, function (response) {
                if ( $('.conteiner').data('status') !== 'QA Engineer']){
                    for (var key in response.data) {
                        result += '<option value="' + response.data[key].id + '">' + response.data[key].task_titly + '</option>';
                    }
                } else {

                    if ($('.conteiner').data('idActiveUser') == response.data[key].assign_to ){
                        for (var key in response.data) {
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
