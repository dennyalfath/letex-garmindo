<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>CV. Letex Garmindo</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/custom.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Datatables CSS -->
    <link href="<?php echo base_url() ?>assets/dist/datatables/dataTables.bootstrap4.css" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index3.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>

            <!-- SEARCH FORM -->
            <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- User Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a data-toggle="modal" href="#logoutModal" class="dropdown-item">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?php echo base_url() . $this->session->userdata('role') ?>" class="brand-link">
                <img src="<?php echo base_url() ?>assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">CV. Letex Garmindo</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?php echo base_url() ?>assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?php echo ucfirst($this->session->userdata('username')) ?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                            with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="<?php echo base_url() . $this->session->userdata('role') ?>" class="nav-link <?php if ($this->uri->segment(1) == $this->session->userdata('role') && $this->uri->segment(2) == '') {
                                                                                                                        echo 'active';
                                                                                                                    } ?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <?php if ($this->session->userdata('role') == 'admin' || $this->session->userdata('role') == 'manager' || $this->session->userdata('role') == 'superadmin') : ?>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link <?php if ($this->uri->segment(1) == 'company') {
                                                                echo 'active';
                                                            } ?>">
                                    <i class="nav-icon fas fa-building"></i>
                                    <p>
                                        Company
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('company') ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>List</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('company/add') ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Add Company</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link <?php if ($this->uri->segment(1) == 'client') {
                                                                echo 'active';
                                                            } ?>">
                                    <i class="nav-icon fas fa-user-tie"></i>
                                    <p>
                                        Client
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('client') ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>List</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('client/add') ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Add Client</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link <?php if ($this->uri->segment(1) == 'category') {
                                                                echo 'active';
                                                            } ?>">
                                    <i class="nav-icon fas fa-bookmark"></i>
                                    <p>
                                        Category
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('category') ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>List</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('category/add') ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Add Category</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link <?php if ($this->uri->segment(1) == 'product') {
                                                                echo 'active';
                                                            } ?>">
                                    <i class="nav-icon fas fa-box"></i>
                                    <p>
                                        Product
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('product') ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>List</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('product/add') ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Add Product</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="<?php echo base_url('salesorder') ?>" class="nav-link <?php if ($this->uri->segment(1) == 'salesorder') {
                                                                                                    echo 'active';
                                                                                                } ?>">
                                    <i class="nav-icon fas fa-box"></i>
                                    <p>
                                        Sales Order
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('salesorder') ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>List</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('salesorder/add') ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Add Sales Order</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>
                        <?php if ($this->session->userdata('role') == 'superadmin') : ?>
                            <li class="nav-item">
                                <a href="<?php echo base_url('superadmin/usermanage') ?>" class="nav-link <?php if ($this->uri->segment(1) == 'superadmin' && $this->uri->segment(2) == 'usermanage') {
                                                                                                                echo 'active';
                                                                                                            } ?>">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        User Management
                                    </p>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
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
                        <div class="col-sm-12">
                            <h1 class="m-0 text-dark"><?php echo $title ?></h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->