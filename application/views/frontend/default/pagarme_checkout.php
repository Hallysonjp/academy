<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demo.createx.studio/mstore/checkout-payment.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 06 Jul 2020 14:56:08 GMT -->
<head>
    <meta charset="utf-8">
    <title>Finalizar Pedido | Academy
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
$userData     = $this->session->userdata();
if(isset($userData['user_id'])){
    $user         = $this->user_model->get_user($userData['user_id'])->row_array();
    $user_address = $this->user_model->has_address($userData)->row_array();
}
$pagarme_keys = get_settings('pagarme_keys');
$values       = json_decode($pagarme_keys);
if ($values[0]->testmode == 'on') {
    $public_key  = $values[0]->api_key;
    $private_key = $values[0]->encrypted_key;
} else {
    $public_key  = $values[0]->api_live_key;
    $private_key = $values[0]->encrypted_live_key;
}
$parcelas = $this->payment_model->checkar_taxa_juros($public_key);
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
        <h1 class="page-title">Finalizar Pedido</h1><span class="d-block mt-2 text-muted"></span>
    </div>
</div>
<!-- Page Content-->
<div class="container pb-5 mb-sm-4 mt-n2 mt-md-n3">
    <form method="post" action="<?php echo site_url('home/pagarme_payment/');?>" name="myform" novalidate>
        <input type="hidden" name="user_id" value="<?= $user_details['id'] ?? null ?>">
        <div class="row pt-4 mt-2">
        <div class="col-xl-9 col-md-8">
                <h6 class="h6 px-4 py-3 bg-secondary mb-4">Dados do comprador</h6>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="checkout-fn">Nome *</label>
                            <input class="form-control" required name="first_name" value="<?= $user['first_name'] ?? null ?>" type="text" id="checkout-fn">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="checkout-ln">Sobrenome *</label>
                            <input class="form-control" name="last_name" required type="text" value="<?= $user['last_name'] ?? null ?>" id="checkout-ln">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="checkout-email">CPF *</label>
                            <input class="form-control cpf" required name="cpf" type="text" value="<?= $user['cpf'] ?? null ?>" id="checkout-email">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="checkout-email">E-mail *</label>
                            <input class="form-control" type="email" required name="email" value="<?= $user['email'] ?? null ?>" id="checkout-email">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="checkout-phone">Telefone</label>
                            <input class="form-control phone_with_ddd" name="telefone" type="text" value="<?= $user['telefone'] ?? null ?>" id="checkout-phone">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="checkout-phone">Celular *</label>
                            <input class="form-control cel_with_ddd" name="celular" required type="text" value="<?= $user['celular'] ?? null ?>" id="checkout-phone">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="checkout-zip">CEP *</label>
                            <input class="form-control cep" name="cep" required type="text" value="<?= $user_address['cep'] ?? null ?>" id="cep">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="checkout-country">País</label>
                            <select class="form-control custom-select" readonly name="pais" id="checkout-country">
                                <option>Escolher país</option>
                                <option value="BR" selected>Brasil</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="checkout-city">Estado</label>
                            <select class="form-control custom-select" id="estado" name="estado">
                                <option value="">Escolher estado</option>
                                <option value="AC">Acre</option>
                                <option value="AL">Alagoas</option>
                                <option value="AP">Amapá</option>
                                <option value="AM">Amazonas</option>
                                <option value="BA">Bahia</option>
                                <option value="CE">Ceará</option>
                                <option value="DF">Distrito Federal</option>
                                <option value="ES">Espírito Santo</option>
                                <option value="GO">Goiás</option>
                                <option value="MA">Maranhão</option>
                                <option value="MT">Mato Grosso</option>
                                <option value="MS">Mato Grosso do Sul</option>
                                <option value="MG">Minas Gerais</option>
                                <option value="PA">Pará</option>
                                <option value="PB">Paraíba</option>
                                <option value="PR">Paraná</option>
                                <option value="PE">Pernambuco</option>
                                <option value="PI">Piauí</option>
                                <option value="RJ">Rio de Janeiro</option>
                                <option value="RN">Rio Grande do Norte</option>
                                <option value="RS">Rio Grande do Sul</option>
                                <option value="RO">Rondônia</option>
                                <option value="RR">Roraima</option>
                                <option value="SC">Santa Catarina</option>
                                <option value="SP">São Paulo</option>
                                <option value="SE">Sergipe</option>
                                <option value="TO">Tocantins</option>
                                <option value="EX">Estrangeiro</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="checkout-zip">Cidade</label>
                            <input class="form-control cidade" readonly name="cidade" value="<?= $user_address['cidade'] ?? null ?>" type="text" id="cidade">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="checkout-zip">Bairro</label>
                            <input class="form-control bairro" name="bairro" readonly value="<?= $user_address['bairro'] ?? null ?>" type="text" id="bairro">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="checkout-address-1">Endereço</label>
                            <input class="form-control" type="text" name="endereco" readonly value="<?= $user_address['endereco'] ?? null ?>" id="endereco">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="checkout-address-1">Número</label>
                            <input class="form-control" type="text" value="<?= $user_address['numero'] ?? null ?>" name="numero" id="numero">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="checkout-address-2">Complemento</label>
                            <input class="form-control" type="text" name="complemento" value="<?= $user_address['complemento'] ?? null ?>" id="complemento">
                        </div>
                    </div>
                </div>
        </div>
        <?php
        $valorAPagar = $amount_to_pay;
        $formatado   = number_format(($valorAPagar), '2');
        $valor       = str_replace('.', ',', $formatado);
        ?>
        <div class="col-xl-3 col-md-4 pt-4 mt-3 pt-md-0 mt-md-0">
            <h2 class="h6 px-4 py-3 bg-secondary text-center">Detalhes do pedido</h2>
            <div class="font-size-sm border-bottom pt-2 pb-3">
                <?php if(!empty($course_id)):?>
                    <div class="d-flex justify-content-between mb-2"><span>Curso:</span><span><strong><?= $course_title ?></strong></span></div>
                <?php endif;?>
                <div class="d-flex justify-content-between mb-2"><span>Subtotal:</span><span>R$ <?= $valor ?></span></div>
                <div class="d-flex justify-content-between mb-2"><span>Entrega:</span><span>R$ 0,00</span></div>
                <div class="d-flex justify-content-between mb-2"><span>Taxas:</span><span>R$ 0,00</span></div>
                <div class="d-flex justify-content-between"><span>Desconto:</span><span>&mdash;</span></div>
            </div>
            <div class="h3 font-weight-semibold text-center py-3">R$ <?= $valor ?></div>

            <h2 class="h6 px-4 py-3 bg-secondary text-center">Parcelamento</h2>
            <div class="font-size-sm border-bottom pt-2 pb-3">
                <?php foreach($parcelas->installments as $parcela): ?>
                    <div class="d-flex justify-content-between mb-2">
                        <span><?= $parcela->installment ?>x - R$ <?= valueFormat($parcela->installment_amount) ?></span>
                        <span id="total-<?= $parcela->installment ?>" data-valor="<?= $parcela->amount ?>">R$ <?= valueFormat($parcela->amount) ?></span>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
        <!-- Content-->
        <div class="col-xl-9 col-md-8">
            <h2 class="h6 px-4 py-3 bg-secondary mb-4">Escolher método de pagamento</h2>
            <div class="accordion mb-4" id="payment-method" role="tablist">
                <div class="card">
                    <div class="card-header" role="tab">
                        <h3 class="accordion-heading"><a href="#card" data-toggle="collapse"><i class="mr-2 mt-n1" data-feather="credit-card" style="width: 1.25rem; height: 1.25rem;"></i>Pague com cartão de crédito<span class="accordion-indicator"><i data-feather="chevron-up"></i></span></a></h3>
                    </div>
                    <div class="collapse show" id="card" data-parent="#payment-method" role="tabpanel">
                        <div class="card-body">
