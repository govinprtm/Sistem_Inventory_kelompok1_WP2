<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login | Inventory</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.png'); ?>" type="image/x-icon"><!-- X -->
  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/adminlte/plugins/fontawesome-free/css/all.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/adminlte/dist/css/adminlte.min.css') ?>">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style>
    html {
      background-color: #F4F4F4;
      font-size: 100%;
      overflow: hidden;
    }

    body {
      background-color: #F4F4F4;
    }
  </style>
</head>

<body class="hold-transition">
  <div class="row justify-content-center" style="margin-top: 100px;">
    <div class="col-md-8">
      <div class="card py-2">
        <div class="card-body login-card-body">
          <div class="row">
            <div class="col-md-5 px-3">
              <div class="login-logo">
                <a href="<?php echo base_url('auth/login'); ?>"><strong>Sistem Inventory</strong></a>
                <img src="<?= base_url('assets/images/inventory-management-system.jpg'); ?>" class="img-fluid" alt="">
              </div>
              <p class="text-center">&copy; Kelompok 1</p>
            </div>
            <div class="col-md-7 px-3">
              <h4>Sign In</h4>
              <p>Masuk untuk memulai sesi anda</p>

              <?php if (!empty($errors)) {
                echo "<div class='alert alert-danger'>" . $errors . "</div>";
              } ?>

              <form action="<?php echo base_url('auth/login') ?>" method="post">
                <div class="input-group mb-3">
                  <input type="email" class="form-control form-control-lg <?php if (form_error('email')) { ?> <?php echo "is-invalid"; ?> <?php }; ?>" name="email" id="email" placeholder="Email" autocomplete="on" value="<?= set_value('email') ?>">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-envelope"></span>
                    </div>
                  </div>
                  <div class="invalid-feedback">
                  <?= form_error('email'); ?>
                  </div>
                </div>
                <div class="input-group mb-3">
                  <input type="password" class="form-control form-control-lg <?php if (form_error('password')) { ?> <?php echo "is-invalid"; ?> <?php }; ?>" name="password" id="password" placeholder="Password" autocomplete="off">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-lock"></span>
                    </div>
                  </div>
                  <div class="invalid-feedback">
                  <?= form_error('password'); ?>
                  </div>
                </div>
                <div class="row">
                  <!-- /.col -->
                  <div class="col-12">
                    <button type="submit" class="btn btn-default btn-lg bg-blue">Log In</button>
                  </div>
                  <!-- /.col -->
                </div>
              </form>
            </div>

          </div>
        </div>

      </div>
      <!-- /.login-box-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery 3 -->
  <script src="<?php echo base_url('assets/adminlte/plugins/jquery/jquery.min.js') ?>"></script>
  <!-- Bootstrap -->
  <script src="<?php echo base_url('assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/adminlte/dist/js/adminlte.min.js') ?>"></script>
  <script>
    window.setTimeout(function() {
      $(".alert").fadeTo(500, 0).slideUp(500, function() {
        $(this).remove();
      });
    }, 4000);
  </script>
</body>

</html>