/**
 * Created by User on 11/2/2017.
 */
jQuery(document).ready(function () {
    var baseUrl = $('#baseUrl').val();
    $(document).on('change', '#itemModal', function () {
        id = $(this).find('option:selected').val();
        $.ajax({
            url: baseUrl + '/registration/ajax-item-stock',
            type: 'post',
            data: {item_id: id},
            dataType: 'json',
            success: function (data) {
                if (data !== false) {
                    $('#stockModal').val(data['item'].i_stock_amount);
                    $('#priceModal').val('Rp.' + data['item'].i_blend_price);
                } else {
                    $('#stockModal').val('Tidak ada data');
                }
            }
        });
    });

});