<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid px-3">
            <div class="row">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="./">Home</a></li>
                        <li class="breadcrumb-item active">Edit Pembelian</li>
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
                                            <label>No Purchase</label>
                                            <input type="text" class="form-control" id="purchase_no" name="purchase_no" autocomplete="off" value="<?= $purchases_data['purchases']['purchase_no']; ?>" disabled />
                                        </div>
                                        <div class="form-group">
                                            <label>No Order</label>
                                            <input type="text" class="form-control" value="<?= $data_orders['order_no']; ?>/<?= $data_orders['supplier']; ?>" disabled />
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label>Tanggal</label>
                                            <input type="date" class="form-control" id="purchase_date" name="purchase_date" placeholder="Tanggal Transaksi" autocomplete="off" value="<?= date('Y-m-d', strtotime($purchases_data['purchases']['purchase_date'])); ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Jatuh Tempo:</label>
                                            <input type="date" class="form-control" id="due_date" name="due_date" placeholder="Tanggal Jatuh Tempo" autocomplete="off" value="<?= date('Y-m-d', strtotime($purchases_data['purchases']['due_date'])); ?>" />
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
                                        <?php if (isset($purchases_data['orders_item'])) : ?>
                                            <?php $x = 1; ?>
                                            <?php foreach ($purchases_data['orders_item'] as $key => $val) : ?>
                                                <tr id="row_<?php echo $x; ?>">
                                                    <td>
                                                        <?php foreach ($products as $k => $v) : ?>
                                                            <?php echo $v['name'] ?>
                                                        <?php endforeach ?>
                                                    </td>
                                                    <td><?php echo $val['qty'] ?></td>
                                                    <td>
                                                        <?php echo $val['rate'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $val['amount'] ?>
                                                    </td>
                                                </tr>
                                                <?php $x++; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>

                                <div class="row mt-3">
                                    <div class="col-md-5">
                                        <div class="border p-3">
                                            <h6>Proses pembayaran</h6>
                                            <div class="form-group">
                                                <label for="paid_status" class="col-form-label">Status Bayar</label>
                                                <select type="text" class="form-control <?php if (form_error('paid_status')) { ?> <?= "is-invalid"; ?> <?php }; ?>" id="paid_status" name="paid_status">
                                                    <option value="1" <?php if ($purchases_data['purchases']['paid_status'] == 1) { ?> <?php echo "selected='selected'"; ?> <?php } ?>>Dibayar</option>
                                                    <option value="2" <?php if ($purchases_data['purchases']['paid_status'] == 2) { ?> <?php echo "selected='selected'"; ?> <?php } ?>>Belum dibayar</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    <?= form_error('paid_status'); ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Jumlah Pembayaran</label>
                                                <input type="number" id="amount_paid" name="amount_paid" class="form-control <?php if (form_error('amount_paid')) { ?> <?= "is-invalid"; ?> <?php }; ?>" placeholder="Jumlah Pembayaran" value="<?= $purchases_data['purchases']['amount_paid']; ?>">
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
                                                <input type="text" class="form-control" id="net_amount" name="net_amount" value="<?= $data_orders['net_amount']; ?>" disabled autocomplete="off">
                                                <input type="hidden" id="net_amount_value" name="net_amount_value" value="<?= $data_orders['net_amount']; ?>">

                                                <input type="hidden" class="form-control" id="id_order" name="id_order" value="<?= $purchases_data['purchases']['order_id']; ?>">
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
        $("#managePurchasesNav .nav-link").addClass('active');

    }); // /document
</script>