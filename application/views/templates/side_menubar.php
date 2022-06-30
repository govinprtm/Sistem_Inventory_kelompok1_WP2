<aside class="main-sidebar bg-blue elevation-2">
  <a href="./" class="brand-link">
    <span class="brand-image">
      <h3>&nbsp;</h3>
    </span> <span class="brand-text">Sistem Inventory</span>
  </a>
  <!-- sidebar: style can be found in sidebar.less -->
  <div class="sidebar">
    <nav class="mt-2">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item" id="dashboardMainMenu">
          <a href="<?= base_url('dashboard') ?>" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <?php if (in_array('createProduct', $user_permission) || in_array('updateProduct', $user_permission) || in_array('viewProduct', $user_permission) || in_array('deleteProduct', $user_permission)) : ?>
          <li class="nav-item" id="mainProductNav">
            <a href="#" class="nav-link" id="ProductNav">
              <i class="fas fa-box-open nav-icon"></i>
              <p>Produk
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php if (in_array('createProduct', $user_permission)) : ?>
                <li id="addProductNav" class="nav-item"><a class="nav-link" href="<?= base_url('products/create') ?>"><i class="far fa-circle nav-icon"></i>
                    <p>Tambah Produk</p>
                  </a></li>
              <?php endif; ?>
              <?php if (in_array('updateProduct', $user_permission) || in_array('viewProduct', $user_permission) || in_array('deleteProduct', $user_permission)) : ?>
                <li id="manageProductNav" class="nav-item"><a class="nav-link" href="<?= base_url('products') ?>"><i class="far fa-circle nav-icon"></i>
                    <p>Daftar Produk</p>
                  </a></li>
              <?php endif; ?>
            </ul>
          </li>
        <?php endif; ?>


        <?php if (in_array('createSales', $user_permission) || in_array('updateSales', $user_permission) || in_array('viewSales', $user_permission) || in_array('deleteSales', $user_permission)) : ?>
          <li class="nav-item has-treeview" id="mainSalesNav">
            <a href="#" class="nav-link" id="SalesNav">
              <i class="fas fa-shopping-basket nav-icon"></i>
              <p>Penjualan
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php if (in_array('createSales', $user_permission)) : ?>
                <li id="addSalesNav" class="nav-item">
                  <a class="nav-link" href="<?= base_url('sales/create') ?>"><i class="far fa-circle nav-icon"></i>
                    <p>Tambah Penjualan</p>
                  </a>
                </li>
              <?php endif; ?>
              <?php if (in_array('updateSales', $user_permission) || in_array('viewSales', $user_permission) || in_array('deleteSales', $user_permission)) : ?>
                <li id="manageSalesNav" class="nav-item">
                  <a class="nav-link" href="<?= base_url('sales') ?>"><i class="far fa-circle nav-icon"></i>
                    <p>Daftar Penjualan</p>
                  </a>
                </li>
              <?php endif; ?>
            </ul>
          </li>
        <?php endif; ?>

        <?php if (in_array('createPurchases', $user_permission) || in_array('updatePurchases', $user_permission) || in_array('viewPurchases', $user_permission) || in_array('deletePurchases', $user_permission) || in_array('createOrders', $user_permission) || in_array('updateOrders', $user_permission) || in_array('viewOrders', $user_permission) || in_array('deleteOrders', $user_permission)) : ?>
          <li class="nav-item has-treeview" id="mainPurchasesNav">
            <a href="#" class="nav-link" id="PurchasesNav">
              <i class="fas fa-shopping-bag nav-icon"></i>
              <p>Pembelian
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php if (in_array('createOrders', $user_permission)) : ?>
                <li id="addOrdersNav" class="nav-item">
                  <a class="nav-link" href="<?= base_url('orders/create') ?>"><i class="far fa-circle nav-icon"></i>
                    <p>Order Barang</p>
                  </a>
                </li>
              <?php endif; ?>
              <?php if (in_array('updateOrders', $user_permission) || in_array('viewOrders', $user_permission) || in_array('deleteOrders', $user_permission)) : ?>
                <li id="manageOrdersNav" class="nav-item">
                  <a class="nav-link" href="<?= base_url('orders') ?>"><i class="far fa-circle nav-icon"></i>
                    <p>Daftar Order</p>
                  </a>
                </li>
              <?php endif; ?>
              <?php if (in_array('createPurchases', $user_permission)) : ?>
                <li id="addPurchasesNav" class="nav-item">
                  <a class="nav-link" href="<?= base_url('purchases/create') ?>"><i class="far fa-circle nav-icon"></i>
                    <p>Tambah Pembelian</p>
                  </a>
                </li>
              <?php endif; ?>
              <?php if (in_array('updatePurchases', $user_permission) || in_array('viewPurchases', $user_permission) || in_array('deletePurchases', $user_permission)) : ?>
                <li id="managePurchasesNav" class="nav-item">
                  <a class="nav-link" href="<?= base_url('purchases') ?>"><i class="far fa-circle nav-icon"></i>
                    <p>Daftar Pembelian</p>
                  </a>
                </li>
              <?php endif; ?>
            </ul>
          </li>
        <?php endif; ?>

        <?php if ($user_permission) : ?>
          <?php if (in_array('createUser', $user_permission) || in_array('updateUser', $user_permission) || in_array('viewUser', $user_permission) || in_array('deleteUser', $user_permission)) : ?>
            <li class="nav-item has-treeview" id="mainUserNav">
              <a href="#" class="nav-link" id="UserNav">
                <i class="fa fa-users nav-icon"></i>
                <p>Users
                  <i class="fa fa-angle-left right"></i>
                </p>

              </a>
              <ul class="nav nav-treeview">
                <?php if (in_array('createUser', $user_permission)) : ?>
                  <li class="nav-item" id="createUserNav">
                    <a class="nav-link" href="<?= base_url('users/create') ?>"><i class="far fa-circle nav-icon"></i>
                      <p>Tambah User</p>
                    </a>
                  </li>
                <?php endif; ?>

                <?php if (in_array('updateUser', $user_permission) || in_array('viewUser', $user_permission) || in_array('deleteUser', $user_permission)) : ?>
                  <li class="nav-item" id="manageUserNav">
                    <a class="nav-link" href="<?= base_url('users') ?>"><i class="far fa-circle nav-icon"></i>
                      <p>Daftar Users</p>
                    </a>
                  </li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>

          <?php if (in_array('createGroup', $user_permission) || in_array('updateGroup', $user_permission) || in_array('viewGroup', $user_permission) || in_array('deleteGroup', $user_permission)) : ?>
            <li class="nav-item has-treeview" id="mainGroupNav">
              <a href="#" class="nav-link" id="GroupNav">
                <i class="fas fa-copy nav-icon"></i>
                <p>Grup
                  <i class="fa fa-angle-left right"></i>
                </p>

              </a>
              <ul class="nav nav-treeview">
                <?php if (in_array('createGroup', $user_permission)) : ?>
                  <li class="nav-item" id="addGroupNav">
                    <a class="nav-link" href="<?= base_url('groups/create') ?>"><i class="far fa-circle nav-icon"></i>
                      <p>Tambah Grup</p>
                    </a>
                  </li>
                <?php endif; ?>
                <?php if (in_array('updateGroup', $user_permission) || in_array('viewGroup', $user_permission) || in_array('deleteGroup', $user_permission)) : ?>
                  <li class="nav-item" id="manageGroupNav">
                    <a class="nav-link" href="<?= base_url('groups') ?>"><i class="far fa-circle nav-icon"></i>
                      <p>Daftar Grup</p>
                    </a>
                  </li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>

          <?php if (in_array('updateCompany', $user_permission)) : ?>
            <li class="nav-item" id="mainMasterNav">
              <a href="#" class="nav-link" id="MasterNav">
                <i class="fas fa-cog nav-icon"></i>
                <p>Master
                  <i class="fa fa-angle-left right"></i>
                </p>

              </a>
              <ul class="nav nav-treeview">
                <?php if (in_array('createBrand', $user_permission) || in_array('updateBrand', $user_permission) || in_array('viewBrand', $user_permission) || in_array('deleteBrand', $user_permission)) : ?>
                  <li class="nav-item" id="brandNav">
                    <a href="<?= base_url('brands/') ?>" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Merek</p>
                    </a>
                  </li>
                <?php endif; ?>

                <?php if (in_array('createCategory', $user_permission) || in_array('updateCategory', $user_permission) || in_array('viewCategory', $user_permission) || in_array('deleteCategory', $user_permission)) : ?>
                  <li class="nav-item" id="categoryNav">
                    <a href="<?= base_url('category/') ?>" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Kategori</p>
                    </a>
                  </li>
                <?php endif; ?>

                <?php if (in_array('createStore', $user_permission) || in_array('updateStore', $user_permission) || in_array('viewStore', $user_permission) || in_array('deleteStore', $user_permission)) : ?>
                  <li class="nav-item" id="storeNav">
                    <a href="<?= base_url('stores/') ?>" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Supplier</p>
                    </a>
                  </li>
                <?php endif; ?>

                <?php if (in_array('createAttribute', $user_permission) || in_array('updateAttribute', $user_permission) || in_array('viewAttribute', $user_permission) || in_array('deleteAttribute', $user_permission)) : ?>
                  <li class="nav-item" id="attributeNav">
                    <a href="<?= base_url('attributes/') ?>" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Atribut</p>
                    </a>
                  </li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>

          <?php if (in_array('updateCompany', $user_permission)) : ?>
            <li class="nav-item" id="companyNav">
              <a class="nav-link" href="<?= base_url('company/') ?>"><i class="fa fa-wrench nav-icon"></i>
                <p>Perusahaan</p>
              </a>
            </li>
          <?php endif; ?>

          <?php if (in_array('viewProfile', $user_permission)) : ?>
            <li class="nav-item" id="viewProfile">
              <a class="nav-link" href="<?= base_url('users/profile/') ?>"><i class="fas fa-user nav-icon"></i>
                <p>Profil</p>
              </a>
            </li>
          <?php endif; ?>

          <?php if (in_array('viewReports', $user_permission)) : ?>
            <li id="reportNav" class="nav-item">
              <a href="<?= base_url('reports/') ?>" class="nav-link">
                <i class="fas fa-chart-bar nav-icon"></i>
                <p>Laporan</p>
              </a>
            </li>
          <?php endif; ?>

        <?php endif; ?>
        <!-- user permission info -->
        <li class="nav-item"><a class="nav-link" href="<?= base_url('auth/logout') ?>"><i class="fas fa-sign-out-alt nav-icon"></i>
            <p>Logout</p>
          </a></li>

      </ul>
    </nav>
  </div>
  <!-- /.sidebar -->
</aside>