<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demo.createx.studio/mstore/checkout-payment.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 06 Jul 2020 14:56:08 GMT -->
<head>
    <meta charset="utf-8">
    <title>Pedido Finalizado | Academy
    </title>
    <!-- SEO Meta Tags-->
    <meta name="description" content="MStore - Modern Bootstrap E-commerce Template">
    <meta name="keywords" content="bootstrap, shop, e-commerce, market, modern, responsive,  business, mobile, bootstrap 4, html5, css3, jquery, js, gallery, slider, touch, creative, clean">
    <meta name="author" content="Createx Studio">
    <!-- Viewport-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon and Touch Icons-->
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="manifest" href="site.webmanifest">
    <link rel="mask-icon" color="#111" href="safari-pinned-tab.svg">
    <meta name="msapplication-TileColor" content="#111">
    <meta name="theme-color" content="#ffffff">
    <!-- Vendor Styles including: Font Icons, Plugins, etc.-->
    <link rel="stylesheet" media="screen" href="<?= base_url() ?>assets/payment/css/vendor.min.css">
    <!-- Main Theme Styles + Bootstrap-->
    <link rel="stylesheet" media="screen" id="main-styles" href="<?= base_url() ?>assets/payment/css/theme.min.css">
    <!-- Customizer styles and scripts-->
    <link rel="stylesheet" media="screen" href="<?= base_url() ?>assets/payment/customizer/customizer.min.css">
    <!-- Google Tag Manager-->
    <script>
        (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            '../../www.googletagmanager.com/gtm5445.html?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-PVV9F7F');
    </script>
    <style>
        body {
            letter-spacing: 0.8px;
            background: linear-gradient(0deg, #fff, 50%, #f1f1f1);
            background-repeat: no-repeat
        }

        .container-fluid {
            margin-top: 40px !important;
            margin-bottom: 80px !important
        }

        p {
            font-size: 14px;
            margin-bottom: 7px
        }

        .cursor-pointer {
            cursor: pointer
        }

        .bold {
            font-weight: 600
        }

        .small {
            font-size: 12px !important;
            letter-spacing: 0.5px !important
        }

        .Today {
            color: rgb(83, 83, 83)
        }

        .btn-outline-primary {
            background-color: #fff !important;
            color: #4bb8a9 !important;
            border: 1.3px solid #4bb8a9;
            font-size: 12px;
            border-radius: 0.4em !important
        }

        .btn-outline-primary:hover {
            background-color: #4bb8a9 !important;
            color: #fff !important;
            border: 1.3px solid #4bb8a9
        }

        .btn-outline-primary:focus,
        .btn-outline-primary:active {
            outline: none !important;
            box-shadow: none !important;
            border-color: #42A5F5 !important
        }

        #progressbar {
            margin-bottom: 30px;
            overflow: hidden;
            color: #455A64;
            padding-left: 0px;
            margin-top: 30px
        }

        #progressbar li {
            list-style-type: none;
            font-size: 13px;
            width: 33.33%;
            float: left;
            position: relative;
            font-weight: 400;
            color: #455A64 !important
        }

        #progressbar #step1:before {
            content: "1";
            color: #fff;
            width: 29px;
            margin-left: 15px !important;
            padding-left: 11px !important
        }

        #progressbar #step2:before {
            content: "2";
            color: #fff;
            width: 29px
        }

        #progressbar #step3:before {
            content: "3";
            color: #fff;
            width: 29px;
            margin-right: 15px !important;
            padding-right: 11px !important
        }

        #progressbar li:before {
            line-height: 29px;
            display: block;
            font-size: 12px;
            background: #455A64;
            border-radius: 50%;
            margin: auto
        }

        #progressbar li:after {
            content: '';
            width: 121%;
            height: 2px;
            background: #455A64;
            position: absolute;
            left: 0%;
            right: 0%;
            top: 15px;
            z-index: -1
        }

        #progressbar li:nth-child(2):after {
            left: 50%
        }

        #progressbar li:nth-child(1):after {
            left: 25%;
            width: 121%
        }

        #progressbar li:nth-child(3):after {
            left: 25% !important;
            width: 50% !important
        }

        #progressbar li.active:before,
        #progressbar li.active:after {
            background: #4bb8a9
        }

        .card {
            background-color: #fff;
            box-shadow: 2px 4px 15px 0px rgb(97, 97, 97);
            z-index: 0
        }

        small {
            font-size: 12px !important
        }

        .a {
            justify-content: space-between !important
        }

        .border-line {
            border-right: 1px solid rgb(226, 206, 226)
        }

        .card-footer img {
            opacity: 0.3
        }

        .card-footer h5 {
            font-size: 1.1em;
            color: #8C9EFF;
            cursor: pointer
        }
    </style>
