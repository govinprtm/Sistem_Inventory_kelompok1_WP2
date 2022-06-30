<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid px-3">
      <div class="row">
        <div class="col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item"><a href="<?php echo base_url('users/') ?>">Users</a></li>
            <li class="breadcrumb-item active">Edit User</li>
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
              <a href="<?php echo base_url('users/') ?>" class="btn"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
            <form role="form" action="<?php base_url('users/create') ?>" method="post">
              <div class="card-body">

                <!-- <?php //if (validation_errors()) : 
                      ?>
                  <div class="callout callout-danger">
                    <?php //echo validation_errors(); 
                    ?>
                  </div>
                <?php //endif; 
                ?> -->

                <div class="form-group">
                  <label for="groups">Ganti Grup</label>
                  <select class="form-control" id="groups" name="groups">
                    <option value="">Select Groups</option>
                    <?php foreach ($group_data as $k => $v) : ?>
                      <option value="<?php echo $v['id'] ?>" <?php if ($user_group['id'] == $v['id']) { ?> <?php echo 'selected'; ?> <?php } ?>><?php echo $v['group_name'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" class="form-control <?php if (form_error('email')) { ?> <?= "is-invalid"; ?> <?php }; ?>" id="email" name="email" placeholder="Email" value="<?= $user_data['email'] ?>" autocomplete="off">
                      <div class="invalid-feedback">
                        <?= form_error('email'); ?>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="username">Username</label>
                      <input type="text" class="form-control <?php if (form_error('username')) { ?> <?= "is-invalid"; ?> <?php }; ?>" id="username" name="username" placeholder="Username" value="<?= $user_data['username'] ?>" autocomplete="off">
                      <div class="invalid-feedback">
                        <?= form_error('username'); ?>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="fname">Nama Depan</label>
                      <input type="text" class="form-control <?php if (form_error('fname')) { ?> <?= "is-invalid"; ?> <?php }; ?>" id="fname" name="fname" placeholder="Nama Depan" value="<?= $user_data['firstname'] ?>" autocomplete="off">
                      <div class="invalid-feedback">
                        <?= form_error('fname'); ?>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="lname">Nama Belakang</label>
                      <input type="text" class="form-control" id="lname" name="lname" placeholder="Nama Belakang" value="<?= $user_data['lastname'] ?>" autocomplete="off">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="gender">Jenis Kelamin</label>
                      <div class="radio">
                        <label>
                          <input type="radio" name="gender" id="male" value="1" <?php if ($user_data['gender'] == 1) { ?> <?php echo "checked"; ?> <?php } ?>>
                          Laki-laki
                        </label>
                        <label>
                          <input type="radio" name="gender" id="female" value="2" <?php if ($user_data['gender'] == 2) { ?> <?php echo "checked"; ?> <?php } ?>>
                          Perempuan
                        </label>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="phone">No. Telepon/WA (Format 62)</label>
                      <input type="text" class="form-control" id="phone" name="phone" placeholder="Telepon" value="<?= $user_data['phone'] ?>" autocomplete="off">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="callout callout-light" role="alert">
                    Kosongkan bidang Password jika Anda tidak ingin mengubahnya.
                  </div>
                </div>

                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off">
                </div>

                <div class="form-group">
                  <label for="cpassword">Konfirmasi password</label>
                  <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password" autocomplete="off">
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
    $("#groups").select2({
      theme: 'bootstrap4'
    })

    $("#mainUserNav").addClass('menu-is-opening menu-open');
    $("#UserNav").addClass('active');
    $("#manageUserNav .nav-link").addClass('active');
  });
</script>