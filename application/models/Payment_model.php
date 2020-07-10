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
    public function pagarme_payment($post = "", $public_key = "", $payment_method = "credit_card") {
        require_once(APPPATH.'../vendor/autoload.php');

        $pagarme      = new PagarMe\Client($public_key);
        $user_details = $this->user_model->get_all_user($post['user_id'])->row_array();
        $user_address = $this->user_model->has_address($post)->row_array();

        $telefones = [];

        if(!empty($user_details['celular'])){
            array_push($telefones, '+55'.$this->soNumero($user_details['celular']));
        }

        if(!empty($user_details['telefone'])){
            array_push($telefones, '+55'.$this->soNumero($user_details['telefone']));
        }

        $itens = []; $counter = 0;

        foreach ($this->session->userdata('cart_items') as $key =>$cart_item){
            $counter++;
            $course_details = $this->crud_model->get_course_by_id($cart_item)->row_array();
            $instructor_details = $this->user_model->get_all_user($course_details['user_id'])->row_array();

            $itens[] = [
                'id'         => $course_details['id'],
                'title'      => $course_details['title'],
                'unit_price' => ((int) $course_details['price'] * 100),
                'quantity' => 1,
                'tangible' => false
            ];
        }

        $data = [
            'amount' => (int) $post['amount'],
            'payment_method' => $payment_method,
            'customer' => [
                'external_id' => $user_details['id'],
                'name' => $user_details['first_name'] . " " . $user_details['last_name'],
                'email' => $user_details['email'],
                'type' => 'individual',
                'country' => 'br',
                'documents' => [
                    [
                        'type' => 'cpf',
                        'number' => $this->soNumero($user_details['cpf'])
                    ]
                ],
                'phone_numbers' => $telefones
            ],
            'billing' => [
                'name' => $user_details['first_name'] . " " . $user_details['last_name'],
                'address' => [
                    'country' => 'br',
                    'street' => $user_address['endereco'],
                    'street_number' => $user_address['numero'],
                    'state' => strtolower($user_address['estado']),
                    'city' => $user_address['cidade'],
                    'neighborhood' => $user_address['bairro'],
                    'zipcode' => $this->soNumero($user_address['cep'])
                ]
            ],
            'items' => $itens
        ];

        if($payment_method == 'boleto'){
            $data['postback_url'] = "https://portal.ladiesboss.com.br/academy/home/pagarme_postback";
            $data['capture']      = true;
            $data['async']        = false;
        }else{
            $card = $pagarme->cards()->create([
                'holder_name'       => $post['name'],
                'number'            => $post['number'],
                'expiration_date'   => $this->soNumero($post['expiry']),
                'cvv'               => $post['cvc']
            ]);
            $data['installments'] = $post['parcelas'];
            $data['card_id']      = $card->id;
        }

        $transaction = $pagarme->transactions()->create($data);
        var_dump($transaction);exit;
        if($transaction->status == 'paid'){
            return true;
        } elseif ($payment_method == 'boleto'){
            $this->session->set_userdata('transaction', $transaction);
            redirect('home/pagarme_boleto');
        } else {
            $this->session->set_flashdata('error_message', 'Ocorreu um erro durante o pagamento. Verifique os dados e tente novamente');
            redirect('home', 'refresh');
        }
    }

    public function checkar_taxa_juros($publicKey, $data = null){
        require_once(APPPATH.'../vendor/autoload.php');

        $pagarme = new PagarMe\Client($publicKey);

        $calculateInstallments = $pagarme->transactions()->calculateInstallments([
            'amount' => 99700,
            'free_installments' => 1,
            'max_installments' => 12,
            'interest_rate' => 5
        ]);

        return $calculateInstallments;
    }

    public function soNumero($str) {
        return preg_replace("/[^0-9]/", "", $str);
    }
}
