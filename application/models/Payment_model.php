<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        /*cache control*/
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    // VALIDATE STRIPE PAYMENT
    public function stripe_payment($token_id = "", $user_id = "", $amount_paid = "", $stripe_secret_key = "") {
        $user_details = $this->user_model->get_all_user($user_id)->row_array();

        require_once(APPPATH.'libraries/Stripe/init.php');
        \Stripe\Stripe::setApiKey($stripe_secret_key);

        $customer = \Stripe\Customer::create(array(
            'email' => $user_details['email'], // client email id
            'card'  => $token_id
        ));

        $charge = \Stripe\Charge::create(['customer'  => $customer->id, 'amount' => $amount_paid*100, 'currency' => get_settings('stripe_currency'), 'receipt_email' => $user_details['email']]);

        if($charge->status == 'succeeded'){
            return true;
        }else {
            $this->session->set_flashdata('error_message', get_phrase('an_error_occurred_during_payment'));
            redirect('home', 'refresh');
        }
    }

    // VALIDATE PAYPAL PAYMENT AFTER PAYING
    public function paypal_payment($paymentID = "", $paymentToken = "", $payerID = "", $paypalClientID = "", $paypalSecret = "") {
      $paypal_keys = get_settings('paypal');
      $paypal_data = json_decode($paypal_keys);

      $paypalEnv       = $paypal_data[0]->mode; // Or 'production'
      if ($paypal_data[0]->mode == 'sandbox') {
          $paypalURL       = 'https://api.sandbox.paypal.com/v1/';
      } else {
          $paypalURL       = 'https://api.paypal.com/v1/';
      }

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $paypalURL.'oauth2/token');
      curl_setopt($ch, CURLOPT_HEADER, false);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_USERPWD, $paypalClientID.":".$paypalSecret);
      curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
      $response = curl_exec($ch);
      curl_close($ch);

      if(empty($response)){
          return false;
      }else{
          $jsonData = json_decode($response);
          $curl = curl_init($paypalURL.'payments/payment/'.$paymentID);
          curl_setopt($curl, CURLOPT_POST, false);
          curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
          curl_setopt($curl, CURLOPT_HEADER, false);
          curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($curl, CURLOPT_HTTPHEADER, array(
              'Authorization: Bearer ' . $jsonData->access_token,
              'Accept: application/json',
              'Content-Type: application/xml'
          ));
          $response = curl_exec($curl);
          curl_close($curl);

          // Transaction data
          $result = json_decode($response);

          // CHECK IF THE PAYMENT STATE IS APPROVED OR NOT
          if($result && $result->state == 'approved'){
              return true;
          }else{
              return false;
          }
      }
    }

    // VALIDATE PAGAR.ME PAYMENT
    public function pagarme_payment($post = "", $public_key = "") {
        require_once(APPPATH.'../vendor/autoload.php');



        $pagarme = new PagarMe\Client($public_key, ['headers' => ['verify' => "c:/certs/cacert.pem"]]);

        $user_details = $this->user_model->get_all_user($post['user_id'])->row_array();

//        $transaction = $pagarme->transactions()->create([
//            'amount'                => 123,
//            'payment_method'        => 'credit_card',
//            'card_holder_name'      => $post['card_holder_name'],
//            'card_cvv'              => $post['card_cvv'],
//            'card_number'           => $post['card_number'],
//            'card_expiration_date'  => $this->soNumero($post['card_expiration_date']),
//            'customer' => [
//                'external_id' => $post['user_id'],
//                'name' => $user_details['first_name']. " " .$user_details['last_name'],
//                'type' => 'individual',
//                'country' => 'br',
//                'documents' => [
//                    [
//                        'type' => 'cpf',
//                        'number' => '55555555555'
//                    ]
//                ],
//                'phone_numbers' => [ '+551199999999' ],
//                'email' => 'cliente@email.com'
//            ],
//            "billing" => [
//                "name" => "Trinity Moss",
//                    "address" => [
//                        "country" => "br",
//                        "state" => "sp",
//                        "city" => "Cotia",
//                        "neighborhood" => "Rio Cotia",
//                        "street" => "Rua Matrix",
//                        "steet_number" => "9999",
//                        "zipcode" => "06714360"
//              ]
//            ],
//            'items' => [
//                [
//                    'id' => '1',
//                    'title' => 'R2D2',
//                    'unit_price' => 300,
//                    'quantity' => 1,
//                    'tangible' => false
//                ],
//                [
//                    'id' => '2',
//                    'title' => 'C-3PO',
//                    'unit_price' => 700,
//                    'quantity' => 1,
//                    'tangible' => false
//                ]
//            ]
//        ]);


        $transaction = $pagarme->transactions()->create([
            'amount' => 100,
            'card_id' => 'card_ci6l9fx8f0042rt16rtb477gj',
            'payment_method' => 'credit_card',
            'postback_url' => 'http://requestb.in/pkt7pgpk',
            'customer' => [
                'external_id' => '0001',
                'name' => 'Aardvark Silva',
                'email' => 'aardvark.silva@pagar.me',
                'type' => 'individual',
                'country' => 'br',
                'documents' => [
                    [
                        'type' => 'cpf',
                        'number' => '67415765095'
                    ]
                ],
                'phone_numbers' => [ '+551199999999' ]
            ],
            'billing' => [
                'name' => 'Nome do pagador',
                'address' => [
                    'country' => 'br',
                    'street' => 'Avenida Brigadeiro Faria Lima',
                    'street_number' => '1811',
                    'state' => 'sp',
                    'city' => 'Sao Paulo',
                    'neighborhood' => 'Jardim Paulistano',
                    'zipcode' => '01451001'
                ]
            ],
            'shipping' => [
                'name' => 'Nome de quem receberá o produto',
                'fee' => 1020,
                'delivery_date' => '2018-09-22',
                'expedited' => false,
                'address' => [
                    'country' => 'br',
                    'street' => 'Avenida Brigadeiro Faria Lima',
                    'street_number' => '1811',
                    'state' => 'sp',
                    'city' => 'Sao Paulo',
                    'neighborhood' => 'Jardim Paulistano',
                    'zipcode' => '01451001'
                ]
            ],
            'items' => [
                [
                    'id' => '1',
                    'title' => 'R2D2',
                    'unit_price' => 300,
                    'quantity' => 1,
                    'tangible' => true
                ],
                [
                    'id' => '2',
                    'title' => 'C-3PO',
                    'unit_price' => 700,
                    'quantity' => 1,
                    'tangible' => true
                ]
            ]
        ]);

        $tr = json_encode($transaction);

        echo $tr;


        die();
        require_once(APPPATH.'libraries/Stripe/init.php');
        \Stripe\Stripe::setApiKey($stripe_secret_key);

        $customer = \Stripe\Customer::create(array(
            'email' => $user_details['email'], // client email id
            'card'  => $token_id
        ));

        $charge = \Stripe\Charge::create(['customer'  => $customer->id, 'amount' => $amount_paid*100, 'currency' => get_settings('stripe_currency'), 'receipt_email' => $user_details['email']]);

        if($charge->status == 'succeeded'){
            return true;
        }else {
            $this->session->set_flashdata('error_message', get_phrase('an_error_occurred_during_payment'));
            redirect('home', 'refresh');
        }
    }

    public function soNumero($str) {
        return preg_replace("/[^0-9]/", "", $str);
    }
}
