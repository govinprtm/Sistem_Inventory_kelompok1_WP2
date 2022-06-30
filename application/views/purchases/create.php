<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid px-3">
            <div class="row">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="./">Home</a></li>
                        <li class="breadcrumb-item active">Pembelian Baru</li>
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
                            <a href="<?php echo base_url('purchases/') ?>" class="btn"><i class="fa fa-arrow-left"></i> Kembali</a>
                        </div>
                        <form role="form" action="<?php base_url('purchases/create') ?>" method="post" class="form-horizontal">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Tanggal</label>
                                            <input type="date" class="form-control" id="purchase_date" name="purchase_date" placeholder="Tanggal Transaksi" autocomplete="off" value="<?= date('Y-m-d'); ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>No Order</label>
                                            <select class="form-control select_group order <?php if (form_error('order_id')) { ?> <?= "is-invalid"; ?> <?php }; ?>" data-row-id="row_1" id="order_1" name="order_id" style="width:100%;" onchange="getOrders(1)">
                                                <option value="">Pilih Order</option>
                                                <?php foreach ($orders as $r => $v) : ?>
                                                    <option value="<?php echo $v['id'] ?>"><?php echo $v['order_no'] . ' / ' . $v['supplier'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                <?= form_error('order_id'); ?>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label>Tanggal Jatuh Tempo:</label>
                                            <input type="date" class="form-control" id="due_date" name="due_date" placeholder="Tanggal Jatuh Tempo" autocomplete="off" value="<?= date('Y-m-d', strtotime("+1 day")); ?>" />
                                        </div>
                                    </div>
                                </div>

                                <table class="table table-bordered" id="product_info_table">
                                    <thead>
                                        <tr>
                                            <th style="width:40%">Produk</th>
                                            <th style="width:15%">Qty</th>
                                            <th style="width:15%">Harga</th>
                                            <th style="width:20%">Total</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                    </tbody>
                                </table>

                                <div class="row mt-3">
                                    <div class="col-md-5">
                                        <div class="border p-3">
                                            <h6>Proses pembayaran</h6>
                                            <div class="form-group">
                                                <label for="paid_status" class="col-form-label">Status Bayar</label>
                                                <select type="text" class="form-control <?php if (form_error('paid_status')) { ?> <?= "is-invalid"; ?> <?php }; ?>" id="paid_status" name="paid_status">
                                                    <option value="1">Dibayar</option>
                                                    <option value="2">Belum dibayar</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    <?= form_error('paid_status'); ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Jumlah Pembayaran</label>
                                                <input type="number" id="amount_paid" name="amount_paid" class="form-control <?php if (form_error('amount_paid')) { ?> <?= "is-invalid"; ?> <?php }; ?>" placeholder="Jumlah Pembayaran">
                                                <div class="invalid-feedback">
                                                    <?= form_error('amount_paid'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 ml-auto">
                                        <div class="form-group row">
                                            <label for="net_amount" class="col-4 col-form-label">Total Harga</label>
                                            <div class="col-8">
                                                <input type="text" class="form-control" id="net_amount" name="net_amount" disabled autocomplete="off">
                                                <input type="hidden" id="net_amount_value" name="net_amount_value">

                                                <input type="hidden" class="form-control" id="id_order" name="id_order">
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
        $("#addPurchasesNav .nav-link").addClass('active');

    }); // /document

    function getOrders(row_id) {
        this.getOrderData(row_id);
        this.getOrderItemData(row_id);
    }

    // get the order information from the server
    function getOrderData(row_id) {
        var order_id = $("#order_" + row_id).val();
        $.ajax({
            url: base_url + 'purchases/getOrderValueById',
            type: 'post',
            data: {
                order_id: order_id
            },
            dataType: 'json',
            success: function(response) {
                // setting the rate value into the rate input field
                console.log(response);
                $("#id_order").val(response.id);
                $("#net_amount").val(response.net_amount);
                $("#net_amount_value").val(response.net_amount);
            } // /success
        }); // /ajax function to fetch the data 

    }

    // get the order information from the server
    function getOrderItemData(row_id) {
        var order_id = $("#order_" + row_id).val();
        $.ajax({
            url: base_url + 'purchases/getOrderItemValueById',
            type: 'post',
            data: {
                order_id: order_id
            },
            dataType: 'json',
            success: function(response) {
                // setting the rate value into the rate input field
                // console.log(reponse.x);
                var tr = '';
                $.each(response, function(i, item) {
                    tr += '<tr id="row_' + item.id + '"><td>' + item.product_name + '</td><td>' + item.qty + '</td><td>' + item.rate + '</td><td>' + item.amount + '</td></tr>';
                });
                $('#product_info_table tbody').html(tr);
            } // /success
        }); // /ajax function to fetch the data 

    }
</script>