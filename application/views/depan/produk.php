<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- WebDevelop by Erwin, S.Kom -->

    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title><?= $title ?></title>
    <meta content="WinArtCode" name="Erwin, S.Kom" />
    <!-- App favicon -->

    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url() ?>public/depan/assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url() ?>public/img/icon.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>public/img/icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>public/img/icon.png">
    <link rel="manifest" href="<?= base_url() ?>public/depan/assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="<?= base_url() ?>public/depan/assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">

    <style>
        /* Product card styles */
        .product-card {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            /* Ensure no overflow */
        }

        .product-card:hover {
            transform: scale(1.05);
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
        }

        .card-img-wrapper {
            width: 100%;
            height: 200px;
            /* Set height for image consistency */
            overflow: hidden;
        }

        .card-img-top {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Ensure image covers area without distortion */
        }

        .card-body {
            padding: 1.25rem;
        }

        .card-title {
            font-size: 1rem;
            font-weight: bold;
            color: #333;
        }

        .card-text {
            color: #666;
        }

        /* Carousel controls */
        .carousel-control-prev,
        .carousel-control-next {
            width: auto;
            background: none;
            border: none;
            font-size: 2rem;
            color: #007bff;
            top: auto;
            bottom: 0;
            transform: translateY(-50%);
        }

        .carousel-control-prev {
            left: 0;
        }

        .carousel-control-next {
            right: 0;
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .col-lg-3 {
                flex: 0 0 50%;
                max-width: 50%;
            }
        }

        @media (max-width: 576px) {
            .col-lg-3 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }
    </style>

    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="<?= base_url() ?>public/depan/assets/css/theme.css" rel="stylesheet" />


</head>


