<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid px-3">
      <div class="row">
        <div class="col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Home</a></li>
            <li class="breadcrumb-item active">Perusahaan</li>
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

          <div class="card">
            <div class="card-header">
              <ul class="nav nav-pills" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Profil Bisnis</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="tax-tab" data-toggle="tab" href="#tax" role="tab" aria-controls="tax" aria-selected="false">Pajak & Biaya</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Kontak</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="code-tab" data-toggle="tab" href="#code" role="tab" aria-controls="code" aria-selected="false">Kode Nomor</a>
                </li>
              </ul>
            </div>
            <form role="form" action="<?php base_url('company/update') ?>" method="post">
              <div class="card-body">

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

                <?php if (validation_errors()) : ?>
                  <div class="callout callout-danger">
                    <?php echo validation_errors(); ?>
                  </div>
                <?php endif; ?>

                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="form-group">
                      <label for="company_name">Nama Perusahaan</label>
                      <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Masukkan nama perusahaan" value="<?php echo $company_data['company_name'] ?>" autocomplete="off">
                    </div>
                    <div class="form-group">
                      <label for="address">Alamat</label>
                      <input type="text" class="form-control" id="address" name="address" placeholder="Masukkan alamat" value="<?php echo $company_data['address'] ?>" autocomplete="off">
                    </div>
                    <div class="form-group">
                      <label for="country">Negara</label>
                      <input type="text" class="form-control" id="country" name="country" placeholder="Masukkan negara" value="<?php echo $company_data['country'] ?>" autocomplete="off">
                    </div>
                    <div class="form-group">
                      <label for="permission">Pesan</label>
                      <textarea class="textarea" name="message" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                     <?php echo $company_data['message'] ?>
                  </textarea>
                    </div>
                    <div class="form-group">
                      <label for="currency">Mata uang</label>
                      <?php ?>
                      <select class="form-control" id="currency" name="currency">
                        <option value="">--Pilih--</option>
                        <?php foreach ($currency_symbols as $k => $v) : ?>
                          <option value="<?php echo trim($k); ?>" <?php if ($company_data['currency'] == $k) { ?> <?php echo "selected"; ?> <?php } ?>><?php echo $k ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="tax" role="tabpanel" aria-labelledby="tax-tab">
                    <div class="form-group">
                      <label for="service_charge_value">Biaya Layanan (%)</label>
                      <input type="text" class="form-control" id="service_charge_value" name="service_charge_value" placeholder="Masukkan jumlah tagihan %" value="<?php echo $company_data['service_charge_value'] ?>" autocomplete="off">
                    </div>
                    <div class="form-group">
                      <label for="vat_charge_value">Pajak PPN (%)</label>
                      <input type="text" class="form-control" id="vat_charge_value" name="vat_charge_value" placeholder="Masukkan biaya PPN%" value="<?php echo $company_data['vat_charge_value'] ?>" autocomplete="off">
                    </div>
                  </div>
                  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="form-group">
                      <label for="phone">Telepon</label>
                      <input type="text" class="form-control" id="phone" name="phone" placeholder="Masukkan telepon" value="<?php echo $company_data['phone'] ?>" autocomplete="off">
                    </div>
                  </div>
                  <div class="tab-pane fade" id="code" role="tabpanel" aria-labelledby="code-tab">
                    <div class="form-group">
                      <label for="code_sales">Kode Penjualan</label>
                      <input type="text" class="form-control" id="code_sales" name="code_sales" placeholder="Masukkan kode penjualan" value="<?php echo $company_data['code_sales'] ?>" autocomplete="off">
                    </div>
                    <div class="form-group">
                      <label for="code_orders">Kode Order</label>
                      <input type="text" class="form-control" id="code_orders" name="code_orders" placeholder="Masukkan kode order" value="<?php echo $company_data['code_orders'] ?>" autocomplete="off">
                    </div>
                    <div class="form-group">
                      <label for="code_purchases">Kode Pembelian</label>
                      <input type="text" class="form-control" id="code_purchases" name="code_purchases" placeholder="Masukkan kode pembelian" value="<?php echo $company_data['code_purchases'] ?>" autocomplete="off">
                    </div>
                  </div>
                </div>

              </div>
              <!-- /.box-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-lg">Simpan</button>
              </div>
            </form>
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
  $(document).ready(function() {
    $("#companyNav .nav-link").addClass('active');
    $("#message").wysihtml5();
  });
</script>
<script>
  $(function() {
    // Summernote
    $('.textarea').summernote()
  })
</script>