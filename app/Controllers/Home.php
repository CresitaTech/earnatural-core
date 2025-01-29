<?php

namespace App\Controllers;
use CodeIgniter\HTTP\RequestInterface;
use App\Libraries\Utils; // Import library

class Home extends BaseController
{
    public $base_url = 'http://staging.earnatural.com/api';

    public function admin()
    {
        $data['orderData'] = array(
			'postData' => [],
			'cartItem' => [],
            'order' => []
		);
        //$session = session();
        //$session->destroy();
        return view('templates/admin', $data);
    }
    public function customer()
    {
        $data['orderData'] = array(
			'postData' => [],
			'cartItem' => [],
            'order' => []
		);
        //$session = session();
        //$session->destroy();
        return view('templates/customer');
    }

    public function index()
    {
        //$session = session();
        //$session->destroy();
        return view('login');
    }

    public function dashboard(){
        $utils = new Utils();
        $session = session();
        $db = db_connect();
        $dd =  $db->query("SELECT * FROM promocodes WHERE expire_date <= date('Y-m-d')")->getResult();
        //echo json_encode($dd);

        $data['summary'] = $utils->get_summary($session->get('token'));
        $data['userdata'] = $utils->get_promocode($session->get('token'));
        //echo $data['userdata'];
        if($data['summary']){
            $summary = json_decode($data['summary']);
            $data['summary'] = $summary->data;
        }

        if($data['userdata']){
            $promocode = json_decode($data['userdata']);
            $data['userdata'] = $promocode->data;
        }
        return view('dashboard', $data);
    }

    public function delete_promocode($id){
        $utils = new Utils();
        $session = session();
        $response = $utils->delete_promocode($session->get('token'), $id);
        //echo json_encode($response);
        return redirect()->to('home/dashboard'); 
    }

    public function edit_promocode(){
        $data_string = json_encode($this->request->getPost());
        $utils = new Utils();
        $session = session();
        $response = $utils->edit_promocode($session->get('token'), $data_string , $this->request->getPost('id'));
        echo json_encode($response);
        //echo  $this->request->getPost('id');
        return redirect()->to('home/dashboard'); 
    }

    public function add_promocode(){
        $data_string = json_encode($this->request->getPost());
        $utils = new Utils();
        $session = session();
        $response = $utils->add_promocode($session->get('token'), $data_string);
        //echo json_encode($response);
        return redirect()->to('home/dashboard'); 
    }


    public function logout(){
        $session = session();
        $session->destroy();

        return redirect()->to('home'); 
    }

    function login(){

        $data_string = json_encode($this->request->getPost());
        $base_url = 'https://www.earnatural.com/api';
        log_message('info', "Data ready for post to URL: " . $base_url );
        $ch=curl_init($base_url . '/login');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $response = curl_exec( $ch );
        $session = session();
        $session->destroy();
        $res = json_decode($response);
        $newdata = [
            'token'  => $res->data->token,
            'user_id' => $res->data->user_id,
            'username' => $res->data->username,
            'logged_in' => true,
        ];
        $session->set($newdata);

        //echo json_encode($session->get());

        if(!$response){
            die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
        }
        curl_close($ch);
        return redirect()->to('home/dashboard'); 

    }
    
}
