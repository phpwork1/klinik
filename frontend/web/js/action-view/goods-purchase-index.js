jQuery(document).ready(function () {
    $('.goodsPurchaseIndexViewModalButton').on("click", function (e) {
        e.preventDefault(); //for prevent default behavior of <a> tag.
        modalObject = $('#goodsPurchaseIndexViewModal'+$(this).data('id'));
        modalObject.modal('show');
    });
});