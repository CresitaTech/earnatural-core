<?php

namespace App\Controllers;
require __DIR__ . '/../../vendor/autoload.php';

use App\Models\Promocode as PromocodeModel;
use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use App\Libraries\Utils; // Import library

class Promocode extends ResourceController
{
    /**
	 * Return an array of resource objects, themselves in array format
	 *
	 * @return mixed
	 */
	public function index()
	{
		$model = new PromocodeModel();
      
        $data = $model->where('status', 'Active')->findAll();
      
        $response = [
            'status' => 200,
            'error' => null,
            'messages' => "Promocodes Found",
            "data" => $data,
        ];
        return $this->respond($response);
	}
	
	public function get_promocode()
	{
		$model = new PromocodeModel();
      
        $data = $model->findAll();
      
        $response = [
            'status' => 200,
            'error' => null,
            'messages' => "Promocodes Found",
            "data" => $data,
        ];
        return $this->respond($response);
	}

	/**
	 * Return the properties of a resource object
	 *
	 * @return mixed
	 */
	public function show($id = null)
	{
		$model = new PromocodeModel();
      
        $data = $model->where(['id' => $id])->first();
      
        if ($data) {
            $response = [
                'status' => 200,
                'error' => null,
                'messages' => "Promocodes Found",
                "data" => $data,
            ];
            return $this->respond($response);
        } else {
            return $this->failNotFound('No Promocodes Found with id ' . $id);
        }
	}

	/**
	 * Return a new resource object, with default properties
	 *
	 * @return mixed
	 */
	public function new()
	{
		//
	}

	/**
	 * Create a new resource object, from "posted" parameters
	 *
	 * @return mixed
	 */
	public function create($id=null)
	{
		$model = new PromocodeModel();
        $utils = new Utils();
		$authHeader = $this->request->getHeader("Authorization");
        $authHeader = $authHeader->getValue();
        $data = [
            'product_name' => $this->request->getVar('product_name'),
            'promocode_title' => $this->request->getVar('promocode_title'),
            'promocode' => $this->request->getVar('promocode'),
            'promocode_discount' => $this->request->getVar('promocode_discount'),
            'unit_price' => $this->request->getVar('unit_price'),
            'promocode_type' => $this->request->getVar('promocode_type'),
            'status' => $this->request->getVar('status'),
            'start_date' => $this->request->getVar('start_date'),
            'expire_date' => $this->request->getVar('expire_date'),
            'created_by' => $utils->get_current_user_id($authHeader),
            'updated_by' => $utils->get_current_user_id($authHeader),
        ];

		if($id != null and $id > 0){
			$model->update($id, $data);
			$response = [
				'status' => 200,
				'error' => null,
				'messages' => "Data Updated"
			];
			return $this->respondCreated($response);
		
		}
        $model->insert($data);

        $response = [
            'status' => 200,
            'error' => null,
            'messages' => "Promocodes Saved",
        ];
      
        return $this->respondCreated($response);
	}

	/**
	 * Return the editable properties of a resource object
	 *
	 * @return mixed
	 */
	public function edit($id = null)
	{
		//
	}

	/**
	 * Add or update a model resource, from "posted" properties
	 *
	 * @return mixed
	 */
	public function update($id = null)
	{
		$model = new PromocodeModel();
		$utils = new Utils();
		$authHeader = $this->request->getHeader("Authorization");
        $authHeader = $authHeader->getValue();
		
        $data = [
            'product_name' => $this->request->getVar('product_name'),
            'promocode_title' => $this->request->getVar('promocode_title'),
            'promocode' => $this->request->getVar('promocode'),
            'promocode_discount' => $this->request->getVar('promocode_discount'),
            'unit_price' => $this->request->getVar('unit_price'),
            'promocode_type' => $this->request->getVar('promocode_type'),
            'status' => $this->request->getVar('status'),
            'start_date' => $this->request->getVar('start_date'),
            'expire_date' => $this->request->getVar('expire_date'),
            //'created_by' => $this->request->getVar('created_by'),
            'updated_by' => $utils->get_current_user_id($authHeader),
        ];
        log_message("error", "Data ================:" . json_encode($data));

        $model->update($id, $data);
		
		 
        $response = [
            'status' => 200,
            'error' => null,
            'messages' => "Data Updated"
        ];
        return $this->respondCreated($response);
	}

	/**
	 * Delete the designated resource object from the model
	 *
	 * @return mixed
	 */
	public function delete($id = null)
	{
		$model = new PromocodeModel();

        $data = $model->find($id);

        if ($data) {

            $model->delete($id);

            $response = [
                'status' => 200,
                'error' => null,
                'messages' => "Data Deleted",
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('No Data Found with id ' . $id);
        }
	}
	
	
	/**
	 * Return the properties of a resource object
	 *
	 * @return mixed
	 */
	public function summary($id = null)
	{
		$model = new PromocodeModel();
        $db = db_connect();
        //$db->query("SELECT * FROM promocodes WHERE expire_date <= date('Y-m-d')")->getNumRows()
        $response = [
            'status' => 200,
            'error' => null,
            'messages' => "Promocodes Found",
            "data" => array(
                'active' => count($db->query("SELECT * FROM promocodes WHERE status = 'Active'")->getResult()),
                'total' => count($db->query("SELECT * FROM promocodes")->getResult()),
                'expired' => count($db->query("SELECT * FROM promocodes WHERE expire_date <= date('Y-m-d')")->getResult())
            ),
        ];
        return $this->respond($response);
	}


}
