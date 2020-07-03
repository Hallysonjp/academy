<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Stripe | <?php echo get_settings('system_name');?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="<?php echo base_url('assets/payment/css/pagarme.css');?>" rel="stylesheet">
        <link name="favicon" type="image/x-icon" href="<?php echo base_url();?>uploads/system/favicon.png" rel="shortcut icon" />
        <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet'>
        <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
    </head>
    <body>
<!--required for getting the stripe token-->
        <?php
            $pagarme_keys = get_settings('pagarme_keys');
            $values = json_decode($pagarme_keys);
            if ($values[0]->testmode == 'on') {
                $public_key  = $values[0]->api_key;
                $private_key = $values[0]->encrypted_key;
            } else {
                $public_key  = $values[0]->api_live_key;
                $private_key = $values[0]->encrypted_live_key;
            }
        ?>

        <div class="container-fluid px-1 px-md-2 px-lg-4 py-5 mx-auto">
            <div class="row d-flex justify-content-center">
                <div class="col-xl-7 col-lg-8 col-md-9 col-sm-11">
                    <div class="card border-0">
                        <div class="row justify-content-center">
                            <h3 class="mb-4">Cartão de crédito</h3>
                        </div>
                        <form method="post" action="<?php echo site_url('home/pagarme_payment/');?>">
                            <div class="row">
                            <div class="col-sm-7 border-line pb-3">
                                <input type="hidden" name="amount" value="<?= ($amount_to_pay * 100)?>">
                                <input type="hidden" name="user_id" value="<?= $user_details['id'] ?>">
                                <div class="form-group">
                                    <p class="text-muted text-sm mb-0">Nome do portador</p>
                                    <input type="text" name="card_holder_name" placeholder="Nome" size="18">
                                </div>
                                <div class="form-group">
                                    <p class="text-muted text-sm mb-0">Número do cartão</p>
                                    <div class="row px-3"> <input type="text" name="card_number" placeholder="0000 0000 0000 0000" size="18" id="cr_no" minlength="19" maxlength="19">
                                        <p class="mb-0 ml-3">/</p> <div id="brand-logo-card"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <p class="text-muted text-sm mb-0">Validade</p> <input type="text" name="card_expiration_date" placeholder="MM/YY" size="6" id="exp" minlength="5" maxlength="5">
                                </div>
                                <div class="form-group">
                                    <p class="text-muted text-sm mb-0">CVV/CVC</p> <input type="password" name="card_cvv" placeholder="000" size="1" minlength="3" maxlength="3">
                                </div>
                                <div class="form-group mb-0">
                                    <div class="custom-control custom-checkbox custom-control-inline"> <input id="chk1" type="checkbox" name="chk" class="custom-control-input" checked> <label for="chk1" class="custom-control-label text-muted text-sm">Salvar cartão para pagamentos futuros</label> </div>
                                </div>
                            </div>
                            <div class="col-sm-5 text-sm-center justify-content-center pt-4 pb-4"> <small class="text-sm text-muted">Número do pedido</small>
                                <h5 class="mb-5">12345678</h5> <small class="text-sm text-muted">Valor do pedido</small>
                                <div class="row px-3 justify-content-sm-center">
                                    <h2 class=""><span class="text-md font-weight-bold mr-2">R$</span><span class="text-danger">
                                            <?php
                                                $valorAPagar = $amount_to_pay;
                                                $formatado   = number_format(($valorAPagar), '2');
                                                $valor       = str_replace('.', ',', $formatado);
                                                echo $valor;
                                            ?>
                                        </span></h2>

                                </div> <button type="submit" class="btn btn-red text-center mt-4">Realizar Pagamento</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
        <script type='text/javascript' src='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>
        <script src="<?php echo base_url('assets/payment/js/pagarme.js');?>"></script>
    </body>
</html>
