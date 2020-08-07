<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_model extends CI_Model {

    public $bancos = [
        ['code' => '001', 'name' => 'Banco do Brasil'],
        ['code' => '003', 'name' => 'Banco da Amazônia'],
        ['code' => '004', 'name' => 'Banco do Nordeste'],
        ['code' => '021', 'name' => 'Banestes'],
        ['code' => '025', 'name' => 'Banco Alfa'],
        ['code' => '027', 'name' => 'Besc'],
        ['code' => '029', 'name' => 'Banerj'],
        ['code' => '031', 'name' => 'Banco Beg'],
        ['code' => '033', 'name' => 'Banco Santander Banespa'],
        ['code' => '036', 'name' => 'Banco Bem'],
        ['code' => '037', 'name' => 'Banpará'],
        ['code' => '038', 'name' => 'Banestado'],
        ['code' => '039', 'name' => 'BEP'],
        ['code' => '040', 'name' => 'Banco Cargill'],
        ['code' => '041', 'name' => 'Banrisul'],
        ['code' => '044', 'name' => 'BVA'],
        ['code' => '045', 'name' => 'Banco Opportunity'],
        ['code' => '047', 'name' => 'Banese'],
        ['code' => '062', 'name' => 'Hipercard'],
        ['code' => '063', 'name' => 'Ibibank'],
        ['code' => '065', 'name' => 'Lemon Bank'],
        ['code' => '066', 'name' => 'Banco Morgan Stanley Dean Witter'],
        ['code' => '069', 'name' => 'BPN Brasil'],
        ['code' => '070', 'name' => 'Banco de Brasília – BRB'],
        ['code' => '072', 'name' => 'Banco Rural'],
        ['code' => '073', 'name' => 'Banco Popular'],
        ['code' => '074', 'name' => 'Banco J. Safra'],
        ['code' => '075', 'name' => 'Banco CR2'],
        ['code' => '076', 'name' => 'Banco KDB'],
        ['code' => '096', 'name' => 'Banco BMF'],
        ['code' => '104', 'name' => 'Caixa Econômica Federal'],
        ['code' => '107', 'name' => 'Banco BBM'],
        ['code' => '116', 'name' => 'Banco Único'],
        ['code' => '151', 'name' => 'Nossa Caixa'],
        ['code' => '175', 'name' => 'Banco Finasa'],
        ['code' => '184', 'name' => 'Banco Itaú BBA'],
        ['code' => '204', 'name' => 'American Express Bank'],
        ['code' => '208', 'name' => 'Banco Pactual'],
        ['code' => '212', 'name' => 'Banco Matone'],
        ['code' => '213', 'name' => 'Banco Arbi'],
        ['code' => '214', 'name' => 'Banco Dibens'],
        ['code' => '217', 'name' => 'Banco Joh Deere'],
        ['code' => '218', 'name' => 'Banco Bonsucesso'],
        ['code' => '222', 'name' => 'Banco Calyon Brasil'],
        ['code' => '224', 'name' => 'Banco Fibra'],
        ['code' => '225', 'name' => 'Banco Brascan'],
        ['code' => '229', 'name' => 'Banco Cruzeiro'],
        ['code' => '230', 'name' => 'Unicard'],
        ['code' => '233', 'name' => 'Banco GE Capital'],
        ['code' => '237', 'name' => 'Bradesco'],
        ['code' => '241', 'name' => 'Banco Clássico'],
        ['code' => '243', 'name' => 'Banco Stock Máxima'],
        ['code' => '246', 'name' => 'Banco ABC Brasil'],
        ['code' => '248', 'name' => 'Banco Boavista Interatlântico'],
        ['code' => '249', 'name' => 'Investcred Unibanco'],
        ['code' => '250', 'name' => 'Banco Schahin'],
        ['code' => '252', 'name' => 'Fininvest'],
        ['code' => '254', 'name' => 'Paraná Banco'],
        ['code' => '263', 'name' => 'Banco Cacique'],
        ['code' => '265', 'name' => 'Banco Fator'],
        ['code' => '266', 'name' => 'Banco Cédula'],
        ['code' => '300', 'name' => 'Banco de la Nación Argentina'],
        ['code' => '318', 'name' => 'Banco BMG'],
        ['code' => '320', 'name' => 'Banco Industrial e Comercial'],
        ['code' => '356', 'name' => 'ABN Amro Real'],
        ['code' => '341', 'name' => 'Itau'],
        ['code' => '347', 'name' => 'Sudameris'],
        ['code' => '351', 'name' => 'Banco Santander'],
        ['code' => '353', 'name' => 'Banco Santander Brasil'],
        ['code' => '366', 'name' => 'Banco Societe Generale Brasil'],
        ['code' => '370', 'name' => 'Banco WestLB'],
        ['code' => '376', 'name' => 'JP Morgan'],
        ['code' => '389', 'name' => 'Banco Mercantil do Brasil'],
        ['code' => '394', 'name' => 'Banco Mercantil de Crédito'],
        ['code' => '399', 'name' => 'HSBC'],
        ['code' => '409', 'name' => 'Unibanco'],
        ['code' => '412', 'name' => 'Banco Capital'],
        ['code' => '422', 'name' => 'Banco Safra'],
        ['code' => '453', 'name' => 'Banco Rural'],
        ['code' => '456', 'name' => 'Banco Tokyo Mitsubishi UFJ'],
        ['code' => '464', 'name' => 'Banco Sumitomo Mitsui Brasileiro'],
        ['code' => '477', 'name' => 'Citibank'],
        ['code' => '479', 'name' => 'Itaubank (antigo Bank Boston)'],
        ['code' => '487', 'name' => 'Deutsche Bank'],
        ['code' => '488', 'name' => 'Banco Morgan Guaranty'],
        ['code' => '492', 'name' => 'Banco NMB Postbank'],
        ['code' => '494', 'name' => 'Banco la República Oriental del Uruguay'],
        ['code' => '495', 'name' => 'Banco La Provincia de Buenos Aires'],
        ['code' => '505', 'name' => 'Banco Credit Suisse'],
        ['code' => '600', 'name' => 'Banco Luso Brasileiro'],
        ['code' => '604', 'name' => 'Banco Industrial'],
        ['code' => '610', 'name' => 'Banco VR'],
        ['code' => '611', 'name' => 'Banco Paulista'],
        ['code' => '612', 'name' => 'Banco Guanabara'],
        ['code' => '613', 'name' => 'Banco Pecunia'],
        ['code' => '623', 'name' => 'Banco Panamericano'],
        ['code' => '626', 'name' => 'Banco Ficsa'],
        ['code' => '630', 'name' => 'Banco Intercap'],
        ['code' => '633', 'name' => 'Banco Rendimento'],
        ['code' => '634', 'name' => 'Banco Triângulo'],
        ['code' => '637', 'name' => 'Banco Sofisa'],
        ['code' => '638', 'name' => 'Banco Prosper'],
        ['code' => '643', 'name' => 'Banco Pine'],
        ['code' => '652', 'name' => 'Itaú Holding Financeira'],
        ['code' => '653', 'name' => 'Banco Indusval'],
        ['code' => '654', 'name' => 'Banco A.J. Renner'],
        ['code' => '655', 'name' => 'Banco Votorantim'],
        ['code' => '707', 'name' => 'Banco Daycoval'],
        ['code' => '719', 'name' => 'Banif'],
        ['code' => '721', 'name' => 'Banco Credibel'],
        ['code' => '734', 'name' => 'Banco Gerdau'],
        ['code' => '735', 'name' => 'Banco Pottencial'],
        ['code' => '738', 'name' => 'Banco Morada'],
        ['code' => '739', 'name' => 'Banco Galvão de Negócios'],
        ['code' => '740', 'name' => 'Banco Barclays'],
        ['code' => '741', 'name' => 'BRP'],
        ['code' => '743', 'name' => 'Banco Semear'],
        ['code' => '745', 'name' => 'Banco Citibank'],
        ['code' => '746', 'name' => 'Banco Modal'],
        ['code' => '747', 'name' => 'Banco Rabobank International'],
        ['code' => '748', 'name' => 'Banco Cooperativo Sicredi'],
        ['code' => '749', 'name' => 'Banco Simples'],
        ['code' => '751', 'name' => 'Dresdner Bank'],
        ['code' => '752', 'name' => 'BNP Paribas'],
        ['code' => '753', 'name' => 'Banco Comercial Uruguai'],
        ['code' => '755', 'name' => 'Banco Merrill Lynch'],
        ['code' => '756', 'name' => 'Banco Cooperativo do Brasil'],
        ['code' => '757', 'name' => 'KEB']
    ];

    public $tiposContas = [
        ['type' => 'conta_corrente', 'label' => 'Conta Corente'],
        ['type' => 'conta_poupanca', 'label' => 'Conta Poupança'],
        ['type' => 'conta_corrente_conjunta', 'label' => 'Conta Corente Conjunta'],
        ['type' => 'conta_poupanca_conjunta', 'label' => 'Conta Poupança Conjunta']
    ];

    public $intervalo = [
        ['type' => 'daily', 'label' => 'Diário'],
        ['type' => 'weekly', 'label' => 'Semanal'],
        ['type' => 'monthly', 'label' => 'Mensal']
    ];

    public function getBancos(): array
    {
        return $this->bancos;
    }

    public function getTiposContas(): array
    {
        return $this->tiposContas;
    }

    /**
     * @return string[][]
     */
    public function getIntervalo(): array
    {
        return $this->intervalo;
    }



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

        if(count($this->session->userdata('cart_items')) > 0){
            foreach ($this->session->userdata('cart_items') as $key => $cart_item){
                if(!empty($cart_item)){
                    $counter++;
                    $course_details = $this->crud_model->get_course_by_id($cart_item)->row_array();
                }else{
                    $course_details = $this->crud_model->get_course_by_id($post['course_id'])->row_array();
                }

                $itens[] = [
                    'id'         => $course_details['id'],
                    'title'      => $course_details['title'],
                    'unit_price' => ((int) $course_details['price'] * 100),
                    'quantity' => 1,
                    'tangible' => false
                ];
            }
        }
        $instructor_details = $this->user_model->get_all_user($course_details['user_id'])->row_array();

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
            'items' => $itens,
            'metadata' => json_encode(['itens' => $itens]),
            'split_rules' => [
                [
                    'recipient_id' => $instructor_details['recipient_id'],
                    'percentage' => $instructor_details['percentage'],
                    'liable' => 'true',
                    'charge_processing_fee' => 'true',
                ],
                [
                    'recipient_id' => 're_ckc3m3ysw007yam6egxjxij7q',
                    'percentage' => (100 - (int) $instructor_details),
                    'liable' => 'true',
                    'charge_processing_fee' => 'true',
                ]
            ]
        ];

        if($payment_method == 'boleto'){
            $data['postback_url'] = "https://portal.ladiesboss.com.br/academy/home/pagarme_postback";
            $data['capture']      = true;
            $data['async']        = false;
        }else{
            try{

                $expiry     = $post['expiry'] ?? null;
                $arrayex    = explode(' / ', $expiry);
                $yearExpiry = substr($arrayex[1], -2);

                $ex         = $arrayex[0].$yearExpiry;

                $card = $pagarme->cards()->create([
                    'holder_name'       => $post['name'],
                    'number'            => $post['number'],
                    'expiration_date'   => $ex,
                    'cvv'               => $post['cvc']
                ]);

                $data['installments'] = $post['parcelas'];
                $data['card_id']      = $card->id;
                $data['async']        = false;
            }catch (\PagarMe\Exceptions\PagarMeException $e){
                if($e->getType() == "invalid_parameter"){
                    return [
                        'status' => false,
                        'message' => "Encontramos um erro no campo: ".$e->getParameterName()."\nO campo está vazio ou o formato é inválido."
                    ];
                }
            }

        }

        try {

            $transaction = $pagarme->transactions()->create($data);

            if($transaction->status == 'paid'){
                return ['status' => true];
            } elseif ($payment_method == 'boleto'){
                $this->session->set_userdata('transaction', $transaction);
                redirect('home/pagarme_boleto');
            } else {
                return ['status' => false];
            }
        }catch (\PagarMe\Exceptions\PagarMeException $e){
            //$this->session->set_flashdata('error_message', $e->getMessage());
            return [
                'status' => false,
                'message' => $e->getMessage(),
                'erro' => $e->getMessage()
            ];
        }


    }
    // VALIDATE PAGAR.ME PAYMENT

    public function checkar_taxa_juros($publicKey, $amount = null){
        require_once(APPPATH.'../vendor/autoload.php');

        $pagarme = new PagarMe\Client($publicKey);

        $calculateInstallments = $pagarme->transactions()->calculateInstallments([
            'amount' => ($amount * 100),
            'free_installments' => 1,
            'max_installments' => 12,
            'interest_rate' => 0
        ]);

        return $calculateInstallments;
    }

    public function soNumero($str) {
        return preg_replace("/[^0-9]/", "", $str);
    }

    public function create_recipient($data) {
        require_once(APPPATH.'../vendor/autoload.php');
        $public_key = null;

        $pagarme_keys = get_settings('pagarme_keys');
        $values       = json_decode($pagarme_keys);
        if ($values[0]->testmode == 'on') {
            $public_key = $values[0]->api_key;
            $secret_key = $values[0]->encrypted_key;
        } else {
            $public_key = $values[0]->public_live_key;
            $secret_key = $values[0]->secret_live_key;
        }

        $pagarme = new PagarMe\Client($public_key);

        $user = $this->user_model->get_all_user($data)->row_array();

        $accountId = null;

        if(empty($user['pagarme_account_id'])){
            $accountData = [
                'bank_code' => str_pad($user['bank_code'], 3, "0", STR_PAD_LEFT),
                'agencia' => $user['agencia'],
                'agencia_dv' => $user['agencia_dv'],
                'conta' => $user['conta'],
                'conta_dv' => $user['conta_dv'],
                'document_number' => $this->soNumero($user['cpf']),
                'legal_name' => $user['first_name'] . ' ' . $user['last_name']
            ];
            $bankAccount = $pagarme->bankAccounts()->create($accountData);
            $this->user_model->edit_account_pagarme($user['id'], $bankAccount->id);
            $accountId = $bankAccount->id;
        }else{
            $accountId = $user['pagarme_account_id'];
        }


        if(empty($user['recipient_id'])){
            $recipientData = [
                'anticipatable_volume_percentage' => '0',
                'automatic_anticipation_enabled' => 'false',
                'bank_account_id' => (string)$accountId,
                'transfer_day' => $user['transfer_day'],
                'transfer_enabled' => $user['transfer_enabled'] == 1 ? true : false,
                'transfer_interval' => $user['transfer_interval']
            ];
            $recipient = $pagarme->recipients()->create($recipientData);
            if(!empty($recipient->id)){
                $this->session->set_flashdata('flash_message', 'Este usuário foi adicionado como recebedor no Pagar.me');
            }else{
                $this->session->set_flashdata('error_message', 'Houve um problema ao adicionar o usuário como recebedor, verifique os dados e tente novamente.');
            }
        }else{
            $this->session->set_flashdata('error_message', 'Já existe uma conta cadastrada para este instrutor.');
        }
    }
}
