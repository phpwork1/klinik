/**
 * Created by User on 11/2/2017.
 */
jQuery(document).ready(function () {
    $(document).ready(function () {
        $("body").on("beforeSubmit", "form#processCheckingActiveForm", function () {
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
                    alert("Simpan Sukses");
                    $(".has-success").removeClass();
                },
                error: function () {
                    alert("Terjadi error, data tidak tersimpan");
                }
            });
            return false;
        }).on("beforeSubmit", "form#processCheckingDiagnosisActiveForm", function () {
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
                    $("#processCheckingDiagnosisModal").modal("toggle")
                        .on('hidden.bs.modal', function () {
                            $(this).find('form')[0].reset();
                        });
                    $.pjax.reload({container: "#pjaxRDiagnosis"}); //for pjax update
                },
                error: function () {
                    alert("Terjadi error, data tidak tersimpan");
                }
            });
            return false;
        });
    });

    $(document).on('ready pjax:success', function () {
        $('.ajaxProcessCheckingDiagnosisDeleteButton').on('click', function (e) {
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
                    $.pjax.reload({container: "#pjaxRDiagnosis"});
                });
            }
        });
    });
});

