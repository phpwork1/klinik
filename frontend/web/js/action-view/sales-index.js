jQuery(document).ready(function () {
    $('.salesIndexViewModalButton').on("click", function (e) {
        e.preventDefault(); //for prevent default behavior of <a> tag.
        modalObject = $('#salesIndexViewModal'+$(this).data('id'));
        modalObject.modal('show');
    });
});