<body>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
        <nav class="navbar navbar-expand-lg navbar-light sticky-top" data-navbar-on-scroll="data-navbar-on-scroll">
            <div class="container"><a class="navbar-brand" href="<?= base_url('home') ?>"><img src="<?= base_url() ?>public/img/logo.png" height="45" alt="logo" /></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"> </span></button>
                <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item" style="margin-right: 25px;"><a class="nav-link" aria-current="page" href="<?= base_url('home') ?>">Home</a></li>
                        <li class="nav-item" style="margin-right: 25px;"><a class="nav-link" aria-current="page" href="#produks">Produk</a></li>
                        <!-- <li class="nav-item" style="margin-right: 5px;"><a class="nav-link" aria-current="page" href="#tentang-toko">Tentang Toko</a></li> -->
                        <!-- <li class="nav-item"><a class="nav-link" aria-current="page" href="#superhero">Pricing</a></li>
                        <li class="nav-item"><a class="nav-link" aria-current="page" href="#marketing">Resources</a></li> -->
                    </ul>
                    <div class="d-flex ms-lg-4">
                        <!-- <a class="btn btn-secondary-outline" href="#!">Sign In</a> -->
                        <a class="btn btn-primary ms-3 btn-xs" href="<?= base_url('login') ?>">Login</a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- ============================================-->
        <!-- <section> begin ============================-->
        <section class="pt-5 pt-md-9" id="produks">
            <div class="bg-holder z-index--1 bottom-0 d-none d-lg-block" style="background-image:url(<?= base_url() ?>public/depan/assets/img/category/shape.png); opacity:.5;"></div>
            <!--/.bg-holder-->
            <div class="container">
                <h1 class="fs-9 fw-bold mb-4 text-center">Semua Produk Kami</h1>
                <div class="row">
                    <div class="col-12">
                        <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="row justify-content-center">

                                        <?php foreach ($product as $p) { ?>

                                            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                                <div class="card product-card">
                                                    <div class="card-img-wrapper">
                                                        <img class="card-img-top" src="<?php echo base_url('public/upload/' . $p->gambar); ?>" alt="Feature" />
                                                    </div>
                                                    <div class="card-body">
                                                        <h4 class="card-title mb-3"><?= $p->nama_produk ?></h4>
                                                        <p class="card-text mb-0 fw-medium text-secondary">
                                                        <ul>
                                                            <li>Kategori : <?= $p->nama_kategori ?></li>
                                                            <li>Harga : <?= indo_currency($p->price) ?></li>
                                                            <li>Stok Tersedia :
                                                                <?php if ($p->stock < 1) { ?>
                                                                    <span class="badge bg-warning">No Stok</span>
                                                                <?php } else { ?>
                                                                    <span class="badge bg-danger"><?= $p->stock ?></span>
                                                                <?php } ?>
                                                            </li>
                                                        </ul>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php } ?>
                                    </div>
                                </div>
                                <!-- Additional carousel items can be added here -->
                            </div>
                            <!-- <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button> -->
                        </div>
                    </div>
                </div>
                <!-- <div class="text-center mt-4">
                    <a class="btn btn-primary" href="<?= base_url('home/produks') ?>" role="button">Lihat Semua Produk</a>
                </div> -->
            </div><!-- end of .container-->
        </section>








        <!-- <section> close ============================-->
        <!-- ============================================-->


        <!-- ============================================-->
        <!-- <section> begin ============================-->
        <!-- <section class="pt-5" id="marketing">

            <div class="container">
                <h1 class="fw-bold fs-6 mb-3">Marketing Strategies</h1>
                <p class="mb-6 text-secondary">Join 40,000+ other marketers and get proven strategies on email marketing</p>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card"><img class="card-img-top" src="<?= base_url() ?>public/depan/assets/img/marketing/marketing01.png" alt="" />
                            <div class="card-body ps-0">
                                <p class="text-secondary">By <a class="fw-bold text-decoration-none me-1" href="#">Abdullah</a>|<span class="ms-1">03 March 2019</span></p>
                                <h3 class="fw-bold">Increasing Prosperity With Positive Thinking</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card"><img class="card-img-top" src="<?= base_url() ?>public/depan/assets/img/marketing/marketing02.png" alt="" />
                            <div class="card-body ps-0">
                                <p class="text-secondary">By <a class="fw-bold text-decoration-none me-1" href="#">Abdullah</a>|<span class="ms-1">03 March 2019</span></p>
                                <h3 class="fw-bold">Motivation Is The First Step To Success</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card"><img class="card-img-top" src="<?= base_url() ?>public/depan/assets/img/marketing/marketing03.png" alt="" />
                            <div class="card-body ps-0">
                                <p class="text-secondary">By <a class="fw-bold text-decoration-none me-1" href="#">Abdullah</a>|<span class="ms-1">03 March 2019</span></p>
                                <h3 class="fw-bold">Success Steps For Your Personal Or Business Life</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        <!-- end of .container-->

        </section>
        <!-- <section> close ============================-->
        <!-- ============================================-->







        <!-- ============================================-->
        <!-- <section> begin ============================-->
        <section class="text-center py-0">

            <div class="container">
                <div class="container border-top py-3">
                    <div class="row justify-content-between">
                        <div class="col-12 col-md-auto mb-1 mb-md-0">
                            <p class="mb-0">&copy; 2024 <a href="#" target="_blank">Titik Balik Teknologi</a> </p>
                        </div>
                        <div class="col-12 col-md-auto">
                            <p class="mb-0">
                                Made with<span class="fas fa-heart mx-1 text-danger"> </span>by <a class="text-decoration-none ms-1" href="https://winartcode.my.id/" target="_blank">Anything you want</a></p>
                        </div>
                    </div>
                </div>
            </div><!-- end of .container-->

        </section>
        <!-- <section> close ============================-->
        <!-- ============================================-->


    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->


    <div class="modal fade" id="popupVideo" tabindex="-1" aria-labelledby="popupVideo" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <iframe class="rounded" style="width:100%;height:500px;" src="https://www.youtube.com/embed/_lhdhL4UDIo" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    </div>


    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="<?= base_url() ?>public/depan/vendors/@popperjs/popper.min.js"></script>
    <script src="<?= base_url() ?>public/depan/vendors/bootstrap/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>public/depan/vendors/is/is.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="<?= base_url() ?>public/depan/vendors/fontawesome/all.min.js"></script>
    <script src="<?= base_url() ?>public/depan/assets/js/theme.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&amp;family=Volkhov:wght@700&amp;display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.product-card').click(function() {
                // Toggle the 'card-hover' class on the clicked card
                $(this).toggleClass('card-hover');

                // Remove 'card-hover' class from other cards
                $('.product-card').not(this).removeClass('card-hover');
            });
        });

        $('#productCarousel').carousel({
            interval: 3000 // Adjust interval as needed (in milliseconds)
        });
    </script>

</body>

</html>