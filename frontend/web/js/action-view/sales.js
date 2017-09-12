/**
 * Created by User on 11/2/2017.
 */
jQuery(document).ready(function () {
    var baseUrl = $('#baseUrl').val();

    $('.salesDetailItemModalButton').on("click", function (e) {
        e.preventDefault(); //for prevent default behavior of <a> tag.
        modalObject = $('#salesDetailItemModal');
        modalObject.modal('show');
    });
    $(document).on("pjax:success", function () {
        $('.salesDetailItemModalButton').on("click", function (e) {
            e.preventDefault(); //for prevent default behavior of <a> tag.
            modalObject = $('#salesDetailItemModal');
            modalObject.modal('show');
        });
    });

    $(document).on('change', '#salesAddItemExternal', function () {
        id = $(this).find('option:selected').val();
        $.ajax({
            url: baseUrl + '/sales/ajax-item-detail-external',
            type: 'post',
            data: {item_id: id},
            dataType: 'json',
            success: function (data) {
                if (data !== false) {
                    $('#salesPrice').val(data['item'].i_buy_price);
                    $('#salesAmount').val(data['item'].i_stock_amount);
                } else {
                    $('#salesPrice').val('Tidak ada data');
                    $('#salesAmount').val('Tidak ada data');
                }
            }
        });
    });

    $(document).on('change', '#salesAddItemInternal', function () {
        id = $(this).find('option:selected').val();
        $.ajax({
            url: baseUrl + '/sales/ajax-item-detail-internal',
            type: 'post',
            data: {rmedicine_id: id},
            dataType: 'json',
            success: function (data) {
                if (data !== false) {
                    $('#salesPrice').val(data['item'].i_buy_price);
                    $('#salesAmount').val(data['item'].i_stock_amount);
                } else {
                    $('#salesPrice').val('Tidak ada data');
                    $('#salesAmount').val('Tidak ada data');
                }
            }
        });
    });
    var tableTbody = $('#table-item').find('tbody'),
        tableIndex = tableTbody.find('tr').size(),
        form = $('#sales-form'),
        sb = new StringBuilder();

    $('#salesAddItemButton').on("click", function () {
        dropdown = $('.salesAddItem');
        idAddItem = dropdown.find('option:selected').val();
        if (idAddItem) {
            type = $(this).data('type');
            findItemName(type, tableIndex, idAddItem);


        } else {
            alert('Pilih Barang Terlebih Dahulu');
        }
    });

    function findItemName(type, index, id) {
        if (type === 1) {
            $.ajax({
                url: baseUrl + '/sales/ajax-item-detail-external',
                type: 'post',
                data: {item_id: id},
                dataType: 'json',
                success: function (data) {
                    if (data !== false) {
                        name = data['item'].i_name;
                        itemId = data['item'].id;
                        detail = 0;
                        insertRow(detail, type, index, name, itemId);
                        tableIndex = tableTbody.find('tr').size();
                    }
                }
            });
        } else {
            $.ajax({
                url: baseUrl + '/sales/ajax-item-detail-internal',
                type: 'post',
                data: {rmedicine_id: id},
                dataType: 'json',
                success: function (data) {
                    if (data !== false) {
                        name = data['item'].i_name;
                        itemId = data['item'].id;
                        detail = [];
                        $.ajax({
                            url: baseUrl + '/sales/ajax-item-detail-internal-detail',
                            type: 'post',
                            data: {rmedicine_id: id},
                            dataType: 'json',
                            success: function (data) {
                                if (data !== false) {
                                    count = 0;
                                    $.each(data['detail'], function (i, obj) {
                                        detail[count] = obj.i_name;
                                        count++;
                                    });
                                    insertRow(detail, type, index, name, itemId);
                                    tableIndex = tableTbody.find('tr').size();
                                }
                            }
                        });
                    }
                }
            });
        }
    }

    function insertRow(detail, type, index, name, itemId) {
        dropdown = $('.salesAddItem');
        itemDiscount = $('#salesDiscount').val();
        itemAmount = $('#salesAmount').val();
        itemPrice = $('#salesPrice').val();
        sb.append('<tr>');
        sb.append('<td class="text-center">');
        sb.append(index + 1);
        sb.append('</td>');
        sb.append('<td>');

        if(type === 2) {
            sb.append(name);
            sb.append('<ul>');

            for (i = 0; i < detail.length; i++) {
                sb.append('<li>'+detail[i]+'</li>');
            }

            sb.append('</ul> ');
            rMedicineId = dropdown.val();
            sb.append('<input class="itemName" name="SalesDetail[' + index + '][item_id]" type="hidden" value="' + itemId + '" data-medicine="' + rMedicineId + '" data-type="'+type+'">');
        }else{
            sb.append(name);
            sb.append('<input class="itemName" name="SalesDetail[' + index + '][item_id]" type="hidden" value="' + itemId + '" data-type="'+type+'">');
        }
        sb.append('</td>');
        sb.append('<td class="text-center">');
        sb.append('Rp. ' + itemPrice);
        sb.append('</td>');
        sb.append('<td class="text-center">');
        sb.append(itemAmount);
        sb.append('<input name="SalesDetail[' + index + '][sd_quantity]" type="hidden" value="' + itemAmount + '">');
        sb.append('</td>');

        if (type === 1) {
            sb.append('<td class="text-center">');
            sb.append(itemDiscount);
            sb.append('<input name="SalesDetail[' + index + '][sd_discount]" type="hidden" value="' + itemDiscount + '">');
            sb.append('</td>');

            itemAfterDiscount = itemPrice * itemAmount * (1-(itemDiscount/100));
            itemAfterDiscount = Math.round(itemAfterDiscount);
            sb.append('<td class="text-center">');
            sb.append('Rp. ' + itemAfterDiscount);
            sb.append('<input data-cell="A' + index + '" value="' + itemAfterDiscount + '" name="total" type="hidden">');
            sb.append('</td>');
        }else{
            sb.append('<td class="text-center">');
            sb.append('Rp. ' + itemPrice * itemAmount);
            sb.append('<input data-cell="A' + index + '" value="' + (itemPrice * itemAmount) + '" name="total" type="hidden">');
            sb.append('</td>');
        }

        sb.append('<td class="text-center">');
        sb.append('<button type="button" class="btn btn-xs btn-danger btn-remove">Hapus</button>');
        sb.append('</td>');
        sb.append('</tr>');
        tableTbody.append(sb.toString());
        sb.clear();

        dropdown.find("option:selected").remove();
        form.calx('update').calx('calculate');
    }

    $(document).on('click', '.btn-remove', function () {
        type = $(this).closest('tr').find(".itemName").data('type');
        medicineId = $(this).closest('tr').find(".itemName").data('medicine');
        id = $(this).closest('tr').find(".itemName").val();

        if(type === 1){
            $.ajax({
                url: baseUrl + '/sales/ajax-item-detail-external',
                type: 'post',
                data: {item_id: id},
                dataType: 'json',
                success: function (data) {
                    if (data !== false) {
                        name = data['item'].i_name;
                        $('.salesAddItem').append($('<option>', {
                            value: id,
                            text: name
                        }));
                    }
                }
            });
        }else{
            $.ajax({
                url: baseUrl + '/sales/ajax-item-detail-internal',
                type: 'post',
                data: {rmedicine_id: medicineId, format:1},
                dataType: 'json',
                success: function (data) {
                    if (data !== false) {
                        name = data['item'].i_name;
                        $('.salesAddItem').append($('<option>', {
                            value: medicineId,
                            text: name
                        }));
                    }
                }
            });
        }

        $(this).closest('tr').remove();
        form.calx('update').calx('calculate');
    });

    $(document).on('click', '.btn-remove-ajax', function () {
        if (confirm('Data akan terhapus secara permanen. Teruskan?')) {
            var id = $(this).data('id'),
                controller = $(this).data('controller'),
                tr = $(this).closest('tr');

            $.ajax({
                url: baseUrl + '/' + controller + '/ajax-item-detail-delete',
                dataType: "json",
                type: 'post',
                data: {id: id},
                success: function (data) {
                    if (data !== false) {
                        tr.remove();
                        form.calx('update').calx('calculate');
                    } else {
                        alert('Proses hapus data gagal.');
                    }
                }
            });
        }
    });

});

