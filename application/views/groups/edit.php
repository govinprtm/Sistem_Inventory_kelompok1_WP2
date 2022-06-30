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
            <li class="breadcrumb-item active">Edit Grup</li>
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
            <form role="form" action="<?php base_url('groups/update') ?>" method="post">
              <div class="card-body">

                <?php if (validation_errors()) : ?>
                  <div class="callout callout-danger">
                    <?php echo validation_errors(); ?>
                  </div>
                <?php endif; ?>

                <div class="form-group">
                  <label for="group_name">Nama Grup</label>
                  <input type="text" class="form-control" id="group_name" name="group_name" placeholder="Masukkan nama grup" value="<?php echo $group_data['group_name']; ?>">
                </div>
                <div class="form-group">
                  <label for="permission">Hak Akses</label>

                  <?php $serialize_permission = unserialize($group_data['permission']); ?>

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
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="createUser" value="createUser" <?php if ($serialize_permission) { ?> <?php if (in_array('createUser', $serialize_permission)) { ?> <?php echo "checked"; ?> <?php } ?> <?php } ?>><label for="createUser"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="updateUser" value="updateUser" <?php if ($serialize_permission) { ?> <?php if (in_array('updateUser', $serialize_permission)) { ?> <?php echo "checked"; ?> <?php } ?> <?php } ?>><label for="updateUser"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="viewUser" value="viewUser" <?php if ($serialize_permission) { ?> <?php if (in_array('viewUser', $serialize_permission)) { ?> <?php echo "checked"; ?> <?php } ?> <?php } ?>><label for="viewUser"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="deleteUser" value="deleteUser" <?php if ($serialize_permission) { ?><?php if (in_array('deleteUser', $serialize_permission)) { ?><?php echo "checked"; ?><?php } ?><?php } ?>><label for="deleteUser"></label></div>
                        </td>
                      </tr>
                      <tr>
                        <td>Grup</td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="createGroup" value="createGroup" <?php if ($serialize_permission) { ?> <?php if (in_array('createGroup', $serialize_permission)) { ?> <?php echo "checked"; ?> <?php } ?> <?php } ?>><label for="createGroup"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="permission" value="updateGroup" <?php if ($serialize_permission) { ?> <?php if (in_array('updateGroup', $serialize_permission)) { ?> <?php echo "checked"; ?> <?php  } ?> <?php } ?>><label for="updateGroup"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="viewGroup" value="viewGroup" <?php if ($serialize_permission) { ?> <?php if (in_array('viewGroup', $serialize_permission)) { ?> <?php echo "checked"; ?> <?php } ?> <?php } ?>><label for="viewGroup"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="deleteGroup" value="deleteGroup" <?php if ($serialize_permission) { ?> <?php if (in_array('deleteGroup', $serialize_permission)) { ?> <?php echo "checked"; ?> <?php  } ?> <?php } ?>><label for="deleteGroup"></label></div>
                        </td>
                      </tr>
                      <tr>
                        <td>Merek</td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="createBrand" value="createBrand" <?php if ($serialize_permission) { ?> <?php if (in_array('createBrand', $serialize_permission)) { ?> <?php echo "checked"; ?> <?php } ?> <?php } ?>><label for="createBrand"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="updateBrand" value="updateBrand" <?php if ($serialize_permission) { ?> <?php if (in_array('updateBrand', $serialize_permission)) { ?> <?php echo "checked"; ?> <?php  } ?> <?php } ?>><label for="updateBrand"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="viewBrand" value="viewBrand" <?php if ($serialize_permission) { ?> <?php if (in_array('viewBrand', $serialize_permission)) { ?> <?php echo "checked"; ?> <?php } ?> <?php } ?>><label for="viewBrand"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="deleteBrand" value="deleteBrand" <?php if ($serialize_permission) { ?> <?php if (in_array('deleteBrand', $serialize_permission)) { ?> <?php echo "checked"; ?> <?php  } ?> <?php } ?>><label for="deleteBrand"></label></div>
                        </td>
                      </tr>
                      <tr>
                        <td>Kategori</td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="createCategory" value="createCategory" <?php if ($serialize_permission) { ?> <?php if (in_array('createCategory', $serialize_permission)) { ?> <?php echo "checked"; ?> <?php } ?> <?php } ?>><label for="createCategory"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="updateCategory" value="updateCategory" <?php if ($serialize_permission) { ?> <?php if (in_array('updateCategory', $serialize_permission)) { ?> <?php echo "checked"; ?> <?php } ?> <?php } ?>><label for="updateCategory"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="viewCategory" value="viewCategory" <?php if ($serialize_permission) { ?> <?php if (in_array('viewCategory', $serialize_permission)) { ?> <?php echo "checked"; ?> <?php } ?> <?php } ?>><label for="viewCategory"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="deleteCategory" value="deleteCategory" <?php if ($serialize_permission) { ?> <?php if (in_array('deleteCategory', $serialize_permission)) { ?> <?php echo "checked"; ?> <?php } ?> <?php } ?>><label for="deleteCategory"></label></div>
                        </td>
                      </tr>
                      <tr>
                        <td>Supplier</td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="createStore" value="createStore" <?php if ($serialize_permission) { ?> <?php if (in_array('createStore', $serialize_permission)) { ?> <?php echo "checked"; ?> <?php  } ?> <?php  } ?>><label for="createStore"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="updateStore" value="updateStore" <?php if ($serialize_permission) { ?> <?php if (in_array('updateStore', $serialize_permission)) { ?> <?php echo "checked"; ?> <?php } ?> <?php } ?>><label for="updateStore"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="viewStore" value="viewStore" <?php if ($serialize_permission) { ?> <?php if (in_array('viewStore', $serialize_permission)) { ?> <?php echo "checked"; ?> <?php } ?> <?php } ?>><label for="viewStore"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="deleteStore" value="deleteStore" <?php if ($serialize_permission) { ?> <?php if (in_array('deleteStore', $serialize_permission)) { ?> <?php echo "checked"; ?> <?php } ?> <?php } ?>><label for="deleteStore"></label></div>
                        </td>
                      </tr>
                      <tr>
                        <td>Atribut</td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="createAttribute" value="createAttribute" <?php if ($serialize_permission) { ?> <?php if (in_array('createAttribute', $serialize_permission)) { ?> <?php echo "checked"; ?> <?php } ?> <?php } ?>><label for="createAttribute"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="updateAttribute" value="updateAttribute" <?php if ($serialize_permission) { ?> <?php if (in_array('updateAttribute', $serialize_permission)) { ?> <?php echo "checked"; ?> <?php } ?> <?php } ?>><label for="updateAttribute"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="viewAttribute" value="viewAttribute" <?php if ($serialize_permission) { ?> <?php if (in_array('viewAttribute', $serialize_permission)) { ?> <?php echo "checked"; ?> <?php } ?> <?php } ?>><label for="viewAttribute"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="deleteAttribute" value="deleteAttribute" <?php if ($serialize_permission) { ?> <?php if (in_array('deleteAttribute', $serialize_permission)) { ?> <?php echo "checked"; ?> <?php } ?> <?php } ?>><label for="deleteAttribute"></label></div>
                        </td>
                      </tr>
                      <tr>
                        <td>Produk</td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="createProduct" value="createProduct" <?php if ($serialize_permission) { ?> <?php if (in_array('createProduct', $serialize_permission)) { ?> <?php echo "checked"; ?> <?php } ?> <?php } ?>><label for="createProduct"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="updateProduct" value="updateProduct" <?php if ($serialize_permission) { ?> <?php if (in_array('updateProduct', $serialize_permission)) { ?> <?php echo "checked"; ?> <?php } ?> <?php } ?>><label for="updateProduct"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="viewProduct" value="viewProduct" <?php if ($serialize_permission) { ?> <?php if (in_array('viewProduct', $serialize_permission)) { ?> <?php echo "checked"; ?> <?php } ?> <?php } ?>><label for="viewProduct"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="deleteProduct" value="deleteProduct" <?php if ($serialize_permission) { ?> <?php if (in_array('deleteProduct', $serialize_permission)) { ?> <?php echo "checked"; ?> <?php } ?> <?php } ?>><label for="deleteProduct"></label></div>
                        </td>
                      </tr>
                      <tr>
                        <td>Penjualan</td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="createSales" value="createSales" <?php if ($serialize_permission) { ?> <?php if (in_array('createSales', $serialize_permission)) { ?> <?php echo "checked"; ?> <?php  } ?> <?php } ?>><label for="createSales"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="updateSales" value="updateSales" <?php if ($serialize_permission) { ?> <?php if (in_array('updateSales', $serialize_permission)) { ?> <?php echo "checked"; ?> <?php } ?> <?php } ?>><label for="updateSales"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="viewSales" value="viewSales" <?php if ($serialize_permission) { ?> <?php if (in_array('viewSales', $serialize_permission)) { ?> <?php echo "checked"; ?> <?php } ?> <?php } ?>><label for="viewSales"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="deleteSales" value="deleteSales" <?php if ($serialize_permission) { ?> <?php if (in_array('deleteSales', $serialize_permission)) { ?> <?php echo "checked"; ?> <?php } ?> <?php } ?>><label for="deleteSales"></label></div>
                        </td>
                      </tr>
                      <tr>
                        <td>Pembelian</td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="createPurchases" value="createPurchases" <?php if ($serialize_permission) { ?> <?php if (in_array('createPurchases', $serialize_permission)) { ?> <?php echo "checked"; ?> <?php  } ?> <?php } ?>><label for="createPurchases"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="updatePurchases" value="updatePurchases" <?php if ($serialize_permission) { ?> <?php if (in_array('updatePurchases', $serialize_permission)) { ?> <?php echo "checked"; ?> <?php } ?> <?php } ?>><label for="updatePurchases"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="viewPurchases" value="viewPurchases" <?php if ($serialize_permission) { ?> <?php if (in_array('viewPurchases', $serialize_permission)) { ?> <?php echo "checked"; ?> <?php } ?> <?php } ?>><label for="viewPurchases"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="deletePurchases" value="deletePurchases" <?php if ($serialize_permission) { ?> <?php if (in_array('deletePurchases', $serialize_permission)) { ?> <?php echo "checked"; ?> <?php } ?> <?php } ?>><label for="deletePurchases"></label></div>
                        </td>
                      </tr>
                      <tr>
                        <td>Order</td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="createOrders" value="createOrders" <?php if ($serialize_permission) { ?> <?php if (in_array('createOrders', $serialize_permission)) { ?> <?php echo "checked"; ?> <?php  } ?> <?php } ?>><label for="createOrders"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="updateOrders" value="updateOrders" <?php if ($serialize_permission) { ?> <?php if (in_array('updateOrders', $serialize_permission)) { ?> <?php echo "checked"; ?> <?php } ?> <?php } ?>><label for="updateOrders"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="viewOrders" value="viewOrders" <?php if ($serialize_permission) { ?> <?php if (in_array('viewOrders', $serialize_permission)) { ?> <?php echo "checked"; ?> <?php } ?> <?php } ?>><label for="viewOrders"></label></div>
                        </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="deleteOrders" value="deleteOrders" <?php if ($serialize_permission) { ?> <?php if (in_array('deleteOrders', $serialize_permission)) { ?> <?php echo "checked"; ?> <?php } ?> <?php } ?>><label for="deleteOrders"></label></div>
                        </td>
                      </tr>
                      <tr>
                        <td>Laporan</td>
                        <td> - </td>
                        <td> - </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="viewReports" value="viewReports" <?php if ($serialize_permission) { ?> <?php if (in_array('viewReports', $serialize_permission)) { ?> <?php echo "checked"; ?> <?php } ?> <?php } ?>><label for="viewReports"></label></div>
                        </td>
                        <td> - </td>
                      </tr>
                      <tr>
                        <td>Perusahaan</td>
                        <td> - </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="updateCompany" value="updateCompany" <?php if ($serialize_permission) { ?> <?php if (in_array('updateCompany', $serialize_permission)) { ?> <?php echo "checked"; ?> <?php } ?> <?php } ?>><label for="updateCompany"></label></div>
                        </td>
                        <td> - </td>
                        <td> - </td>
                      </tr>
                      <tr>
                        <td>Profil</td>
                        <td> - </td>
                        <td> - </td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="viewProfil" value="viewProfile" <?php if ($serialize_permission) { ?> <?php if (in_array('viewProfile', $serialize_permission)) { ?> <?php echo "checked"; ?> <?php  } ?> <?php } ?>><label for="viewProfil"></label></div>
                        </td>
                        <td> - </td>
                      </tr>
                      <tr>
                        <td>Pengaturan</td>
                        <td>-</td>
                        <td>
                          <div class="icheck-primary"><input type="checkbox" name="permission[]" id="updSetting" value="updateSetting" <?php if ($serialize_permission) { ?> <?php if (in_array('updateSetting', $serialize_permission)) { ?> <?php echo "checked"; ?> <?php } ?> <?php  } ?>><label for="updSetting"></label></div>
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
                <button type="submit" class="btn btn-primary btn-lg">Update</button>
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
    $("#manageGroupNav .nav-link").addClass('active');

    $('input[type="checkbox"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
  });
</script>