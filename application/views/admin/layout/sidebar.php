<?php
$id = $this->session->userdata('id');
$user = $this->user_model->user_detail($id);
$meta = $this->meta_model->get_meta();
$transaksi_unread = $this->transaksi_model->transaksi_unread();
// var_dump(count($transaksi_unread));
// die;
?>

<!-- Query Menu -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="<?php echo base_url('admin/dashboard'); ?>" class="brand-link">

    <span class="brand-text font-weight-light">
      <img src="<?php echo base_url('assets/img/logo/' . $meta->favicon); ?>" style="width:40px" alt="User Image">
      <?php echo $meta->title; ?> </span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

        <?php if ($user->role_id == 1) : ?>

          <li class="nav-item">
            <a href="<?php echo base_url(); ?>admin/dashboard" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url(); ?>admin/transaksi" class="nav-link">
              <i class="nav-icon fas fa-receipt"></i>
              <p>
                Transaksi
                <?php if (count($transaksi_unread) == 0) : ?>
                <?php else : ?>
                  <span class="right badge badge-danger">
                    <?php echo count($transaksi_unread); ?>
                  </span>
                <?php endif; ?>

              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Master
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>admin/mobil" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Mobil</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>admin/provinsi" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Provinsi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>admin/airport" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bandara</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>admin/bank" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bank</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>admin/product" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Product</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>admin/persentase" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Persentase</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>admin/nilaitopup" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Setting Nilai Topup</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>admin/ketentuan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ketentuan</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-wallet"></i>
              <p>
                Wallet
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>admin/topup" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Top Up</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>admin/withdraw" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Withdraw</p>
                </a>
              </li>



            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-friends"></i>
              <p>
                Data Pengguna
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>admin/user" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Admin</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo base_url(); ?>admin/customer" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Customer</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>admin/driver" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Driver</p>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-ninja"></i>
              <p>
                Akun
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('admin/profile'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Profile</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/profile/update'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/profile/password'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ubah Password</p>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Settings
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('admin/meta'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Profile Situs</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/meta/logo'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Logo Situs</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/meta/favicon'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Favicon</p>
                </a>
              </li>


            </ul>
          </li>

          <li class="nav-item">
            <a href="<?php echo base_url(); ?>admin/pengaturan" class="nav-link">
              <i class="far fa-envelope nav-icon"></i>
              <p>Pengaturan Email</p>
            </a>
          </li>

        <?php elseif ($user->role_id == 2) : ?>

          <li class="nav-item">
            <a href="<?php echo base_url(); ?>admin/dashboard" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url(); ?>admin/transaksi" class="nav-link">
              <i class="nav-icon fas fa-receipt"></i>
              <p>
                Transaksi
                <?php if (count($transaksi_unread) == 0) : ?>
                <?php else : ?>
                  <span class="right badge badge-danger">
                    <?php echo count($transaksi_unread); ?>
                  </span>
                <?php endif; ?>

              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-ninja"></i>
              <p>
                Akun
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('admin/profile'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Profile</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/profile/update'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/profile/password'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ubah Password</p>
                </a>
              </li>

            </ul>
          </li>
        <?php else : ?>

        <?php endif; ?>

    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"><?php echo $title; ?></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard') ?>"> Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="<?php echo base_url('admin/' . $this->uri->segment(2)) ?>">
                <?php echo ucfirst(str_replace('_', ' ', $this->uri->segment(2))) ?>
              </a></li>
            <li class="breadcrumb-item active"><?php echo $title ?></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->




  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">