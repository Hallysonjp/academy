<!DOCTYPE html>
<html lang="en">
    <head>
<!--        <script src="https://assets.pagar.me/checkout/1.1.0/checkout.js"></script>-->
        <title>pagar.me | <?php echo get_settings('system_name');?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="<?php echo base_url('assets/payment/css/stripe.css');?>"
            rel="stylesheet">
        <link name="favicon" type="image/x-icon" href="<?php echo base_url();?>uploads/system/favicon.png" rel="shortcut icon" />
        <!-- SCRIPT PAGAR.ME -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://assets.pagar.me/pagarme-js/4.5/pagarme.min.js"></script>
    </head>
    <body>
<!--required for getting the stripe token-->
        <?php
            $pagarme_keys = get_settings('pagarme_keys');
            $values = json_decode($pagarme_keys);
            if ($values[0]->testmode == 'on') {
                $public_key = $values[0]->api_key;
                $private_key = $values[0]->ecrypted_key;
            } else {
                $public_key = $values[0]->public_live_key;
                $private_key = $values[0]->secret_live_key;
            }
        ?>

        <div id="form">
            Número do cartão: <input type="text" id="card_number"/>
            <br/>
            Nome (como escrito no cartão): <input type="text" id="card_holder_name"/>
            <br/>
            Mês de expiração: <input type="text" id="card_expiration_month"/>
            <br/>
            Ano de expiração: <input type="text" id="card_expiration_year"/>
            <br/>
            Código de segurança: <input type="text" id="card_cvv"/>
            <br/>
            <div id="field_errors">
            </div>
            <br/>
        </div>
        <form id="payment_form" action="https://seusite.com.br/transactions/new" method="POST">
            <input type="submit" />
        </form>

        <script>
            $(document).ready(function() {
                var form = $("#payment_form")
                console.log('aqui');
                form.submit(function(event) {
                    event.preventDefault();
                    var card = {}
                    card.card_holder_name = $("#form #card_holder_name").val()
                    card.card_expiration_date = $("#form #card_expiration_month").val() + '/' + $("#form #card_expiration_year").val()
                    card.card_number = $("#form #card_number").val()
                    card.card_cvv = $("#form #card_cvv").val()

                    // pega os erros de validação nos campos do form e a bandeira do cartão
                    var cardValidations = pagarme.validate({card: card})

                    //Então você pode verificar se algum campo não é válido
                    if(!cardValidations.card.card_number)
                        console.log('Oops, número de cartão incorreto')

                    //Mas caso esteja tudo certo, você pode seguir o fluxo
                    pagarme.client.connect({ encryption_key: 'SUA_ENCRYPTION_KEY' })
                        .then(client => client.security.encrypt(card))
                        .then(card_hash => console.log(card_hash))
                    // o próximo passo aqui é enviar o card_hash para seu servidor, e
                    // em seguida criar a transação/assinatura

                    return false
                })
            });
        </script>

    </body>
</html>
