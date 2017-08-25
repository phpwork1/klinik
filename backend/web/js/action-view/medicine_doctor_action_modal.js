/**
 * Created by User on 11/2/2017.
 */
jQuery(document).ready(function () {
    var baseUrl = $('#baseUrl').val();
    $(document).on('change', '#doctorActionPracticeActionName', function () {
        id = $(this).find('option:selected').val();
        $.ajax({
            url: baseUrl + '/registration/ajax-practice-action-price',
            type: 'post',
            data: {doctor_action_id: id},
            dataType: 'json',
            success: function (data) {
                if (data !== false) {
                    $('#doctorActionPrice').val(data['doctor_action'].pa_cost);
                } else {
                    $('#doctorActionPrice').val('Tidak ada data');
                }
            }
        });
    });

    $(document).on('change', '#doctorActionClinicalActionName', function () {
        id = $(this).find('option:selected').val();
        $.ajax({
            url: baseUrl + '/registration/ajax-clinical-action-price',
            type: 'post',
            data: {doctor_action_id: id},
            dataType: 'json',
            success: function (data) {
                if (data !== false) {
                    $('#doctorActionPrice').val(data['doctor_action'].ca_cost);
                } else {
                    $('#doctorActionPrice').val('Tidak ada data');
                }
            }
        });
    });

});