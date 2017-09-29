/**
 * Created by User on 11/2/2017.
 */
jQuery(document).ready(function () {
    $('.patientModalClicked').on("click", function (e) {
        e.preventDefault(); //for prevent default behavior of <a> tag.
        modalObject = $('#patientModal' + $(this).attr('id'));
        modalObject.modal('show');
    });
    $(document).on("pjax:success", function () {
        $('.patientModalClicked').on("click", function (e) {
            e.preventDefault(); //for prevent default behavior of <a> tag.
            modalObject = $('#patientModal' + $(this).attr('id'));
            modalObject.modal('show');
        });
    });

});