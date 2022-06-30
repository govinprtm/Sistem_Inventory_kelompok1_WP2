<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid px-3">
      <div class="row">
        <div class="col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active">Master Merek</li>
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
            <div class="card-header">
              <?php if (in_array('createBrand', $user_permission)) : ?>
                <button class="btn btn-primary" data-toggle="modal" data-target="#addBrandModal">Tambah Merek</button>
              <?php endif; ?>
            </div>
            <!-- /.box-header -->
            <div class="card-body">
              <table id="manageTable" class="table" style="width: 100%;">
                <thead>
                  <tr>
                    <th>Nama Merek</th>
                    <th>Status</th>
                    <?php if (in_array('updateBrand', $user_permission) || in_array('deleteBrand', $user_permission)) : ?>
                      <th>Aksi</th>
                    <?php endif; ?>
                  </tr>
                </thead>

              </table>
            </div>
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

<?php if (in_array('createBrand', $user_permission)) : ?>
  <!-- create brand modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="addBrandModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Merek</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form role="form" action="<?php echo base_url('brands/create') ?>" method="post" id="createBrandForm">

          <div class="modal-body">

            <div class="form-group">
              <label for="brand_name">Nama Merek</label>
              <input type="text" class="form-control" id="brand_name" name="brand_name" placeholder="Masukkan nama merek" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="active">Status</label>
              <select class="form-control" id="active" name="active">
                <option value="1">Aktif</option>
                <option value="2">Tidak Aktif</option>
              </select>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>

        </form>


      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
<?php endif; ?>

<?php if (in_array('updateBrand', $user_permission)) : ?>
  <!-- edit brand modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="editBrandModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Merek</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form role="form" action="<?php echo base_url('brands/update') ?>" method="post" id="updateBrandForm">

          <div class="modal-body">
            <div id="messages"></div>

            <div class="form-group">
              <label for="edit_brand_name">Nama Merek</label>
              <input type="text" class="form-control" id="edit_brand_name" name="edit_brand_name" placeholder="Masukkan nama merek" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="edit_active">Status</label>
              <select class="form-control" id="edit_active" name="edit_active">
                <option value="1">Aktif</option>
                <option value="2">Tidak Aktif</option>
              </select>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>

        </form>


      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
<?php endif; ?>

<?php if (in_array('deleteBrand', $user_permission)) : ?>
  <!-- remove brand modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="removeBrandModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Hapus Merek</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form role="form" action="<?php echo base_url('brands/remove') ?>" method="post" id="removeBrandForm">
          <div class="modal-body">
            <p>Apakah Anda benar-benar ingin menghapus?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Oke</button>
          </div>
        </form>


      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
<?php endif; ?>



<script type="text/javascript">
  var manageTable;

  $(document).ready(function() {

    $("#mainMasterNav").addClass('menu-is-opening menu-open');
    $("#MasterNav").addClass('active');
    $("#brandNav .nav-link").addClass('active');
    // initialize the datatable 
    manageTable = $('#manageTable').DataTable({
      'ajax': 'fetchBrandData',
      'order': []
    });

    // submit the create from 
    $("#createBrandForm").unbind('submit').on('submit', function() {
      var form = $(this);

      // remove the text-danger
      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: form.serialize(), // /converting the form data into array and sending it to server
        dataType: 'json',
        success: function(response) {

          manageTable.ajax.reload(null, false);

          if (response.success === true) {
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">' +
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
              '<strong> <i class="fas fa-check-circle"></i> </strong>' + response.messages +
              '</div>');

            // hide the modal
            $("#addBrandModal").modal('hide');

            // reset the form
            $("#createBrandForm")[0].reset();
            $("#createBrandForm .form-control").removeClass('is-invalid').removeClass('is-valid');

          } else {

            if (response.messages instanceof Object) {

              $.each(response.messages, function(index, value) {
                var id = $("#" + index);

                id.closest('.form-control')
                  .removeClass('is-invalid')
                  .removeClass('is-valid')
                  .addClass(value.length > 0 ? 'is-invalid' : 'is-valid');

                id.after(value);

              });
            } else {
              $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                '<strong> <i class="fas fa-exclamation-circle"></i> </strong>' + response.messages +
                '</div>');
            }
          }
        }
      });

      return false;
    });


  });

  function editBrand(id) {
    $.ajax({
      url: 'fetchBrandDataById/' + id,
      type: 'post',
      dataType: 'json',
      success: function(response) {

        $("#edit_brand_name").val(response.name);
        $("#edit_active").val(response.active);

        // submit the edit from 
        $("#updateBrandForm").unbind('submit').bind('submit', function() {
          var form = $(this);

          // remove the text-danger
          $(".text-danger").remove();

          $.ajax({
            url: form.attr('action') + '/' + id,
            type: form.attr('method'),
            data: form.serialize(), // /converting the form data into array and sending it to server
            dataType: 'json',
            success: function(response) {

              manageTable.ajax.reload(null, false);

              if (response.success === true) {
                $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">' +
                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                  '<strong> <i class="fas fa-check-circle"></i> </strong>' + response.messages +
                  '</div>');


                // hide the modal
                $("#editBrandModal").modal('hide');
                // reset the form 
                $("#updateBrandForm .form-control").removeClass('is-invalid').removeClass('is-valid');

              } else {

                if (response.messages instanceof Object) {
                  $.each(response.messages, function(index, value) {
                    var id = $("#" + index);

                    id.closest('.form-control')
                      .removeClass('is-invalid')
                      .removeClass('is-valid')
                      .addClass(value.length > 0 ? 'is-invalid' : 'is-valid');

                    id.after(value);

                  });
                } else {
                  $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                    '<strong> <i class="fas fa-exclamation-circle"></i> </strong>' + response.messages +
                    '</div>');
                }
              }
            }
          });

          return false;
        });

      }
    });
  }

  function removeBrand(id) {
    if (id) {
      $("#removeBrandForm").on('submit', function() {

        var form = $(this);

        // remove the text-danger
        $(".text-danger").remove();

        $.ajax({
          url: form.attr('action'),
          type: form.attr('method'),
          data: {
            brand_id: id
          },
          dataType: 'json',
          success: function(response) {

            manageTable.ajax.reload(null, false);

            if (response.success === true) {
              $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">' +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                '<strong> <i class="fas fa-check-circle"></i> </strong>' + response.messages +
                '</div>');

              // hide the modal
              $("#removeBrandModal").modal('hide');

            } else {

              $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                '<strong> <i class="fas fa-exclamation-circle"></i> </strong>' + response.messages +
                '</div>');
            }
          }
        });

        return false;
      });
    }
  }
</script>