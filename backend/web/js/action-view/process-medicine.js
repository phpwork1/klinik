jQuery(document).ready(function () {
    $("#tabs-medicine").tabs({
        active: localStorage.getItem("processMedicine"),
        activate: function () {
            localStorage.setItem("processMedicine", $(this).tabs('option', 'active'));
        }
    });
});