<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid px-3">
      <div class="row">
        <div class="col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active">Grup</li>
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
            <div class="card-header">
              <?php if (in_array('createGroup', $user_permission)) : ?>
                <a href="<?php echo base_url('groups/create') ?>" class="btn btn-primary">Tambah Grup</a>
              <?php endif; ?>
            </div>
            <!-- /.box-header -->
            <div class="card-body">
              <table id="groupTable" class="table" style="width: 100%;">
                <thead>
                  <tr>
                    <th>Nama Grup</th>
                    <?php if (in_array('updateGroup', $user_permission) || in_array('deleteGroup', $user_permission)) : ?>
                      <th>Aksi</th>
                    <?php endif; ?>
                  </tr>
                </thead>
                <tbody>
                  <?php if ($groups_data) : ?>
                    <?php foreach ($groups_data as $k => $v) : ?>
                      <tr>
                        <td><?php echo $v['group_name']; ?></td>

                        <?php if (in_array('updateGroup', $user_permission) || in_array('deleteGroup', $user_permission)) : ?>
                          <td>
                            <?php if (in_array('updateGroup', $user_permission)) : ?>
                              <a href="<?php echo base_url('groups/edit/' . $v['id']) ?>" class="btn btn-default btn-sm"><i class="fa fa-edit"></i></a>
                            <?php endif; ?>
                            <?php if (in_array('deleteGroup', $user_permission)) : ?>
                              <a href="" onclick="removeFunc('<?= $v['id']; ?>')" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></a>
                            <?php endif; ?>
                          </td>
                        <?php endif; ?>
                      </tr>
                    <?php endforeach ?>
                  <?php endif; ?>
                </tbody>
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

<?php if (in_array('deleteGroup', $user_permission)) : ?>
  <!-- remove brand modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">

          <h4 class="modal-title">Hapus Grup</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>

        <form role="form" action="<?php echo base_url('groups/delete') ?>" method="post" id="removeForm">
          <div class="modal-body">
            <p>Apakah Anda benar-benar ingin menghapus?</p>
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

<script type="text/javascript">
  $(document).ready(function() {
    $('#groupTable').DataTable();
    $("#mainGroupNav").addClass('menu-is-opening menu-open');
    $("#GroupNav").addClass('active');
    $("#manageGroupNav .nav-link").addClass('active');
  });

  // remove functions 
  function removeFunc(id) {
    if (id) {
      $("#removeForm").on('submit', function() {

        var form = $(this);

        // remove the text-danger
        $(".text-danger").remove();

        $.ajax({
          url: form.attr('action'),
          type: form.attr('method'),
          data: {
            id: id
          },
          dataType: 'json',
          success: function(response) {
            if (response.success === true) {
              Swal.fire({
                icon: 'success',
                title: `${response.messages}`,
                showConfirmButton: true,
                timer: 2000,
                timerProgressBar: true,
              })
              // hide the modal
              $("#removeModal").modal('hide');
              setTimeout(() => location.reload(), 3000);
            } else {
              Swal.fire({
                icon: 'warning',
                title: `${response.messages}`,
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
              })
            }
          }
        });

        return false;
      });
    }
  }
</script>