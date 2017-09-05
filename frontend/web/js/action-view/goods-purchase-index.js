jQuery(document).ready(function () {
    $('.goodsPurchaseIndexViewModalButton').on("click", function (e) {
        e.preventDefault(); //for prevent default behavior of <a> tag.
        modalObject = $('#goodsPurchaseIndexViewModal');
        modalObject.modal('show');
    });
});