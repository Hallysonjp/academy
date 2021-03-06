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
</head>
<!-- Body-->
<body>
<?php
    $usuario = $this->user_model->get_all_user($user_id)->row_array();
    $cpf     = $this->payment_model->soNumero($usuario['cpf']);
    $email   = $usuario['email'];
?>
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
<!-- Page Content-->
<div class="container pb-5 mb-sm-4">
    <div class="pt-5">
        <div class="card py-3 mt-sm-3">
            <div class="card-body text-center">
                <div id="dados" data-cpf="<?= $cpf ?>" data-email="<?= $email ?>"></div>
                <h3 class="h4 pb-3">Seu pedido foi concluído com sucesso!</h3>
                <p class="mb-2">Seu curso já está disponível.</p>
                <p class="mb-2"></p>
                <p>Caso este seja o seu primeiro acesso, você poderá efetuar o Login utilizando seu e-mail e CPF como senha.</p>
                <a class="btn btn-primary mt-3" href="#" onclick="openModal('<?= base_url()."login" ?>')"><i data-feather="map-pin"></i>&nbsp;Acessar o curso</a>
            </div>
        </div>
    </div>
</div>
<!-- Footer-->
<footer class="page-footer bg-dark" style="position: absolute;bottom: 0; width: 100%">

    <div class="py-3" style="background-color: #1a1a1a;">
        <div class="container font-size-xs text-center" aria-label="Copyright"><span class="text-white opacity-60 mr-1">© Todos os direitos reservados</div>
    </div>
</footer>

<!-- JavaScript (jQuery) libraries, plugins and custom scripts-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="<?= base_url() ?>assets/payment/js/vendor.min.js"></script>
<script src="<?= base_url() ?>assets/payment/js/card.min.js"></script>
<script src="<?= base_url() ?>assets/payment/js/theme.min.js"></script>
<script src="<?= base_url() ?>assets/payment/js/jquery.mask.js"></script>
<script src="<?= base_url() ?>assets/payment/js/busca_cep.js"></script>
<script src="<?= base_url() ?>assets/payment/js/custom.js?<?= time() ?>"></script>
<script src="<?= base_url() ?>assets/payment/customizer/customizer.min.js"></script>
</body>
</html>
