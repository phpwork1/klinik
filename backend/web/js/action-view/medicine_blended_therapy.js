/**
 * Created by User on 11/2/2017.
 */
jQuery(document).ready(function () {
    $('.medicineBlendedModalClicked').on("click", function (e) {
        e.preventDefault(); //for prevent default behavior of <a> tag.
        modalObject = $('#medicineBlendedDetailModal');
        modalObject.modal('show').find('#modelId').attr('value', ($(this).attr('data')));
    });

    $(document).on("pjax:success", function () {
        $('.medicineBlendedModalClicked').on("click", function (e) {
            e.preventDefault(); //for prevent default behavior of <a> tag.
            modalObject = $('#medicineBlendedDetailModal');
            modalObject.modal('show').find('#modelId').attr('value', ($(this).attr('data')));
        });
    });

    $(document).ready(function () {
        $("body").on("beforeSubmit", "form#medicineBlendedActiveForm", function () {
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
                    $("#medicineBlendedModal").modal("toggle")
                        .on('hidden.bs.modal', function () {
                            $(this).find('form')[0].reset();
                        });
                    $.pjax.reload({container: "#pjaxMedicineBlended"}); //for pjax update
                },
                error: function () {
                    alert("Terjadi error, data tidak tersimpan");
                }
            });
            return false;
        }).on("beforeSubmit", "form#medicineDetailActiveForm", function () {
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
                    $("#medicineBlendedDetailModal").modal("toggle")
                        .on('hidden.bs.modal', function () {
                            $(this).find('form')[0].reset();
                        });
                    $.pjax.reload({container: "#pjaxMedicineDetail"}); //for pjax update
                },
                error: function () {
                    alert("Terjadi error, data tidak tersimpan");
                }
            });
            return false;
        });
    });

    $(document).on('ready pjax:success', function () {
        $('.ajaxMedicineBlendedDelete').on('click', function (e) {
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
                    $.pjax.reload({container: "#pjaxMedicineBlended"});
                });
            }
        });
    }).on('ready pjax:success', function () {
        $('.ajaxMedicineDetailDelete').on('click', function (e) {
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
                    $.pjax.reload({container: "#pjaxMedicineDetail"});
                });
            }
        });
    })
});