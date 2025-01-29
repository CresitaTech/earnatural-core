<?php
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\RequestInterface;
use App\Models\Customer;
use App\Models\Product as ProductModel;
use App\Models\Order;
use App\Libraries; 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Libraries\Utils; // Import library
use App\Libraries\Luhn; // Import library

class Product extends ResourceController {
	
    protected $modelName = 'App\Models\Product';
    protected $format    = 'json';
	// fetch all products
    public function index() {
        return $this->respond($this->model->findAll());
    }

    /**
	 * Return the properties of a resource object
	 *
	 * @return mixed
	 */
	public function show($id = 1)
	{
		$model = new ProductModel();
        $data = $model->where(['id' => $id])->first();
        if ($data) {
            $response = [
                'status' => 200,
                'error' => null,
                'messages' => "Product Found",
                "data" => $data,
            ];
            return $this->respondCreated($response);
        } else {
            return $this->failNotFound('No Product Found with id ' . $id);
        }
	}

    // save new product info
    public function create() {
		// get posted JSON
		//$json = json_decode(file_get_contents("php://input", true));
		$json = $this->request->getJSON();
        $product = new ProductModel();
        $customer = new Customer();
        $common = new Utils();
        log_message("error", "Received request" . json_encode($json));

        $userdata = $common->get_customer_info($json);
        $customer_id = $customer->insert($userdata);
        $postdata = $common->get_post_request($json, $customer_id);

        $response = $this->procced_credit_card_payment_checkout($common, $postdata, $json);
		return $this->respondCreated($response);
    }

    
    function procced_credit_card_payment_checkout($common, $postdata, $json)
    {
        $order = new Order();
        $items = $common->get_order_items($json);

        $request = $common->get_post_data($items, $postdata, $json);
        $result =  $common->post_json($request);
        $response = str_replace('?', '', utf8_decode($result));
        $response = json_decode($response);
        $resMsg = ERROR_500;
        // Check to see if the API request was successfully received

        if($response != null){
            log_message('info', RESPONSE, $this->set_error(200, json_encode($response)) );
            if($response->messages->resultCode == 'Ok' ){ 
                // Since the API request was successful, look for a transaction response
                // and parse it to display the results of authorizing the card
                $tresponse = $response->transactionResponse;
                if ($tresponse != null && $tresponse->messages != null) {
                    
                    $orderData = $common->get_order_info($response);

                    $resMsg = $tresponse->messages[0]->description;
                    $order->insert($orderData);
                    $this->sendMailToCustomer($postdata, $items, $orderData);
                    log_message('info', SUCCESS_INFO, $this->set_error($tresponse->messages[0]->code,
                    $tresponse->messages[0]->description));

                    return $this->get_response(201, $resMsg);
                }

                if (isset($tresponse->errors) && $tresponse->errors != null) {
                    log_message('info', ERROR_INFO, $this->set_error($tresponse->errors[0]->errorCode,
                    $tresponse->errors[0]->errorText));
                    $resMsg = $tresponse->errors[0]->errorText;
                    return $this->get_response(400, $resMsg);
                } 
                
            }else{
                    if(isset($response->transactionResponse) && $response->transactionResponse != null){
                        $tresponse = $response->transactionResponse;
                        log_message('info', "Error tresponse: " . json_encode($tresponse) );
                        log_message('info', "Error response: " . json_encode($response) );
    
                        if ($tresponse != null && isset($tresponse->errors) && $tresponse->errors != null ) {
                            log_message('info', ERROR_INFO, $this->set_error($tresponse->errors[0]->errorCode,
                            $tresponse->errors[0]->errorText));
                            $resMsg = $tresponse->errors[0]->errorText;
                            return $this->get_response(400, $resMsg);
                        }
    
                        log_message('info', ERROR_INFO, $this->set_error($response->messages->message[0]->code,
                        $response->messages->message[0]->text));
                        $resMsg = $response->messages->message[0]->text;
                        return $this->get_response(400, $resMsg);
                    }

                    log_message('info', ERROR_INFO, $this->set_error($response->messages->message[0]->code,
                    $response->messages->message[0]->text));
                    $resMsg = $response->messages->message[0]->text;
                    return $this->get_response(400, $resMsg);

                    
    
            }
        }else{
            return $this->get_response(400, $resMsg);
        }
        /**try
        {
      
        }
        catch (\Exception $e)
        {
            log_message('error', '[ERROR] {exception}', ['exception' => $e]);
            return $this->get_response(400, $resMsg);

        } */
        
    }

    function get_response($code, $message){
        $response = array(
            'status'   => $code,
            'messages' => array(
                'success' => $message
            )
        );
        return $response;
    }

    function set_error($code, $message){
        $response = array(
            'code'   => $code,
            'message' => $message
        );
        return $response;
    }
    
	function sendMailToCustomer($postData, $items, $orderData){
		$data['orderData'] = array(
			'postData' => $postData,
			'cartItem' => $items,
            'order' => $orderData
		);
		
        $email = \Config\Services::email();
        $email->setTo("agrawalv@cresitatech.com");

		//$email->setTo($postData['email']); 
        $email->setCC('kuriwaln@opallios.com');
		//$email->setCC('mathurp@opallios.com');
		
        $email->setFrom('support@earnatural.com', 'Earnatural Team');
        $email->setSubject("Your earnatural.com order #".$postData['customer_id']);
        $email->setMessage(view('templates/customer', $data ));	
		
        if (!$email->send()) 
		{
            $data = $email->printDebugger(['headers']);
            print_r($data);
            log_message('error', 'Cusotmer Email not sent' . json_encode($data));
        }
		log_message('info', 'Cusotmer Email sent');
		
        //$email->setTo("admin@earnatural.com");
        $email->setTo('agrawalv@cresitatech.com');
        $email->setCC('kuriwaln@opallios.com');
		//$email->setCC('mathurp@opallios.com');
 
        $email->setFrom('support@earnatural.com', 'Earnatural Team');
		$email->setSubject("Order Confirmation #".$postData['customer_id']); 
        $email->setMessage(view('templates/admin', $data ));

        if (!$email->send()) 
		{
            $data = $email->printDebugger(['headers']);
            print_r($data);
            log_message('error', 'Admin Email not sent' . json_encode($data));

        }
		log_message('info', 'Admin Email sent');

	}

    
	function validateCard($vnumber)
	{
	    //require APPPATH.'Libraries/Luhn.php';
	    $luhn = new Luhn();
	    if ($luhn->validate(substr($vnumber, 0, -1), substr($vnumber, -1, 1)) == true) {
	        $vresult = "VALID";
	    } else {
	        $vresult = "INVALID";
	    }
		$response = [
				'status' => 200,
				'error' => null,
				'messages' => "Data Validation",
				"data" => $vresult,
			];
		return $this->respondCreated($response);
			
	    //echo json_encode(array('status' => $vresult));
	    
	}


    
}