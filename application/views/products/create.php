<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid px-3">
      <div class="row">
        <div class="col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item"><a href="<?php echo base_url('products/') ?>">Daftar Produk</a></li>
            <li class="breadcrumb-item active">Tambah Produk</li>
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
            <div class="card-header py-1">
              <a href="<?php echo base_url('products/') ?>" class="btn"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
            <form role="form" action="<?php base_url('users/create') ?>" method="post" enctype="multipart/form-data">
              <div class="card-body">

                <?php if (validation_errors()) : ?>
                  <div class="callout callout-danger">
                    <?php echo validation_errors(); ?>
                  </div>
                <?php endif; ?>

                <div class="form-group">

                  <label for="product_image">Gambar</label>
                  <div class="kv-avatar">
                    <div class="file-loading">
                      <input id="product_image" name="product_image" type="file">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="product_name">Nama Produk</label>
                  <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Nama Produk" autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="barcode">Barcode</label>
                  <input type="text" class="form-control" id="barcode" name="barcode" placeholder="Barcode" autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="sku">SKU</label>
                  <input type="text" class="form-control" id="sku" name="sku" placeholder="SKU" autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="price">Harga</label>
                  <input type="text" class="form-control" id="price" name="price" placeholder="Harga" autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="qty">Stok</label>
                  <input type="text" class="form-control" id="qty" name="qty" placeholder="Stok" autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="description">Deskripsi</label>
                  <textarea class="textarea form-control" name="description" placeholder="Deskripsi" autocomplete="off">
                  </textarea>
                </div>

                <?php if ($attributes) : ?>
                  <?php foreach ($attributes as $k => $v) : ?>
                    <div class="form-group">
                      <label for="groups"><?php echo $v['attribute_data']['name'] ?></label>
                      <select class="form-control select_group" id="attributes_value_id" name="attributes_value_id[]" multiple="multiple">
                        <?php foreach ($v['attribute_value'] as $k2 => $v2) : ?>
                          <option value="<?php echo $v2['id'] ?>"><?php echo $v2['value'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  <?php endforeach ?>
                <?php endif; ?>

                <div class="form-group">
                  <label for="brands">Merek</label>
                  <select class="form-control select_group" id="brands" name="brands[]" multiple="multiple">
                    <?php foreach ($brands as $k => $v) : ?>
                      <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="category">Kategori</label>
                  <select class="form-control select_group" id="category" name="category[]" multiple="multiple">
                    <?php foreach ($category as $k => $v) : ?>
                      <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="store">Suplier</label>
                  <select class="form-control select_group" id="store" name="store">
                    <?php foreach ($stores as $k => $v) : ?>
                      <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="store">Ketersediaan</label>
                  <select class="form-control" id="availability" name="availability">
                    <option value="1">Ya</option>
                    <option value="2">Tidak</option>
                  </select>
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
  $(document).ready(function() {
    $(".select_group").select2({
      theme: 'bootstrap4'
    });
    $("#description").wysihtml5();

    $("#mainProductNav").addClass('menu-is-opening menu-open');
    $("#ProductNav").addClass('active');
    $("#addProductNav .nav-link").addClass('active');

    $("#product_image").fileinput({
      theme: "fas",
      overwriteInitial: true,
      maxFileSize: 1500,
      showClose: false,
      showCaption: false,
      browseLabel: '',
      removeLabel: '',
      browseIcon: '<i class="fas fa-folder-open"></i>',
      removeIcon: '<i class="fas fa-trash"></i>',
      removeTitle: 'Cancel or reset changes',
      elErrorContainer: '#kv-avatar-errors-1',
      msgErrorClass: 'alert alert-block alert-danger',
      // defaultPreviewContent: '<img src="/uploads/default_avatar_male.jpg" alt="Your Avatar">',
      layoutTemplates: {
        main2: '{preview} ' + ' {remove} {browse}'
      },
      allowedFileExtensions: ["jpg", "png", "gif"]
    });

  });
</script>
<script>
  $(function() {
    // Summernote
    $('.textarea').summernote()
  })
</script>