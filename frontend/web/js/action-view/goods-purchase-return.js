jQuery(document).ready(function () {
    $('.chosen-select').chosen();
    var baseUrl = $('#baseUrl').val();

    $(document).on('change', '.invoice-list', function () {
        var itemList = $('#goodsPurchaseReturnAddItem');

        if ($(this).val() !== '') {
            $.ajax({
                url: baseUrl + '/goods-purchase-return/ajax-item-list',
                type: 'post',
                data: {goods_purchase_id: $(this).val()},
                dataType: 'json',
                success: function (data) {
                    itemList.empty();
                    itemList.append($('<option>', {
                        value: '',
                        text: '--Silahkan Pilih--'
                    }));
                    if (data !== false) {
                        $('#supplierName').val(data['supplierName']);
                        $.each(data['itemList'], function (i, obj) {
                            itemList.append($('<option>', {
                                value: obj.id,
                                text: obj.name
                            }));
                        });
                    }
                    itemList.trigger("chosen:updated");
                }
            });
        } else {
            alert('Pilihan salah.');
        }
    });

    $(document).on('change', '#goodsPurchaseReturnAddItem', function () {
        id = $(this).find('option:selected').val();
        $.ajax({
            url: baseUrl + '/goods-purchase-return/ajax-gp-detail',
            type: 'post',
            data: {gp_detail_id: id},
            dataType: 'json',
            success: function (data) {
                if (data !== false) {
                    $('#goodsPurchaseReturnPrice').val(accounting.formatMoney(data['item'].gpd_price, "Rp. ", 0, ","));
                    $('#goodsPurchaseReturnAmount').val(data['item'].gpd_quantity);
                } else {
                    $('#goodsPurchaseReturnPrice').val('Tidak ada data');
                    $('#goodsPurchaseReturnAmount').val('Tidak ada data');
                }
            }
        });
    });

    var tableTbody = $('#table-item').find('tbody'),
        tableIndex = tableTbody.find('tr').size(),
        form = $('#goods-purchase-return-form'),
        sb = new StringBuilder(),
        dropdown = $('#goodsPurchaseReturnAddItem');

    $('#goodsPurchaseReturnAddItemButton').on("click", function () {
        idAddItem = dropdown.find('option:selected').val();
        if (idAddItem) {
            findItemName(tableIndex, idAddItem);
        } else {
            alert('Pilih Barang Terlebih Dahulu');
        }
    });

    function findItemName(index, id) {
        $.ajax({
            url: baseUrl + '/goods-purchase-return/ajax-item-row',
            type: 'post',
            data: {gp_detail_id: id},
            dataType: 'json',
            success: function (data) {
                if (data !== false) {
                    insertRow(data, index);
                    tableIndex = tableTbody.find('tr').size();
                }
            }
        });
    }

    function insertRow(data, index) {
        sb.append('<tr>');
        sb.append('<td class="text-center">');
        sb.append(index + 1);
        sb.append('</td>');
        sb.append('<td class="text-center">');
        sb.append(data['item'][0].name);
        sb.append('<input name="GoodsPurchaseReturnDetail[' + index + '][gprd_name]" type="hidden" value="' + data['item'][0].name + '">');
        sb.append('<input name="GoodsPurchaseReturnDetail[' + index + '][gp_detail_id]" type="hidden" value="' + data['item'][0].id + '">');
        sb.append('<input class="itemId" type="hidden" value="' + data['item'][0].id + '">');
        sb.append('</td>');
        sb.append('<td class="text-center">');
        sb.append(accounting.formatMoney(data['item'][0].price, "Rp. ", 0, ","));
        sb.append('<input name="GoodsPurchaseReturnDetail[' + index + '][gprd_price]" type="hidden" value="' + data['item'][0].price + '">');
        sb.append('</td>');
        sb.append('<td class="text-center">');
        sb.append(data['item'][0].quantity);
        sb.append('<input name="GoodsPurchaseReturnDetail[' + index + '][gprd_quantity]" type="hidden" value="' + data['item'][0].quantity + '">');
        sb.append('</td>');
        sb.append('<td class="text-center">');
        sb.append(accounting.formatMoney(data['item'][0].quantity * data['item'][0].price, "Rp. ", 0, ","));
        sb.append('<input name="GoodsPurchaseReturnDetail[' + index + '][gprd_total]" type="hidden" value="' + data['item'][0].quantity * data['item'][0].price + '" data-cell="A' + index + '" >');
        sb.append('</td>');
        sb.append('<td class="text-center">');
        sb.append('<button type="button" class="btn btn-xs btn-danger btn-remove">Hapus</button>');
        sb.append('</td>');

        sb.append('</tr>');
        tableTbody.append(sb.toString());
        sb.clear();

        dropdown.find("option:selected").remove();
        dropdown.trigger("chosen:updated");
        form.calx('update').calx('calculate');
    }

    $(document).on('click', '.btn-remove', function () {
        id = $(this).closest('tr').find(".itemId").val();

        $.ajax({
            url: baseUrl + '/goods-purchase-return/ajax-item-detail',
            type: 'post',
            data: {gp_detail_id: id},
            dataType: 'json',
            success: function (data) {
                if (data !== false) {
                    name = data['item'][0].name;
                    dropdown.append($('<option>', {
                        value: id,
                        text: name
                    }));
                    dropdown.trigger("chosen:updated");
                }
            }
        });

        $(this).closest('tr').remove();
        form.calx('update').calx('calculate');
    });

    $(".dropdownRemoveId").each(function (index) {
        $("#goodsPurchaseReturnAddItem").find("option[value='" + $(this).val() + "']").remove();
        $('#goodsPurchaseReturnAddItem').trigger("chosen:updated");
    });

    $(document).on('click', '.btn-remove-ajax', function () {
        if (confirm('Data akan terhapus secara permanen. Teruskan?')) {
            var id = $(this).data('id'),
                gpDetailId = $(this).data('detail'),
                controller = $(this).data('controller'),
                tr = $(this).closest('tr');

            $.ajax({
                url: baseUrl + '/' + controller + '/ajax-goods-purchase-return-detail-delete',
                dataType: "json",
                type: 'post',
                data: {id: id},
                success: function (data) {
                    if (data !== false) {
                        $.ajax({
                            url: baseUrl + '/goods-purchase-return/ajax-item-detail',
                            type: 'post',
                            data: {gp_detail_id: gpDetailId},
                            dataType: 'json',
                            success: function (data) {
                                if (data !== false) {
                                    id = data['item'][0].id;
                                    name = data['item'][0].name;
                                    $('#goodsPurchaseReturnAddItem').append($('<option>', {
                                        value: id,
                                        text: name
                                    }));
                                    $('#goodsPurchaseReturnAddItem').trigger("chosen:updated");
                                }
                            }
                        });
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