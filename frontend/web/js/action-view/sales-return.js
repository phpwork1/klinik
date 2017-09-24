jQuery(document).ready(function () {
    $('.chosen-select').chosen();
    var baseUrl = $('#baseUrl').val();

    $(document).on('change', '.invoice-list', function () {
        var itemList = $('#salesReturnAddItem');

        if ($(this).val() !== '') {
            $.ajax({
                url: baseUrl + '/sales-return/ajax-item-list',
                type: 'post',
                data: {sales_id: $(this).val()},
                dataType: 'json',
                success: function (data) {
                    itemList.empty();
                    itemList.append($('<option>', {
                        value: '',
                        text: '--Silahkan Pilih--'
                    }));
                    if (data !== false) {
                        $('#buyerName').val(data['buyerName']);
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

    $(document).on('change', '#salesReturnAddItem', function () {
        id = $(this).find('option:selected').val();
        $.ajax({
            url: baseUrl + '/sales-return/ajax-sales-detail',
            type: 'post',
            data: {sales_detail_id: id},
            dataType: 'json',
            success: function (data) {
                if (data !== false) {
                    $('#salesReturnPrice').val(accounting.formatMoney(data['item'][0].price, "Rp. ", 0, ",")+" | Diskon "+data['item'][0].discount+"%");
                    $('#salesReturnAmount').val(data['item'][0].quantity);
                } else {
                    $('#salesReturnPrice').val('Tidak ada data');
                    $('#salesReturnAmount').val('Tidak ada data');
                }
            }
        });
    });

    var tableTbody = $('#table-item').find('tbody'),
        tableIndex = tableTbody.find('tr').size(),
        form = $('#sales-return-form'),
        sb = new StringBuilder(),
        dropdown = $('#salesReturnAddItem');

    $('#salesReturnAddItemButton').on("click", function () {
        idAddItem = dropdown.find('option:selected').val();
        if (idAddItem) {
            findItemName(tableIndex, idAddItem);
        } else {
            alert('Pilih Barang Terlebih Dahulu');
        }
    });

    function findItemName(index, id) {
        $.ajax({
            url: baseUrl + '/sales-return/ajax-item-row',
            type: 'post',
            data: {sales_detail_id: id},
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
        sb.append('<td>');

        sb.append(data['item'][0].name);
        sb.append('<input name="SalesReturnDetail[' + index + '][srd_name]" type="hidden" value="' + data['item'][0].name + '">');
        sb.append('<input name="SalesReturnDetail[' + index + '][sales_detail_id]" type="hidden" value="' + data['item'][0].id + '">');
        sb.append('<input class="itemId" type="hidden" value="' + data['item'][0].id + '">');

        if(data['type'] === 2) {
            sb.append('<ul>');

            for (i = 0; i < data['item'][0].detail.length; i++) {
                sb.append('<li>' + data['item'][0].detail[i].detailName + '</li>');
            }
        }

        sb.append('</ul> ');
        sb.append('</td>');

        sb.append('<td class="text-center">');
        sb.append(accounting.formatMoney(data['item'][0].price, "Rp. ", 0, ","));
        sb.append('<input name="SalesReturnDetail[' + index + '][srd_price]" type="hidden" value="' + data['item'][0].price + '">');
        sb.append('</td>');
        sb.append('<td class="text-center">');
        sb.append(data['item'][0].quantity);
        sb.append('<input name="SalesReturnDetail[' + index + '][srd_quantity]" type="hidden" value="' + data['item'][0].quantity + '">');
        sb.append('</td>');
        sb.append('<td class="text-center">');
        sb.append(accounting.formatMoney(data['item'][0].total, "Rp. ", 0, ","));
        sb.append('<input name="SalesReturnDetail[' + index + '][srd_total]" type="hidden" value="' + data['item'][0].quantity * data['item'][0].price + '" data-cell="A' + index + '" >');
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
            url: baseUrl + '/sales-return/ajax-item-detail',
            type: 'post',
            data: {sales_detail_id: id},
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
        $("#salesReturnAddItem").find("option[value='" + $(this).val() + "']").remove();
        $('#salesReturnAddItem').trigger("chosen:updated");
    });

    $(document).on('click', '.btn-remove-ajax', function () {
        if (confirm('Data akan terhapus secara permanen. Teruskan?')) {
            var id = $(this).data('id'),
                salesDetailId = $(this).data('detail'),
                controller = $(this).data('controller'),
                tr = $(this).closest('tr');

            $.ajax({
                url: baseUrl + '/' + controller + '/ajax-sales-return-detail-delete',
                dataType: "json",
                type: 'post',
                data: {id: id},
                success: function (data) {
                    if (data !== false) {
                        $.ajax({
                            url: baseUrl + '/sales-return/ajax-item-detail',
                            type: 'post',
                            data: {sales_detail_id: salesDetailId},
                            dataType: 'json',
                            success: function (data) {
                                if (data !== false) {
                                    id = data['item'][0].id;
                                    name = data['item'][0].name;
                                    $('#salesReturnAddItem').append($('<option>', {
                                        value: id,
                                        text: name
                                    }));
                                    $('#salesReturnAddItem').trigger("chosen:updated");
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