</head>
<!-- Body-->
<body>
<!-- Page Title-->
<div class="page-title-wrapper" aria-label="Page title">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="mt-n1 mr-1"><i data-feather="home"></i></li>
                <li class="breadcrumb-item"><a href="index.html">Início</a></li>
                <li class="breadcrumb-item"><a href="#">Carrinho</a></li>
                <li class="breadcrumb-item"><a href="#">Finalizar Pedido</a></li>
            </ol>
        </nav>
        <h1 class="page-title">Pedido concluído</h1><span class="d-block mt-2 text-muted"></span>
    </div>
</div>
<?php
    $payment_details = $this->crud_model->get_payment_details_by_user_course($user_id, $course_id);
    $valorAPagar = $amount_to_pay;
    $formatado   = number_format(($valorAPagar), '2');
    $valor       = str_replace('.', ',', $formatado);
?>

<div class="container-fluid my-6 d-sm-flex justify-content-center">
    <div class="card px-3 col-md-4">
        <div class="card-header bg-white">
            <div class="row justify-content-between">
                <div class="col">
                    <p class="text-muted"> N° do pedido: <span class="font-weight-bold text-dark">#<?= $payment_details['id']?></span></p>
                    <p class="text-muted"> Data da compra: <span class="font-weight-bold text-dark"><?= date('d/m/Y', $payment_details['date_added']) ?></span> </p>
                </div>
                <div class="flex-col my-auto">
<!--                    <h6 class="ml-auto mr-3"> <a href="#">View Details</a> </h6>-->
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="media flex-column flex-sm-row">
                <div class="col-md-12 text-center mb-5 mt-3">
                    <h4>Seu pedido foi concluído com sucesso!</h4>
                </div>
            </div>
            <div class="media flex-column flex-sm-row">
                <div class="media-body ">
                    <h5 class="bold"><?= $course_title ?></h5>
                    <p class="text-muted"> Qt: 1</p>
                    <h4 class="mt-3 mb-4 bold"> <span class="mt-5">R$</span> <?= $valor ?> <span class="small text-muted"></span></h4>
                    <p class="text-muted">Via: <?= $payment_details['payment_type'] ?></p>
<!--                    <button type="button" class="btn btn-outline-primary d-flex">Reached Hub, Delhi</button>-->
                </div>
                <div class="media-body mx-auto text-center">
                    <img class="align-self-center img-fluid" src="<?= $this->crud_model->get_course_thumbnail_url($course_id) ?>" width="180 " height="180">
                </div>
            </div>
        </div>
        <div class="card-footer bg-white px-sm-3 pt-sm-4 px-0">
            <div class="row text-center ">
                <a class="btn btn-secondary mt-3 mr-3" href="<?php echo base_url().'/home' ?>">Início</a><a class="btn btn-primary mt-3" href="<?= base_url().'/login' ?>"><i data-feather="map-pin"></i>&nbsp;Login</a>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript (jQuery) libraries, plugins and custom scripts-->
<script src="<?= base_url() ?>assets/payment/js/vendor.min.js"></script>
<script src="<?= base_url() ?>assets/payment/js/card.min.js"></script>
<script src="<?= base_url() ?>assets/payment/js/theme.min.js"></script>
<script src="<?= base_url() ?>assets/payment/js/jquery.mask.js"></script>
<script src="<?= base_url() ?>assets/payment/js/busca_cep.js"></script>
<script src="<?= base_url() ?>assets/payment/js/custom.js"></script>
<script src="<?= base_url() ?>assets/payment/customizer/customizer.min.js"></script>
</body>
</html>