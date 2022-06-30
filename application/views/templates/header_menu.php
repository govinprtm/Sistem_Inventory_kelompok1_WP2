<nav class="main-header navbar navbar-expand navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link mt-1" data-widget="pushmenu" href="#" role="button"><i class="fa fa-bars fa-lg" aria-hidden="true"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="" class="nav-link h4 text-dark"><?= $page_title; ?></a>
    </li>
    <!--<li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>-->
  </ul>
  <ul class="navbar-nav ml-auto">
    <li class="nav-item mr-3">
      <a class="btn btn-default">
        <div id="clock">memuat...</div>
      </a>
    </li>

    <li class="nav-item mr-1">
      <a class="btn btn-primary" href="<?= base_url('sales/create'); ?>">
        <i class="fa fa-shopping-cart"></i> Jual
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
        <i class="fa fa-th-large"></i>
      </a>
    </li>
  </ul>
  <!-- Left side column. contains the logo and sidebar -->
</nav>