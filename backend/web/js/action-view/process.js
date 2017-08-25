jQuery(document).ready(function () {
    var baseUrl = $('#baseUrl').val();
    $("#tabs").tabs({
        active: localStorage.getItem("process"),
        activate: function () {
            localStorage.setItem("process", $(this).tabs('option', 'active'));
        }
    });

    $('.drugAllergiesModalButton').on("click", function (e) {
        e.preventDefault(); //for prevent default behavior of <a> tag.
        modalObject = $('#processDrugAllergiesModal');
        modalObject.modal('show');
    });

    $(document).ready(function () {
        $("body").on("beforeSubmit", "form#processDrugAllergiesActiveForm", function () {
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
                    $("#processDrugAllergiesModal").modal("toggle")
                        .on('hidden.bs.modal', function () {
                            $(this).find('form')[0].reset();
                        });
                    $.pjax.reload({container: "#pjaxProcessDrugAllergies"}); //for pjax update
                },
                error: function () {
                    alert("Terjadi error, data tidak tersimpan");
                }
            });
            return false;
        });
    });

    $(document).on('ready pjax:success', function () {
        $('.drugAllergiesButton').on('click', function (e) {
            e.preventDefault();
            if (confirm('Yakin ingin menghapus data ini?')) {
                $.ajax({
                    url: baseUrl + '/registration/ajax-delete-drug-allergies',
                    type: 'post',
                    data: {dataId: $(this).data('id')},
                    error: function (xhr) {
                        alert('There was an error with your request.'
                            + xhr.responseText);
                    }
                }).done(function () {
                    $.pjax.reload({container: "#pjaxProcessDrugAllergies"});
                });
            }
        });
    });


});