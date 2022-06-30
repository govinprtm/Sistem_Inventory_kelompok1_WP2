<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid px-3">
      <div class="row">
        <div class="col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item"><a href="<?php echo base_url('groups/') ?>">Grup</a></li>
            <li class="breadcrumb-item active">Tambah Grup</li>
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
            <div class="card-header py-1">
              <a href="<?php echo base_url('groups/') ?>" class="btn"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
            <form role="form" action="<?php base_url('groups/create') ?>" method="post">
              <div class="card-body">

                <?php if (validation_errors()) : ?>
                  <div class="callout callout-danger">
                    <?php echo validation_errors(); ?>
                  </div>
                <?php endif; ?>

                <div class="form-group">
                  <label for="group_name">Nama Grup</label>
                  <input type="text" class="form-control" id="group_name" name="group_name" placeholder="Masukkan nama grup">
                </div>
                <div class="form-group">
                  <label for="permission">Hak Akses</label>

                  <table class="table table-responsive">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Create</th>
                        <th>Update</th>
                        <th>View</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Pengguna</td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="createUser" value="createUser"><label for="createUser"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="updateUser" value="updateUser"><label for="updateUser"></label< /div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="viewUser" value="viewUser"><label for="viewUser"></label< /div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="deleteUser" value="deleteUser"><label for="deleteUser"></label< /div>
                        </td>
                      </tr>
                      <tr>
                        <td>Grup</td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="createGroup" value="createGroup"><label for="createGroup"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="updateGroup" value="updateGroup"><label for="updateGroup"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="viewGroup" value="viewGroup"><label for="viewGroup"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="deleteGroup" value="deleteGroup"><label for="deleteGroup"></label></div>
                        </td>
                      </tr>
                      <tr>
                        <td>Merek</td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="createBrand" value="createBrand"><label for="createBrand"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="updateBrand" value="updateBrand"><label for="updateBrand"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="viewBrand" value="viewBrand"><label for="viewBrand"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="deleteBrand" value="deleteBrand"><label for="deleteBrand"></label></div>
                        </td>
                      </tr>
                      <tr>
                        <td>Kategori</td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="createCategory" value="createCategory"><label for="createCategory"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="updateCategory" value="updateCategory"><label for="updateCategory"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="viewCategory" value="viewCategory"><label for="viewCategory"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="deleteCategory" value="deleteCategory"><label for="deleteCategory"></label></div>
                        </td>
                      </tr>
                      <tr>
                        <td>Suplier</td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="createStore" value="createStore"><label for="createStore"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="updateStore" value="updateStore"><label for="updateStore"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="viewStore" value="viewStore"><label for="viewStore"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="deleteStore" value="deleteStore"><label for="deleteStore"></label></div>
                        </td>
                      </tr>
                      <tr>
                        <td>Atribut</td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="createAttribute" value="createAttribute"><label for="createAttribute"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="updateAttribute" value="updateAttribute"><label for="updateAttribute"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="viewAttribute" value="viewAttribute"><label for="viewAttribute"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="deleteAttribute" value="deleteAttribute"><label for="deleteAttribute"></label></div>
                        </td>
                      </tr>
                      <tr>
                        <td>Produk</td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="createProduct" value="createProduct"><label for="createProduct"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="updateProduct" value="updateProduct"><label for="updateProduct"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="viewProduct" value="viewProduct"><label for="viewProduct"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="deleteProduct" value="deleteProduct"><label for="deleteProduct"></label></div>
                        </td>
                      </tr>
                      <tr>
                        <td>Penjualan</td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="createSales" value="createSales"><label for="createSales"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="updateSales" value="updateSales"><label for="updateSales"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="viewSales" value="viewSales"><label for="viewSales"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="deleteSales" value="deleteSales"><label for="deleteSales"></label></div>
                        </td>
                      </tr>
                      <tr>
                        <td>Pembelian</td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="createPurchases" value="createPurchases"><label for="createPurchases"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="updatePurchases" value="updatePurchases"><label for="updatePurchases"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="viewPurchases" value="viewPurchases"><label for="viewPurchases"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="deletePurchases" value="deletePurchases"><label for="deletePurchases"></label></div>
                        </td>
                      </tr>
                      <tr>
                        <td>Order</td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="createOrders" value="createOrders"><label for="createOrders"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="updateOrders" value="updateOrders"><label for="updateOrders"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="viewOrders" value="viewOrders"><label for="viewOrders"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="deleteOrders" value="deleteOrders"><label for="deleteOrders"></label></div>
                        </td>
                      </tr>
                      <tr>
                        <td>Laporan</td>
                        <td> - </td>
                        <td> - </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="viewReports" value="viewReports"><label for="viewReports"></label></div>
                        </td>
                        <td> - </td>
                      </tr>
                      <tr>
                        <td>Perusahaan</td>
                        <td> - </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="updateCompany" value="updateCompany"><label for="updateCompany"></label></div>
                        </td>
                        <td> - </td>
                        <td> - </td>
                      </tr>
                      <tr>
                        <td>Profil</td>
                        <td> - </td>
                        <td> - </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="viewProfil" value="viewProfile"><label for="viewProfil"></label></div>
                        </td>
                        <td> - </td>
                      </tr>
                      <tr>
                        <td>Pengaturan</td>
                        <td>-</td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="updSetting" value="updateSetting"><label for="updSetting"></label></div>
                        </td>
                        <td> - </td>
                        <td> - </td>
                      </tr>
                    </tbody>
                  </table>

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
    $("#mainGroupNav").addClass('menu-is-opening menu-open');
    $("#GroupNav").addClass('active');
    $("#addGroupNav .nav-link").addClass('active');

    $('input[type="checkbox"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
  });
</script>