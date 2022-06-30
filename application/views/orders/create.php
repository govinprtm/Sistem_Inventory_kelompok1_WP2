<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid px-3">
            <div class="row">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="./">Home</a></li>
                        <li class="breadcrumb-item active">Order Barang Baru</li>
                    </ol>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"></h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid px-3 pb-3">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12 col-xs-12">

                    <div id="messages"></div>

                    <?php if ($this->session->flashdata('success')) : ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <?php echo $this->session->flashdata('success'); ?>
                        </div>
                    <?php elseif ($this->session->flashdata('error')) : ?>
                        <div class="alert alert-error alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <?php echo $this->session->flashdata('error'); ?>
                        </div>
                    <?php endif; ?>


                    <div class="card">
                        <!-- /.box-header -->
                        <div class="card-header py-2">
                            <a href="<?php echo base_url('orders/') ?>" class="btn"><i class="fa fa-arrow-left"></i> Kembali</a>
                        </div>
                        <form role="form" action="<?php base_url('orders/create') ?>" method="post" class="form-horizontal">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Suplier/Vendor</label>
                                            <select class="form-control select_group store <?php if (form_error('store_id')) { ?> <?= "is-invalid"; ?> <?php }; ?>" id="store_id" name="store_id" style="width:100%;">
                                                <option value="">Pilih Suplier</option>
                                                <?php foreach ($suppliers as $r => $v) : ?>
                                                    <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                <?= form_error('store_id'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Transaksi</label>
                                            <input type="date" class="form-control" id="order_date" name="order_date" placeholder="Tanggal Transaksi" autocomplete="off" value="<?= date('Y-m-d'); ?>" />
                                        </div>
                                    </div>

                                    <div class="col">

                                    </div>
                                </div>

                                <table class="table table-bordered" id="product_info_table">
                                    <thead>
                                        <tr>
                                            <th style="width:40%">Produk</th>
                                            <th style="width:15%">Qty</th>
                                            <th style="width:15%">Harga</th>
                                            <th style="width:20%">Total</th>
                                            <th style="width:10%"><button type="button" id="add_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr id="row_1">
                                            <td>
                                                <select class="form-control select_group product <?php if (form_error('product[]')) { ?> <?= "is-invalid"; ?> <?php }; ?>" data-row-id="row_1" id="product_1" name="product[]" style="width:100%;" onchange="getProductData(1)">
                                                    <option value="">Pilih Produk</option>
                                                    <?php foreach ($products as $k => $v) : ?>
                                                        <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    <?= form_error('product[]'); ?>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="number" name="qty[]" id="qty_1" class="form-control <?php if (form_error('qty[]')) { ?> <?= "is-invalid"; ?> <?php }; ?>" onchange="getTotal(1)">
                                                <div class="invalid-feedback">
                                                    <?= form_error('qty[]'); ?>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="text" name="rate[]" id="rate_1" class="form-control" disabled autocomplete="off">
                                                <input type="hidden" name="rate_value[]" id="rate_value_1" class="form-control" autocomplete="off">
                                            </td>
                                            <td>
                                                <input type="text" name="amount[]" id="amount_1" class="form-control" disabled autocomplete="off">
                                                <input type="hidden" name="amount_value[]" id="amount_value_1" class="form-control" autocomplete="off">
                                            </td>
                                            <td><button type="button" class="btn btn-default" onclick="removeRow('1')"><i class="fas fa-trash"></i></button></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="row">
                                    <div class="col-md-5 ml-auto mt-3">

                                        <input type="hidden" class="form-control" id="gross_amount" name="gross_amount" disabled autocomplete="off">
                                        <input type="hidden" id="gross_amount_value" name="gross_amount_value" autocomplete="off">

                                        <div class="form-group row">
                                            <label for="net_amount" class="col-4 col-form-label">Total Harga</label>
                                            <div class="col-8">
                                                <input type="text" class="form-control" id="net_amount" name="net_amount" disabled autocomplete="off">
                                                <input type="hidden" id="net_amount_value" name="net_amount_value" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-lg">Simpan</button>
                            </div>
                        </form>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- col-md-12 -->
            </div>
            <!-- /.row -->
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";

    $(document).ready(function() {
        $(".select_group").select2({
            theme: 'bootstrap4'
        })
        // $("#description").wysihtml5();

        $("#mainPurchasesNav").addClass('menu-is-opening menu-open');
        $("#PurchasesNav").addClass('active');
        $("#addOrdersNav .nav-link").addClass('active');

        var btnCust = '<button type="button" class="btn btn-secondary" title="Tambahkan tag gambar" ' +
            'onclick="alert(\'Hubungi kode kustom Anda di sini.\')">' +
            '<i class="glyphicon glyphicon-tag"></i>' +
            '</button>';

        // Add new row in the table 
        $("#add_row").unbind('click').bind('click', function() {
            var table = $("#product_info_table");
            var count_table_tbody_tr = $("#product_info_table tbody tr").length;
            var row_id = count_table_tbody_tr + 1;

            $.ajax({
                url: base_url + '/orders/getTableProductRow/',
                type: 'post',
                dataType: 'json',
                success: function(response) {

                    // console.log(reponse.x);
                    var html = '<tr id="row_' + row_id + '">' +
                        '<td>' +
                        '<select class="form-control select_group product" data-row-id="' + row_id + '" id="product_' + row_id + '" name="product[]" style="width:100%;" onchange="getProductData(' + row_id + ')">' +
                        '<option value=""></option>';
                    $.each(response, function(index, value) {
                        html += '<option value="' + value.id + '">' + value.name + '</option>';
                    });

                    html += '</select>' +
                        '</td>' +
                        '<td><input type="number" name="qty[]" id="qty_' + row_id + '" class="form-control" onchange="getTotal(' + row_id + ')"></td>' +
                        '<td><input type="text" name="rate[]" id="rate_' + row_id + '" class="form-control" disabled><input type="hidden" name="rate_value[]" id="rate_value_' + row_id + '" class="form-control"></td>' +
                        '<td><input type="text" name="amount[]" id="amount_' + row_id + '" class="form-control" disabled><input type="hidden" name="amount_value[]" id="amount_value_' + row_id + '" class="form-control"></td>' +
                        '<td><button type="button" class="btn btn-default" onclick="removeRow(\'' + row_id + '\')"><i class="fas fa-trash"></i></button></td>' +
                        '</tr>';

                    if (count_table_tbody_tr >= 1) {
                        $("#product_info_table tbody tr:last").after(html);
                    } else {
                        $("#product_info_table tbody").html(html);
                    }

                    $(".product").select2({
                        theme: 'bootstrap4'
                    });

                }
            });

            return false;
        });

    }); // /document

    function getTotal(row = null) {
        if (row) {
            var total = Number($("#rate_value_" + row).val()) * Number($("#qty_" + row).val());
            total = total.toFixed(0);
            $("#amount_" + row).val(total);
            $("#amount_value_" + row).val(total);

            subAmount();

        } else {
            alert('no row !! please refresh the page');
        }
    }

    // get the product information from the server
    function getProductData(row_id) {
        var product_id = $("#product_" + row_id).val();
        if (product_id == "") {
            $("#rate_" + row_id).val("");
            $("#rate_value_" + row_id).val("");

            $("#qty_" + row_id).val("");

            $("#amount_" + row_id).val("");
            $("#amount_value_" + row_id).val("");

        } else {
            $.ajax({
                url: base_url + 'sales/getProductValueById',
                type: 'post',
                data: {
                    product_id: product_id
                },
                dataType: 'json',
                success: function(response) {
                    // setting the rate value into the rate input field

                    $("#rate_" + row_id).val(response.price);
                    $("#rate_value_" + row_id).val(response.price);

                    $("#qty_" + row_id).val(1);
                    $("#qty_value_" + row_id).val(1);

                    var total = Number(response.price) * 1;
                    total = total.toFixed(0);
                    $("#amount_" + row_id).val(total);
                    $("#amount_value_" + row_id).val(total);

                    subAmount();
                } // /success
            }); // /ajax function to fetch the product data 
        }
    }

    // calculate the total amount of the sales
    function subAmount() {
        var tableProductLength = $("#product_info_table tbody tr").length;
        var totalSubAmount = 0;
        for (x = 0; x < tableProductLength; x++) {
            var tr = $("#product_info_table tbody tr")[x];
            var count = $(tr).attr('id');
            count = count.substring(4);

            totalSubAmount = Number(totalSubAmount) + Number($("#amount_" + count).val());
        } // /for

        totalSubAmount = totalSubAmount.toFixed(0);

        // sub total
        $("#gross_amount").val(totalSubAmount);
        $("#gross_amount_value").val(totalSubAmount);

        // total amount
        var totalAmount = (Number(totalSubAmount));
        totalAmount = totalAmount.toFixed(0);
        // $("#net_amount").val(totalAmount);
        // $("#totalAmountValue").val(totalAmount);

        $("#net_amount").val(totalAmount);
        $("#net_amount_value").val(totalAmount);

    } // /sub total amount

    function removeRow(tr_id) {
        $("#product_info_table tbody tr#row_" + tr_id).remove();
        subAmount();
    }
</script>