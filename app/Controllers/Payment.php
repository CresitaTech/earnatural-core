<?php
namespace App\Controllers;

require __DIR__ . '/../../vendor/autoload.php';
use CodeIgniter\RESTful\ResourceController;
use App\Entities as NaturalAPI;
use App\Controllers as NaturalController;
use App\Constants\ANetEnvironment;
use App\Entities\Request;
use App\Libraries\Utils;
use App\Models\Customer;
use App\Models\Creditcard;
use App\Models\Order;
use App\Models\Orderitems;
use App\Models\Promocode as PromocodeModel;

define("AUTHORIZENET_LOG_FILE", "earnatural.log");

class Payment extends ResourceController
{
    protected $modelName = 'App\Models\Site';
    protected $format    = 'json';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }

        
    public function chargeCreditCard()
    {
        $json = $this->request->getJSON();
        $request = new Request();
        $array = (array) $json;
        $request->fill($array);
               
        $utils = new Utils();
        log_message("error", "Received request" . json_encode($json));
        $userdata = $this->getCustomerInfo($json);
        $customer = new Customer();
        $customer_id = $customer->insert($userdata);
        $cardData = $this->getCreditCardInfo($json, $customer_id);
        
        $items = $this->getOrderItems($json);
        
        $card = new Creditcard();
        $card->insert($cardData);
        
        $expDataArr = explode("/", $json->expiryDate);
        $expirationDate = substr(date('Y-m-d'), 0, 2).trim($expDataArr[1]).'-'.trim($expDataArr[0]);

        $merchantAuthentication = new NaturalAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName((getenv('CI_ENVIRONMENT')=='production') ? AUTHORIZE_NAME_PROD : AUTHORIZE_NAME_TEST);
        $merchantAuthentication->setTransactionKey((getenv('CI_ENVIRONMENT')=='production') ? AUTHORIZE_TRANSACTION_KEY_PROD : AUTHORIZE_TRANSACTION_KEY_TEST);
        
        // Set the transaction's refId
        $refId = 'ref' . time();

        // Create the payment data for a credit card
        $creditCard = new NaturalAPI\CreditCardType();
        $creditCard->setCardNumber($json->cardNumber);
        $creditCard->setExpirationDate($expirationDate);
        $creditCard->setCardCode($json->cvv);


        // Add the payment data to a paymentType object
        $paymentOne = new NaturalAPI\PaymentType();
        $paymentOne->setCreditCard($creditCard);

        // Create order information
        $order = new NaturalAPI\OrderType();
        $order->setInvoiceNumber($customer_id);
        $order->setDescription($json->productDesc);

        // Set the customer's Bill To address
        $customerBillAddress = new NaturalAPI\CustomerAddressType();
        $customerBillAddress->setFirstName($json->cardHolderName);
        $customerBillAddress->setLastName(" ");
        $customerBillAddress->setCompany($json->cardHolderName);
        $customerBillAddress->setAddress($json->address1 . ' ' . $json->address2);
        $customerBillAddress->setCity($json->city);
        $customerBillAddress->setState($json->state);
        $customerBillAddress->setZip($json->zip);
        $customerBillAddress->setCountry($json->cvv);
        
        // Set the customer's Ship To address
        $customerShipAddress = new NaturalAPI\CustomerAddressType();
        $customerShipAddress->setFirstName($json->cardHolderName);
        $customerShipAddress->setLastName(" ");
        $customerShipAddress->setCompany($json->cardHolderName);
        $customerShipAddress->setAddress($json->shippingAddress1 . ' ' . $json->shippingAddress2);
        $customerShipAddress->setCity($json->shippingCity);
        $customerShipAddress->setState($json->shippingState);
        $customerShipAddress->setZip($json->shippingZip);
        $customerShipAddress->setCountry($json->cvv);

        // Set the customer's identifying information
        $customerData = new NaturalAPI\CustomerDataType();
        $customerData->setType("individual");
        $customerData->setId($customer_id);
        $customerData->setEmail($json->email);

        // Add values for transaction settings
        $duplicateWindowSetting = new NaturalAPI\SettingType();
        $duplicateWindowSetting->setSettingName("duplicateWindow");
        $duplicateWindowSetting->setSettingValue("60");

        // Add some merchant defined fields. These fields won't be stored with the transaction,
        // but will be echoed back in the response.
        $merchantDefinedField1 = new NaturalAPI\UserFieldType();
        $merchantDefinedField1->setName("customer_id");
        $merchantDefinedField1->setValue($customer_id);

        $merchantDefinedField2 = new NaturalAPI\UserFieldType();
        $merchantDefinedField2->setName("favoriteColor");
        $merchantDefinedField2->setValue("blue");

        // Create a TransactionRequestType object and add the previous objects to it
        $transactionRequestType = new NaturalAPI\TransactionRequestType();
        $transactionRequestType->setTransactionType("authCaptureTransaction");
        $transactionRequestType->setAmount(sprintf('%.2f', $items['grandTotal']));
        $transactionRequestType->setOrder($order); 
        $transactionRequestType->setPayment($paymentOne);
        $transactionRequestType->setBillTo($customerBillAddress);
        $transactionRequestType->setShipTo($customerShipAddress);
        $transactionRequestType->setCustomer($customerData);
        $transactionRequestType->addToTransactionSettings($duplicateWindowSetting);
        $transactionRequestType->addToUserFields($merchantDefinedField1);
        $transactionRequestType->addToUserFields($merchantDefinedField2);
 
        // Assemble the complete transaction request
        $request = new NaturalAPI\CreateTransactionRequest();
        $request->setMerchantAuthentication($merchantAuthentication);
        $request->setRefId($refId);
        $request->setTransactionRequest($transactionRequestType);

        // Create the controller and get the response
        $controller = new NaturalController\CreateTransactionController($request);
        $response = $controller->executeWithApiResponse((getenv('CI_ENVIRONMENT')=='production') ? AUTHORIZE_PROD : AUTHORIZE_TEST);        
        if ($response != null) {
            // Check to see if the API request was successfully received and acted upon
            if ($response->getMessages()->getResultCode() == "Ok") {
                // Since the API request was successful, look for a transaction response
                // and parse it to display the results of authorizing the card
                $tresponse = $response->getTransactionResponse();
                if ($tresponse != null && $tresponse->getMessages() != null) {
                    $orderData = $this->getOrderInfo($response);
                    $order = new Order();
                    $order_id = $order->insert($orderData);
                    $orderItem = new Orderitems();
                    $orderItemData = array(
                        'orderId' => $order_id,
                        'productName' => $json->productName,
                        'productDesc' => $json->productDesc,
                        'quantity' => $json->quantity,
                        'unitPrice' => $json->unitPrice,
                        'promocode' => $json->promocode
                    );
                    $orderItem->insert($orderItemData);
                    
                    $utils->sendMailToCustomer($json, $items, $orderData, $customer_id);
                    
                    return $this->makeResponse(201, $tresponse->getMessages()[0]->getDescription());
                    
                } else {
                    if ($tresponse->getErrors() != null) {
                        return $this->makeResponse(400, $tresponse->getErrors()[0]->getErrorText());
                    }
                    
                }
                // Or, print errors if the API request wasn't successful
            } else {
                $tresponse = $response->getTransactionResponse();
            
                if ($tresponse != null && $tresponse->getErrors() != null) {                    
                    return $this->makeResponse(400, $tresponse->getErrors()[0]->getErrorText());
                    
                } else {                    
                    return $this->makeResponse(400, $response->getMessages()->getMessage()[0]->getText());
                    
                }
            }
        } else {
            return $this->makeResponse(400, ERROR_500);
            
        }

    }
    
    function getCustomerInfo($json){
        $userdata = array(
            'cardHolderName' => $json->cardHolderName,
            'email' => $json->email,
            'address1' => $json->address1,
            'address2' => $json->address2,
            'city' => $json->city,
            'state' => $json->state,
            'zip' => $json->zip,
            'promoCodeId' => $json->promocode,
            'shippingAddress1' => $json->optradio == 'Same' ? $json->address1 : $json->shippingAddress1,
            'shippingAddress2' => $json->optradio == 'Same' ? $json->address2 : $json->shippingAddress2,
            'shippingCity' => $json->optradio == 'Same' ? $json->city : $json->shippingCity,
            'shippingState' => $json->optradio == 'Same' ? $json->state : $json->shippingState,
            'shippingZip' => $json->optradio == 'Same' ? $json->zip : $json->shippingZip
        );
        //log_message("info", "get_customer_info Received request" . json_encode($userdata));
        
        return $userdata;
    }
     
    function getCreditCardInfo($json, $customerId){
        $userdata = array(
            'customerId' => $customerId,
            'cardHolderName' => $json->cardHolderName,
            'cardNumber' => 'XXXX-XXXX-XXXX-' . substr($json->cardNumber, -4),
            'cvv' =>  'XXX', //$json->cvv,
            'expiryDate' => 'XX/XX', //$json->expiryDate
        ); 
        //log_message("info", "get_credit_card_info Received request" . json_encode($userdata));
        
        return $userdata;
    }
    
    function getOrderInfo($response){
        $tresponse = $response->getTransactionResponse();
        $orderData = array(
            'refId' => $response->getRefId(),
            'accountNumber' => $tresponse->getAccountNumber(),
            'accountType' => $tresponse->getAccountType(),
            'authCode' => $tresponse->getAuthCode(),
            'avsResultCode' => $tresponse->getAvsResultCode(),
            'cavvResultCode' => $tresponse->getCavvResultCode(),
            'cvvResultCode' => $tresponse->getCvvResultCode(),
            'refTransID' => $tresponse->getRefTransID(),
            'responseCode' => $tresponse->getResponseCode(),
            'transId' => $tresponse->getTransId(),
            'customerId' => $tresponse->getUserFields()[0]->getValue(),
            'status' => $response->getMessages()->getResultCode()
        );
        
        return $orderData;
    }
    
    function getOrderItems($json){
        # $items = array();
        $subtotal = 0;
        $promocodeDiscount = 0;
        $discountedPrice = 0;
        $grandTotal = 0;
        $model = new PromocodeModel();
        if(isset($json->promocode) && $json->promocode != 'null'){
            $promoCode = $model->where(['id' => $json->promocode])->first();
            if ($promoCode) {
                $promocode = $promoCode['promocode_title'];
                $promocodeType = $promoCode['promocode_type'];
                if($promoCode['promocode_type']=='Percentage'){
                    $subtotal = $json->unitPrice * $json->quantity;
                    $promocodeDiscount = $promoCode['promocode_discount'];
                    $discountedPrice = $subtotal - ($json->quantity * round($json->unitPrice * $promocodeDiscount/100) );
                    $grandTotal = $subtotal - ($json->quantity * round($json->unitPrice * $promocodeDiscount/100) ) + $json->shippingCharge;
                }else{
                    $subtotal = $json->unitPrice * $json->quantity;
                    $promocodeDiscount = $promoCode['promocode_discount'];
                    $discountedPrice = $subtotal - $promocodeDiscount;
                    $grandTotal = ($subtotal - $promocodeDiscount)  + $json->shippingCharge;
                }
            }
        }else{
            $subtotal = ($json->unitPrice * $json->quantity) + $json->shippingCharge;
        }
        
        
        $items = array(
            'itemId' => rand(00000000,999999999),
            'name' => $json->productName,
            'description' => $json->productDesc,
            'quantity' => $json->quantity,
            'unitPrice' => $json->unitPrice,
            'shippingCharge' => $json->shippingCharge,
            'subTotal' => $subtotal,
            'promocode' => isset($promocode) ? $promocode : null,
            'discountedPrice' => $discountedPrice,
            'grandTotal' => $grandTotal
        );
        # array_push($items, $data);
        
        return $items;
    }


    function makeResponse($code, $message){
        $response = [
            'status' => $code,
            'error' => null,
            'messages' => array(
                'success' => $message
            )
        ];
        return $this->respondCreated($response);
        //echo json_encode($this->respondCreated($response));
    }
    
    
}