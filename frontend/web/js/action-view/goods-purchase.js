/**
 * Created by User on 11/2/2017.
 */
jQuery(document).ready(function () {
    var baseUrl = $('#baseUrl').val();

    $('.goodsPurchaseAddItemModalButton').on("click", function (e) {
        e.preventDefault(); //for prevent default behavior of <a> tag.
        modalObject = $('#goodsPurchaseAddItemModal');
        modalObject.modal('show');
    });
    $(document).on("pjax:success", function () {
        $('.goodsPurchaseAddItemModalButton').on("click", function (e) {
            e.preventDefault(); //for prevent default behavior of <a> tag.
            modalObject = $('#goodsPurchaseAddItemModal');
            modalObject.modal('show');
        });
    });

    $(document).ready(function () {
        $("body").on("beforeSubmit", "form#addItemActiveForm", function () {
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
                    $("#goodsPurchaseAddItemModal").modal("toggle")
                        .on('hidden.bs.modal', function () {
                            $(this).find('form')[0].reset();
                        });
                    $.pjax.reload({container: "#pjaxItemList"}); //for pjax update
                },
                error: function () {
                    alert("Terjadi error, data tidak tersimpan");
                }
            });
            return false;
        });
    });

    $('.goodsPurchaseAddSupplierModalButton').on("click", function (e) {
        e.preventDefault(); //for prevent default behavior of <a> tag.
        modalObject = $('#goodsPurchaseAddSupplierModal');
        modalObject.modal('show');
    });
    $(document).on("pjax:success", function () {
        $('.goodsPurchaseAddSupplierModalButton').on("click", function (e) {
            e.preventDefault(); //for prevent default behavior of <a> tag.
            modalObject = $('#goodsPurchaseAddSupplierModal');
            modalObject.modal('show');
        });
    });

    $(document).ready(function () {
        $("body").on("beforeSubmit", "form#addSupplierActiveForm", function () {
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
                    $("#goodsPurchaseAddSupplierModal").modal("toggle")
                        .on('hidden.bs.modal', function () {
                            $(this).find('form')[0].reset();
                        });
                    $.pjax.reload({container: "#pjaxSupplierList"}); //for pjax update
                },
                error: function () {
                    alert("Terjadi error, data tidak tersimpan");
                }
            });
            return false;
        });
    });


    $(document).on('change', '#goodsPurchaseAddItem', function () {
        id = $(this).find('option:selected').val();
        $.ajax({
            url: baseUrl + '/goods-purchase/ajax-item-detail',
            type: 'post',
            data: {item_id: id},
            dataType: 'json',
            success: function (data) {
                if (data !== false) {
                    $('#goodsPurchasePrice').val(data['item'].i_buy_price);
                    $('#goodsPurchaseAmount').val(data['item'].i_stock_amount);
                    $('#goodsPurchaseExpiryDate').val(data['item'].i_expired_date);
                } else {
                    $('#goodsPurchasePrice').val('Tidak ada data');
                    $('#goodsPurchaseAmount').val('Tidak ada data');
                }
            }
        });
    });
    var tableTbody = $('#table-item').find('tbody'),
        tableIndex = tableTbody.find('tr').size(),
        form = $('#goods-purchase-form'),
        sb = new StringBuilder();

    $('#goodsPurchaseAddItemButton').on("click", function () {
        idAddItem = $('#goodsPurchaseAddItem').find('option:selected').val();
        if (idAddItem) {
            findItemName(tableIndex, idAddItem);
        }else{
            alert('Pilih Barang Terlebih Dahulu');
        }
    });

    function findItemName(index, id) {
        $.ajax({
            url: baseUrl + '/goods-purchase/ajax-item-detail',
            type: 'post',
            data: {item_id: id},
            dataType: 'json',
            success: function (data) {
                if (data !== false) {
                    name = data['item'].i_name;
                    insertRow(index, name);
                    tableIndex = tableTbody.find('tr').size();
                    $.pjax.reload({container: "#pjaxItemList"}); //for pjax update
                }
            }
        });
    }

    function insertRow(index, name) {
        itemPrice = $('#goodsPurchasePrice').val();
        itemAmount = $('#goodsPurchaseAmount').val();
        itemDate = $('#goodsPurchaseExpiryDate').val();
        itemId = $('#goodsPurchaseAddItem').val();
        sb.append('<tr>');
        sb.append('<td class="text-center">');
        sb.append(index+1);
        sb.append('</td>');
        sb.append('<td class="text-center">');
        sb.append(name);
        sb.append('<input name="GpDetail['+index+'][item_id]" type="hidden" value="'+itemId+'">');
        sb.append('</td>');
        sb.append('<td class="text-center">');
        sb.append('Rp. '+itemPrice);
        sb.append('<input name="GpDetail['+index+'][gpd_price]" type="hidden" value="'+itemPrice+'">');
        sb.append('</td>');
        sb.append('<td class="text-center">');
        sb.append(itemAmount);
        sb.append('<input name="GpDetail['+index+'][gpd_quantity]" type="hidden" value="'+itemAmount+'">');
        sb.append('</td>');
        sb.append('<td class="text-center">');
        sb.append('Rp. '+itemPrice*itemAmount);
        sb.append('<input data-cell="A'+index+'" value="'+(itemPrice*itemAmount)+'" name="total" type="hidden">');
        sb.append('</td>');
        sb.append('<td class="text-center">');
        sb.append(itemDate);
        sb.append('<input name="GpDetail['+index+'][gpd_expire_date]" type="hidden" value="'+itemDate+'">');
        sb.append('</td>');
        sb.append('<td class="text-center">');
        sb.append('<button type="button" class="btn btn-xs btn-danger btn-remove">Hapus</button>');
        sb.append('</td>');
        sb.append('</tr>');
        tableTbody.append(sb.toString());
        sb.clear();

        form.calx('update').calx('calculate');
    }

    $(document).on('click', '.btn-remove', function(){
        $(this).closest('tr').remove();
        form.calx('update').calx('calculate');
    });

    $(document).on('click', '.btn-remove-ajax', function(){
        if (confirm('Data akan terhapus secara permanen. Teruskan?')) {
            var id = $(this).data('id'),
                controller = $(this).data('controller'),
                tr = $(this).closest('tr');

            $.ajax({
                url: baseUrl + '/'+ controller +'/ajax-item-detail-delete',
                dataType: "json",
                type: 'post',
                data: {id: id},
                success: function(data) {
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