<!--                            <p>We accept following credit cards:&nbsp;&nbsp;<img class="d-inline-block align-middle" src="img/cards.png" style="width: 187px;" alt="Cerdit Cards"></p>-->
                            <div class="card-wrapper"></div>
                            <div class="interactive-credit-card row">
                                <div class="form-group col-sm-6">
                                    <input class="form-control" type="text" name="number" placeholder="Número do cartão" required>
                                </div>
                                <div class="form-group col-sm-6">
                                    <input class="form-control" type="text" name="name" placeholder="Nome do Portador" required>
                                </div>
                                <div class="form-group col-sm-2">
                                    <input class="form-control" type="text" name="expiry" placeholder="MM/AA" required>
                                </div>
                                <div class="form-group col-sm-2">
                                    <input class="form-control" type="text" name="cvc" placeholder="CVV" required>
                                </div>
                                <div class="form-group col-sm-2">
                                    <select name="parcelas" id="parcelas" class="form-control">
                                        <option value="1" selected>1x</option>
                                        <option value="2">2x</option>
                                        <option value="3">3x</option>
                                        <option value="4">4x</option>
                                        <option value="5">5x</option>
                                        <option value="6">6x</option>
                                        <option value="7">7x</option>
                                        <option value="8">8x</option>
                                        <option value="9">9x</option>
                                        <option value="10">10x</option>
                                        <option value="11">11x</option>
                                        <option value="12">12x</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-3">
                                    <input type="text" readonly class="form-control" id="valor" name="valor" value="R$ <?= $valor ?>">
                                    <input type="hidden" name="amount" id="amount" value="<?= $amount_to_pay * 100 ?>">
                                </div>

                                <div class="col-sm-3">
                                    <button class="btn btn-outline-primary btn-block mt-0" type="submit">Finalizar Pagamento</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" role="tab">
                        <h3 class="accordion-heading"><a class="collapsed" href="#paypal" data-toggle="collapse"><i class="mr-2"></i>Pague com Boleto Bancário<span class="accordion-indicator"><i data-feather="chevron-up"></i></span></a></h3>
                    </div>
                    <div class="collapse" id="paypal" data-parent="#payment-method" role="tabpanel">
                        <div class="card-body">
                            <p><strong>Boleto bancário!</strong> Selecione para pagar com boleto</p>
                            <form class="row" method="post">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input class="deal-checkbox" type="checkbox" name="boleto"> <label class="" for="boleto"> Boleto Bancário</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                        <button class="btn btn-primary btn-sm" type="submit">Gerar Boleto</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>
<!-- Footer-->
<footer class="page-footer bg-dark">

    <div class="py-3" style="background-color: #1a1a1a;">
        <div class="container font-size-xs text-center" aria-label="Copyright"><span class="text-white opacity-60 mr-1">© All rights reserved. Made by</span><a class="nav-link-inline nav-link-light" href="https://createx.studio/" target="_blank">Createx Studio</a></div>
    </div>
</footer>
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