/**
 * Created by User on 11/2/2017.
 */
jQuery(document).ready(function () {
    var baseUrl = $('#baseUrl').val();
    $.ajax({
        url: baseUrl + '/registration/ajax-item-stock',
        type: 'post',
        data: {item_id: $('#item').find('option:selected').val()},
        dataType: 'json',
        success: function (data) {
            if (data !== false) {
                $('#stock').val(data['item'].i_stock_amount);
            } else {
                $('#stock').val('Tidak ada data');
            }
        }
    });

    $(document).on('change', '#item', function () {
        id = $(this).find('option:selected').val();
        $.ajax({
            url: baseUrl + '/registration/ajax-item-stock',
            type: 'post',
            data: {item_id: id},
            dataType: 'json',
            success: function (data) {
                if (data !== false) {
                    $('#stock').val(data['item'].i_stock_amount);
                } else {
                    $('#stock').val('Tidak ada data');
                }
            }
        });
    });

    $(document).ready(function () {
        $("body").on("beforeSubmit", "form#medicineTherapyModalActiveForm", function () {
            var form = $(this);
            // return false if form still have some validation errors
            if (form.find(".has-error").length) {
                return false;
            }
            // submit form
            $.ajax({
                url: form.attr("action"),
                type: "post",
                data: form.serialize(),
                success: function () {
                    $("#medicineModal").modal("toggle")
                        .on('hidden.bs.modal', function () {
                            $(this).find('form')[0].reset();
                        });
                    $.pjax.reload({container: "#pjaxMedicineTherapy"}); //for pjax update
                },
                error: function () {
                    alert("Terjadi error, data tidak tersimpan");
                }
            });
            return false;
        });
    });

    $(document).on('ready pjax:success', function () {
        $('.ajaxMedicineTherapyDelete').on('click', function (e) {
            e.preventDefault();
            var deleteUrl = $(this).attr('href');
            if (confirm('Yakin ingin menghapus data ini?')) {
                $.ajax({
                    url: deleteUrl,
                    type: 'post',
                    error: function (xhr) {
                        alert('There was an error with your request.'
                            + xhr.responseText);
                    }
                }).done(function () {
                    $.pjax.reload({container: "#pjaxMedicineTherapy"});
                });
            }
        });
    });

});

