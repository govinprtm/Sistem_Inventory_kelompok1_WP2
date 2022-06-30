<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid px-3">
      <div class="row">
        <div class="col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active">Edit Penjualan</li>
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
              <a href="<?php echo base_url('sales/') ?>" class="btn"><i class="fa fa-arrow-left"></i> Kembali</a>
              <a target="__blank" href="<?php echo base_url() . 'sales/printDiv/' . $sales_data['sales']['id'] ?>" class="btn btn-default float-right"><i class="fas fa-print"></i> Cetak Invoice</a>
            </div>

            <form role="form" action="<?php base_url('sales/create') ?>" method="post" class="form-horizontal">
              <div class="card-body">

                <?php if (validation_errors()) : ?>
                  <div class="callout callout-danger">
                    <?php echo validation_errors(); ?>
                  </div>
                <?php endif; ?>

                <?php if ($sales_data['sales']['paid_status'] == 1) {
                  $paid_status = '<h2 class="text-success">Lunas</h2>';
                } else if ($sales_data['sales']['paid_status'] == 2) {
                  $paid_status = '<h2 class="text-danger">Belum Dibayar</h2>';
                } else {
                  $paid_status = '<h2 class="text-warning">Dibayar Sebagian</h2>';
                }
                echo $paid_status;
                ?>
                <br />

                <div class="row">
                  <div class="col">
                    <div class="form-group">
                      <label>Tanggal Transaksi:</label>
                      <input type="date" class="form-control" id="date_time" name="date_time" placeholder="Tanggal Transaksi" autocomplete="off" value="<?= date('Y-m-d', strtotime($sales_data['sales']['date_time'])); ?>" />
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label>Tanggal Jatuh Tempo:</label>
                      <input type="date" class="form-control" id="due_date" name="due_date" placeholder="Tanggal Jatuh Tempo" autocomplete="off" value="<?= date('Y-m-d', strtotime($sales_data['sales']['due_date'])); ?>" />
                    </div>
                  </div>
                </div>

                <div class="row">

                  <div class="col">
                    <div class="form-group">
                      <label for="gross_amount" class="control-label" style="text-align:left;">Nama Pelanggan</label>

                      <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Nama Pelanggan" value="<?php echo $sales_data['sales']['customer_name'] ?>" autocomplete="off" />
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label for="gross_amount" class="control-label" style="text-align:left;">Alamat Pelanggan</label>

                      <input type="text" class="form-control" id="customer_address" name="customer_address" placeholder="Alamat Pelanggan" value="<?php echo $sales_data['sales']['customer_address'] ?>" autocomplete="off">
                    </div>
                  </div>

                  <div class="col">
                    <div class="form-group">
                      <label for="gross_amount" class="control-label" style="text-align:left;">Telepon Pelanggan</label>

                      <input type="text" class="form-control" id="customer_phone" name="customer_phone" placeholder="Telepon Pelanggan" value="<?php echo $sales_data['sales']['customer_phone'] ?>" autocomplete="off">
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
                      <th style="width:10%"><button type="button" id="add_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>

                  <tbody>

                    <?php if (isset($sales_data['sales_item'])) : ?>
                      <?php $x = 1; ?>
                      <?php foreach ($sales_data['sales_item'] as $key => $val) : ?>
                        <?php //print_r($v); 
                        ?>
                        <tr id="row_<?php echo $x; ?>">
                          <td>
                            <select class="form-control select_group product" data-row-id="row_<?php echo $x; ?>" id="product_<?php echo $x; ?>" name="product[]" style="width:100%;" onchange="getProductData(<?php echo $x; ?>)">
                              <option value=""></option>
                              <?php foreach ($products as $k => $v) : ?>
                                <option value="<?php echo $v['id'] ?>" <?php if ($val['product_id'] == $v['id']) { ?> <?php echo "selected='selected'"; ?> <?php  } ?>><?php echo $v['name'] ?></option>
                              <?php endforeach ?>
                            </select>
                          </td>
                          <td><input type="number" name="qty[]" id="qty_<?php echo $x; ?>" class="form-control" onchange="getTotal(<?php echo $x; ?>)" value="<?php echo $val['qty'] ?>" autocomplete="off"></td>
                          <td>
                            <input type="text" name="rate[]" id="rate_<?php echo $x; ?>" class="form-control" disabled value="<?php echo $val['rate'] ?>" autocomplete="off">
                            <input type="hidden" name="rate_value[]" id="rate_value_<?php echo $x; ?>" value="<?php echo $val['rate'] ?>" autocomplete="off">
                          </td>
                          <td>
                            <input type="text" name="amount[]" id="amount_<?php echo $x; ?>" class="form-control" disabled value="<?php echo $val['amount'] ?>" autocomplete="off">
                            <input type="hidden" name="amount_value[]" id="amount_value_<?php echo $x; ?>" value="<?php echo $val['amount'] ?>" autocomplete="off">
                          </td>
                          <td><button type="button" class="btn btn-default" onclick="removeRow('<?php echo $x; ?>')"><i class="fas fa-trash"></i></button></td>
                        </tr>
                        <?php $x++; ?>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </tbody>
                </table>

                <div class="row mt-3">
                  <div class="col-md-5">
                    <div class="border p-3">
                      <h6>Terima pembayaran</h6>
                      <div class="form-group">
                        <label for="paid_status" class="col-form-label">Status Bayar</label>
                        <select type="text" class="form-control" id="paid_status" name="paid_status">
                          <option value="1" <?php if ($sales_data['sales']['paid_status'] == 1) { ?> <?php echo "selected='selected'"; ?> <?php } ?>>Dibayar</option>
                          <option value="2" <?php if ($sales_data['sales']['paid_status'] == 2) { ?> <?php echo "selected='selected'"; ?> <?php } ?>>Belum dibayar</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Total Dibayar</label>
                        <input type="number" id="amount_paid" name="amount_paid" class="form-control" placeholder="Jumlah Dibayar" value="<?php echo $sales_data['sales']['amount_paid'] ?>">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-5 ml-auto">
                    <div class="form-group row">
                      <label for="gross_amount" class="col-5 col-form-label">Jumlah</label>
                      <div class="col-7">
                        <input type="text" class="form-control" id="gross_amount" name="gross_amount" disabled value="<?php echo $sales_data['sales']['gross_amount'] ?>" autocomplete="off">
                        <input type="hidden" id="gross_amount_value" name="gross_amount_value" value="<?php echo $sales_data['sales']['gross_amount'] ?>" autocomplete="off">
                      </div>
                    </div>
                    <?php if ($is_service_enabled == true) : ?>
                      <div class="form-group row">
                        <label for="service_charge" class="col-5 col-form-label">Biaya Layanan <?php echo $company_data['service_charge_value'] ?> %</label>
                        <div class="col-7">
                          <input type="text" class="form-control" id="service_charge" name="service_charge" disabled value="<?php echo $sales_data['sales']['service_charge'] ?>" autocomplete="off">
                          <input type="hidden" id="service_charge_value" name="service_charge_value" value="<?php echo $sales_data['sales']['service_charge'] ?>" autocomplete="off">
                        </div>
                      </div>
                    <?php endif; ?>
                    <?php if ($is_vat_enabled == true) : ?>
                      <div class="form-group row">
                        <label for="vat_charge" class="col-5 col-form-label">PPN <?php echo $company_data['vat_charge_value'] ?> %</label>
                        <div class="col-7">
                          <input type="text" class="form-control" id="vat_charge" name="vat_charge" disabled value="<?php echo $sales_data['sales']['vat_charge'] ?>" autocomplete="off">
                          <input type="hidden" id="vat_charge_value" name="vat_charge_value" value="<?php echo $sales_data['sales']['vat_charge'] ?>" autocomplete="off">
                        </div>
                      </div>
                    <?php endif; ?>
                    <div class="form-group row">
                      <label for="discount" class="col-5 col-form-label">Diskon</label>
                      <div class="col-7">
                        <input type="text" class="form-control" id="discount" name="discount" placeholder="Diskon" onkeyup="subAmount()" value="<?php echo $sales_data['sales']['discount'] ?>" autocomplete="off">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="net_amount" class="col-5 col-form-label">Total Harga</label>
                      <div class="col-7">
                        <input type="text" class="form-control" id="net_amount" name="net_amount" disabled value="<?php echo $sales_data['sales']['net_amount'] ?>" autocomplete="off">
                        <input type="hidden" id="net_amount_value" name="net_amount_value" value="<?php echo $sales_data['sales']['net_amount'] ?>" autocomplete="off">
                      </div>
                    </div>

                  </div>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="card-footer">

                <input type="hidden" name="service_charge_rate" value="<?php echo $company_data['service_charge_value'] ?>" autocomplete="off">
                <input type="hidden" name="vat_charge_rate" value="<?php echo $company_data['vat_charge_value'] ?>" autocomplete="off">
                <button type="submit" class="btn btn-primary btn-lg">Update</button>
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
    });
    // $("#description").wysihtml5();

    $("#mainSalesNav").addClass('menu-is-opening menu-open');
    $("#SalesNav").addClass('active');
    $("#manageSalesNav .nav-link").addClass('active');

    // Add new row in the table 
    $("#add_row").unbind('click').bind('click', function() {
      var table = $("#product_info_table");
      var count_table_tbody_tr = $("#product_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;

      $.ajax({
        url: base_url + '/sales/getTableProductRow/',
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

    $("#paid_status").on('change', function() {
      if (this.value == "2") {
        $("#sebagian-box").show();
      } else {
        $("#sebagian-box").hide();
      }

    });

  }); // /document

  function getTotal(row = null) {
    if (row) {
      var total = Number($("#rate_value_" + row).val()) * Number($("#qty_" + row).val());
      total = total.toFixed(2);
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
          total = total.toFixed(2);
          $("#amount_" + row_id).val(total);
          $("#amount_value_" + row_id).val(total);

          subAmount();
        } // /success
      }); // /ajax function to fetch the product data 
    }
  }

  // calculate the total amount of the sales
  function subAmount() {
    var service_charge = <?php echo ($company_data['service_charge_value'] > 0) ? $company_data['service_charge_value'] : 0; ?>;
    var vat_charge = <?php echo ($company_data['vat_charge_value'] > 0) ? $company_data['vat_charge_value'] : 0; ?>;

    var tableProductLength = $("#product_info_table tbody tr").length;
    var totalSubAmount = 0;
    for (x = 0; x < tableProductLength; x++) {
      var tr = $("#product_info_table tbody tr")[x];
      var count = $(tr).attr('id');
      count = count.substring(4);

      totalSubAmount = Number(totalSubAmount) + Number($("#amount_" + count).val());
    } // /for

    totalSubAmount = totalSubAmount.toFixed(2);

    // sub total
    $("#gross_amount").val(totalSubAmount);
    $("#gross_amount_value").val(totalSubAmount);

    // vat
    var vat = (Number($("#gross_amount").val()) / 100) * vat_charge;
    vat = vat.toFixed(2);
    $("#vat_charge").val(vat);
    $("#vat_charge_value").val(vat);

    // service
    var service = (Number($("#gross_amount").val()) / 100) * service_charge;
    service = service.toFixed(2);
    $("#service_charge").val(service);
    $("#service_charge_value").val(service);

    // total amount
    var totalAmount = (Number(totalSubAmount) + Number(vat) + Number(service));
    totalAmount = totalAmount.toFixed(2);
    // $("#net_amount").val(totalAmount);
    // $("#totalAmountValue").val(totalAmount);

    var discount = $("#discount").val();
    if (discount) {
      var grandTotal = Number(totalAmount) - Number(discount);
      grandTotal = grandTotal.toFixed(2);
      $("#net_amount").val(grandTotal);
      $("#net_amount_value").val(grandTotal);
    } else {
      $("#net_amount").val(totalAmount);
      $("#net_amount_value").val(totalAmount);

    } // /else discount 

    var paid_amount = Number($("#paid_amount").val());
    if (paid_amount) {
      var net_amount_value = Number($("#net_amount_value").val());
      var remaning = net_amount_value - paid_amount;
      $("#remaining").val(remaning.toFixed(2));
      $("#remaining_value").val(remaning.toFixed(2));
    }

  } // /sub total amount

  function paidAmount() {
    var grandTotal = $("#net_amount_value").val();

    if (grandTotal) {
      var dueAmount = Number($("#net_amount_value").val()) - Number($("#paid_amount").val());
      dueAmount = dueAmount.toFixed(2);
      $("#remaining").val(dueAmount);
      $("#remaining_value").val(dueAmount);
    } // /if
  } // /paid amoutn function

  function removeRow(tr_id) {
    $("#product_info_table tbody tr#row_" + tr_id).remove();
    subAmount();
  }
</script>