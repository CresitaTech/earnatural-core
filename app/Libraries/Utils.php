<?php

namespace App\Libraries;
use Firebase\JWT\JWT;
use App\Models\Promocode as PromocodeModel;

class Utils{
    
    function post_json($data){
        $data_string = json_encode($data);
        $base_url = (getenv('CI_ENVIRONMENT')=='production') ? AUTHORIZE_PROD : AUTHORIZE_TEST;
        log_message('info', "Data ready for post to URL: " . $base_url );
        $ch=curl_init($base_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $response = curl_exec( $ch );
        /**if(!$response){
            die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
        } */
        curl_close($ch);
        return $response;
    }
    
    
    function get_post_data($cart, $postdata, $json){
        $grand_total = 0;
        $items = array();
        
        foreach ($cart as $item){
            $data = array(
                'itemId' => $item['itemId'],
                'name' => $item['name'],
                'description' => $item['description'],
                'quantity' => $item['quantity'],
                'unitPrice' => $item['unitPrice'],
            );
            $grand_total = $grand_total + $item['subtotal'];
            array_push($items, $data);
        }
        
        $payment = array ('creditCard' => array (
            'cardNumber' => $postdata['card_number'],
            'expirationDate' => $postdata['expiration_date'],
            'cardCode' => $postdata['cvv'],
            ),
        );
        
        $lineItems = array ('lineItem' => $items );
        $postData = array (
            'createTransactionRequest' => array (
                'merchantAuthentication' => array (
                    'name' => (getenv('CI_ENVIRONMENT')=='production') ? AUTHORIZE_NAME_PROD : AUTHORIZE_NAME_TEST,
                    'transactionKey' => (getenv('CI_ENVIRONMENT')=='production') ? AUTHORIZE_TRANSACTION_KEY_PROD : AUTHORIZE_TRANSACTION_KEY_TEST,
                ),
                'refId' => $postdata['customer_id'],
                'transactionRequest' => array (
                    'transactionType' => 'authCaptureTransaction',
                    'amount' => sprintf('%.2f', $grand_total),
                    'payment' => $payment,
                    'lineItems' => $lineItems,
                    "shipping" => array(
                        "amount" => $cart[0]['shipping_charge'],
                        "name" => "S/H Fee",
                        "description" => "S/H Fee"
                    ),
                    'customer' => array (
                        'id' => $postdata['customer_id'],
                    ),
                    'billTo' => array (
                        'firstName' => $postdata['card_holder_name'],
                        'lastName' => "",
                        'company' => '',
                        'address' => $postdata['address_1'] . ' ' . $postdata['address_1'],
                        'city' => $postdata['city'],
                        'state' => $postdata['state'],
                        'zip' => $postdata['zip'],
                        'country' => '',
                    ),
                    'shipTo' => array (
                        'firstName' => $postdata['card_holder_name'],
                        'lastName' => "",//$postdata['shipping_last_name']
                        'company' => '',
                        'address' => $postdata['shipping_address_1'] . ' ' . $postdata['shipping_address_2'],
                        'city' => $postdata['shipping_city'],
                        'state' => $postdata['shipping_state'],
                        'zip' => $postdata['shipping_zip'],
                        'country' => "",
                    ),
                    'customerIP' => $_SERVER['REMOTE_ADDR'],
                    'userFields' => array (
                        'userField' => array (
                            0 => array (
                                'name' => 'customer_id',
                                'value' => $postdata['customer_id'],
                            ),
                        ),
                    ),
                    "processingOptions" => array(
                        "isSubsequentAuth" => "true"
                    ),
                    "subsequentAuthInformation" => array(
                        "originalNetworkTransId" => "123456789NNNH",
                        "originalAuthAmount" => sprintf('%.2f', $grand_total),
                        "reason" => "resubmission"         
                    ),			
                    "authorizationIndicatorType" => array(
                       "authorizationIndicator" => "final"
                    )
                ),
            ),
        );
        log_message('info', "Data ready for post: " . json_encode($postData) );

        return $postData;
    }


    ########################### Product model ###############################

    function get_order_items($json){
        $items = array();
        $subtotal = 0;
        $promocode = "Promocode not applied.";
        $model = new PromocodeModel();
        log_message("info", "promoCodeID ================:" . $json->promocode);
        if($json->promocode != 'null'){
            $promoCode = $model->where(['id' => $json->promocode])->first();
            if ($promoCode) {
                log_message("info", "promoCode ================:" . json_encode($promoCode));
                log_message("info", "promoCode promocode_type ================:" . json_encode($promoCode['promocode_type']));
                log_message("info", "promoCode promocode_discount ================:" . json_encode($promoCode['promocode_discount']));
                $promocode = $promoCode['promocode_title'];
                if($promoCode['promocode_type']=='Percentage'){
                    $subtotal = $json->unitPrice * $json->quantity;
                    $promocode_discount = $promoCode['promocode_discount'];
                    $subtotal = $subtotal - round($subtotal * ($promocode_discount/100) ) + $json->shipping_charge;
                }else{
                    $subtotal = $json->unitPrice * $json->quantity;
                    $promocode_discount = $promoCode['promocode_discount'];
                    $subtotal = ($subtotal - $promocode_discount)  + $json->shipping_charge;
                }
            }
        }else{
            $subtotal = ($json->unitPrice * $json->quantity) + $json->shipping_charge;
        }
        

        $data = array(
            'itemId' => rand(00000000,999999999),
            'name' => $json->product_name,
            'description' => $json->product_desc,
            'quantity' => $json->quantity,
            'unitPrice' => $json->unitPrice,
            'shipping_charge' => $json->shipping_charge,
            'subtotal' => $subtotal,
            'promocode' => $promocode
        );
        array_push($items, $data);

        return $items;
    }

    function get_customer_info($json){
        $userdata = array(
            'cardHolderName' => $json->cardHolderName,
			'email' => $json->email,
            'address1' => $json->address1,
            'address2' => $json->address2,
            'city' => $json->city,
            'state' => $json->state,
            'zip' => $json->zip,
            'promocode' => $json->promocode,
            'shippingAddress1' => $json->optradio == 'Same' ? $json->address1 : $json->shippingAddress1,
            'shippingAddress2' => $json->optradio == 'Same' ? $json->address2 : $json->shippingAddress2,
            'shippingCity' => $json->optradio == 'Same' ? $json->city : $json->shippingCity,
            'shippingState' => $json->optradio == 'Same' ? $json->state : $json->shippingState,
            'shippingZip' => $json->optradio == 'Same' ? $json->zip : $json->shippingZip
        );
        log_message("info", "get_customer_info Received request" . json_encode($userdata));

        return $userdata;
    }
    
    function get_credit_card_info($json, $customerId){
        $userdata = array(
            'customerId' => $customerId,
            'cardHolderName' => $json->cardHolderName,
            'cardNumber' => $json->cardNumber,
            'cvv' => $json->cvv,
            'expiryDate' => $json->expiryDate
        );
        log_message("info", "get_credit_card_info Received request" . json_encode($userdata));
        
        return $userdata;
    }

    function get_post_request($json, $customer_id){
        $expDataArr = explode("/", $json->expiryDate);
        log_message("error", "get_post_request Received request" . json_encode($json));

        $data = array(
            'customer_id' => $customer_id,
            'card_number' => $json->cardNumber,
            'expiration_date' => "20".trim($expDataArr[1]).'-'.trim($expDataArr[0]),
            'cvv' =>  $json->cvv,
            'card_holder_name' => $json->card_holder_name,
			'email' => $json->email,
            'address_1' => $json->address_1,
            'address_2' => $json->address_2,
            'city' => $json->city,
            'state' => $json->state,
            'zip' => $json->zip,
            'shipping_address_1' => $json->optradio == 'Same' ? $json->address_1 : $json->shipping_address_1,
            'shipping_address_2' => $json->optradio == 'Same' ? $json->address_2 : $json->shipping_address_2,
            'shipping_city' => $json->optradio == 'Same' ? $json->city : $json->shipping_city,
            'shipping_state' => $json->optradio == 'Same' ? $json->state : $json->shipping_state,
            'shipping_zip' => $json->optradio == 'Same' ? $json->zip : $json->shipping_zip,
            'created_at' => date('Y-m-d H:i:s')
        );
		

        return $data;
    }

    function get_order_info($response){

        $tresponse = $response->transactionResponse;

        $orderData = array(
            'refId' => $response->refId,
            'accountNumber' => $tresponse->accountNumber,
            'accountType' => $tresponse->accountType,
            'authCode' => $tresponse->authCode,
            'avsResultCode' => $tresponse->avsResultCode,
            'cavvResultCode' => $tresponse->cavvResultCode,
            'cvvResultCode' => $tresponse->cvvResultCode,
            'refTransID' => $tresponse->refTransID,
            'responseCode' => $tresponse->responseCode,
            'transId' => $tresponse->transId,
            'customerId' => $tresponse->userFields[0]->value,
            'status' => $response->messages->resultCode,
            'createdAt' => date('Y-m-d H:i:s')
        );

        return $orderData;
    }

    public function get_current_user_id($authHeader)
    {
        $key = getenv('JWT_SECRET');
        $token = null;
        if(!empty($authHeader)) {
            if (preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
                $token = $matches[1];
            }
        }
        // check if token is null or empty
        if(is_null($token) || empty($token)) {
            return null;
        }
        try {
            $decoded = JWT::decode($token, $key, array("HS256"));
            $userData = (array) $decoded;
            $userData = (array) $userData['data'];

            if ($userData) {
                return $userData['id'];
            }
        } catch (Exception $ex) {
          
            return null;
        }
    }

    
    function get_promocode($token){
        $base_url = (getenv('CI_ENVIRONMENT')=='production') ? PRODUCTION_API_URL : STAGING_API_URL;
        $headers = array(
            "Authorization: Bearer $token",
            "Content-Type: application/json",
         );
        //echo json_encode($headers);
        //echo $base_url.'/promocodes';
        log_message('info', "Data ready for post to URL: " . $base_url );
        $ch=curl_init($base_url.'/get_promocode'); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
        $response = curl_exec( $ch );

        /**if(!$response){
            die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
        } */
        curl_close($ch);
        return $response;
    }

    function get_summary($token){
        $base_url = (getenv('CI_ENVIRONMENT')=='production') ? PRODUCTION_API_URL : STAGING_API_URL;
        $headers = array(
            "Authorization: Bearer $token",
            "Content-Type: application/json",
         );
        //echo json_encode($headers);
        //echo $base_url.'/promocodes';
        log_message('info', "Data ready for post to URL: " . $base_url );
        $ch=curl_init($base_url.'/summary');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
        $response = curl_exec( $ch );

        /**if(!$response){
            die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
        } */
        curl_close($ch);
        return $response;
    }

    function delete_promocode($token, $id){
        $base_url = (getenv('CI_ENVIRONMENT')=='production') ? PRODUCTION_API_URL : STAGING_API_URL;
        $headers = array(
            "Authorization: Bearer $token",
            "Content-Type: application/json",
         );
        //echo json_encode($headers);
        //echo $base_url.'/promocodes';
        log_message('info', "Data ready for post to URL: " . $base_url );
        $ch=curl_init($base_url.'/promocodes/'.$id);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
        $response = curl_exec( $ch );

        /**if(!$response){
            die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
        } */
        curl_close($ch);
        return $response;
    }

    function edit_promocode($token, $data, $id){
        $base_url = (getenv('CI_ENVIRONMENT')=='production') ? PRODUCTION_API_URL : STAGING_API_URL;
        $headers = array(
            "Authorization: Bearer $token",
            "Content-Type: application/json",
        );
        //echo json_encode($headers);
        log_message('info', "Data ready for post to URL: " . $base_url );
        $ch=curl_init($base_url . '/promocodes/'.$id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $response = curl_exec( $ch );
        
        if(!$response){
            die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
        }
        curl_close($ch);
        return $response;

    }

    function add_promocode($token, $data){
        $base_url = (getenv('CI_ENVIRONMENT')=='production') ? PRODUCTION_API_URL : STAGING_API_URL;
        $headers = array(
            "Authorization: Bearer $token",
            "Content-Type: application/json",
        );
        //echo json_encode($headers);
        log_message('info', "Data ready for post to URL: " . $base_url );
        $ch=curl_init($base_url . '/promocodes');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        
        if(!$response){
            die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
        }
        curl_close($ch);
        return $response;

    }

    
    function sendMailToCustomer($postData, $items, $orderData, $customer_id){
        $data['orderData'] = array(
            'postData' => $postData,
            'cartItem' => $items,
            'order' => $orderData,
            'customer_id' => $customer_id
        );
        
        $email = \Config\Services::email();
        //$email->setTo("agrawalv@cresitatech.com");
        
        $email->setTo($postData->email);
        //$email->setCC('kuriwaln@opallios.com');
        //$email->setCC('mathurp@opallios.com');
        
        $email->setFrom('support@earnatural.com', 'Earnatural Team');
        $email->setSubject("Your earnatural.com order #". $customer_id);
        $email->setMessage(view('templates/customer', $data ));
        
        if (!$email->send())
        {
            $data = $email->printDebugger(['headers']);
            log_message('error', 'Cusotmer Email not sent' . json_encode($data));
        }
        log_message('info', 'Cusotmer Email sent');
        
        $email->setTo("support@earnatural.com");
		 
        //$email->setTo('agrawalv@cresitatech.com');
        //$email->setCC('kuriwaln@opallios.com');
        //$email->setCC('mathurp@opallios.com'); 
        
        $email->setFrom('admin@earnatural.com', 'Earnatural Team');
        $email->setSubject("Order Confirmation #". $customer_id);
        $email->setMessage(view('templates/admin', $data ));
        
        if (!$email->send())
        {
            $data = $email->printDebugger(['headers']);
            log_message('error', 'Admin Email not sent' . json_encode($data));
            
        }
        log_message('info', 'Admin Email sent');
        
    }
    
    
    
    
    
}