<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>

    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>public/img/icon.png">


    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/adminlte.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/toastr/toastr.min.css">
    <style>
        html {
            font-size: .9rem !important;
        }

        .modal-dialog-centered {
            display: flex;
            align-items: center;
            min-height: calc(100% - 1.75rem);
            /* Adjust based on header/footer height */
        }

        .overlay1 {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.7);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            display: none;
            /* Initially hidden */
        }
    </style>
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="<?= base_url('apps') ?>" class="navbar-brand">
                    <img src="<?= base_url() ?>assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light font-weight-bold">Optik Fadhel</span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="#" class="nav-link" style="margin-left: 30px;">Selamat Datang</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="#" class="nav-link">Contact</a>
                        </li> -->

                    </ul>


                </div>

                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">


                    <!-- <li class="nav-item">
                       <p><i class="fas fa-user-circle"></i></p>
                    </li> -->
                </ul>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"><small>Apps : Fadhel Optik</small></h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Back to Home Page</a></li>
                                <!-- <li class="breadcrumb-item"><a href="#">Layout</a></li>
                                <li class="breadcrumb-item active">Top Navigation</li> -->
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-2">
                        </div>

                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title m-0">Kasip Apps</h5>
                                </div>
                                <div class="card-body">
                                    <center>

                                        <dotlottie-player src="https://lottie.host/6d62f3f9-59e4-4d55-9033-0f17d8ff2360/ntS2ZPO9mx.json" background="transparent" speed="1" style="width: 300px; height: 300px" direction="1" playMode="normal" loop autoplay>
                                        </dotlottie-player>
                                    </center>
                                    <br>
                                    <a data-toggle="modal" data-target="#loginModal" class="btn btn-danger btn-block"><i class="fas fa-computer"></i> Go to Kasir App</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.col-md-6 -->
                        <div class="col-lg-4">

                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title m-0">Dashboard Page</h5>
                                </div>
                                <div class="card-body">
                                    <center>
                                        <dotlottie-player src="https://lottie.host/13c94b18-db0e-42a4-934a-40195f5666b5/hHHQG2vhcv.json" background="transparent" speed="1" style="width: 300px; height: 300px" direction="1" playMode="normal" loop autoplay></dotlottie-player>
                                    </center>
                                    <br>
                                    <a data-toggle="modal" data-target="#loginModal"" class=" btn btn-primary btn-block"><i class="fas fa-termo"></i> Go to Dashboard</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">

                        </div>

                        <!-- /.col-md-6 -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->

                <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="loginModalLabel">Login to Apps</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="loginForm">
                                    <div class="form-group">
                                        <label for="email">Username/email</label>
                                        <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan email" autocomplete="off" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="**********" autocomplete="off" required>
                                    </div>
                                    <button type="submit" class="btn btn-success btn-block" id="btnLogin">
                                        <i class="fas fa-1x fa-sync fa-spin" id="spinner" style="display: none;"></i>
                                        <span id="btnText">Login</span>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-block" data-dismiss="modal">Close</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            Copyright &copy; 2024 <a href="https://winartcode.my.id">- Titik Balik Teknologi</a>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>assets/dist/js/adminlte.min.js"></script>
    <script src="<?= base_url() ?>public/js/login.js"></script>


    <script src="<?= base_url() ?>public/js/sweetalert2@11.js"></script>
    <script src="<?= base_url() ?>public/js/myscript.js"></script>

    <!-- lottie -->
    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
</body>

</html>