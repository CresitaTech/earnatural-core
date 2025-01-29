<?php

namespace App\Entities;
use CodeIgniter\Entity;
/**
 * Class representing Customer
 *
 *
 * XSD Type: Customer
 */
class Order extends Entity
{
    private $id = null;
    private $ref_id = null;
    private $account_number = null;
    private $account_type = null;
    private $auth_code = null;
    private $avs_result_code = null;
    private $cavv_result_code = null;
    private $cvv_result_code = null;
    private $ref_trans_id = null;
    private $response_code = null;
    private $trans_id = null;
    private $sale_id = null;
    private $customer_id = null;
    private $status = null;
    private $created_at = null;
    
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getRef_id()
    {
        return $this->ref_id;
    }

    /**
     * @return mixed
     */
    public function getAccount_number()
    {
        return $this->account_number;
    }

    /**
     * @return mixed
     */
    public function getAccount_type()
    {
        return $this->account_type;
    }

    /**
     * @return mixed
     */
    public function getAuth_code()
    {
        return $this->auth_code;
    }

    /**
     * @return mixed
     */
    public function getAvs_result_code()
    {
        return $this->avs_result_code;
    }

    /**
     * @return mixed
     */
    public function getCavv_result_code()
    {
        return $this->cavv_result_code;
    }

    /**
     * @return mixed
     */
    public function getCvv_result_code()
    {
        return $this->cvv_result_code;
    }

    /**
     * @return mixed
     */
    public function getRef_trans_id()
    {
        return $this->ref_trans_id;
    }

    /**
     * @return mixed
     */
    public function getResponse_code()
    {
        return $this->response_code;
    }

    /**
     * @return mixed
     */
    public function getTrans_id()
    {
        return $this->trans_id;
    }

    /**
     * @return mixed
     */
    public function getSale_id()
    {
        return $this->sale_id;
    }

    /**
     * @return mixed
     */
    public function getCustomer_id()
    {
        return $this->customer_id;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $ref_id
     */
    public function setRef_id($ref_id)
    {
        $this->ref_id = $ref_id;
    }

    /**
     * @param mixed $account_number
     */
    public function setAccount_number($account_number)
    {
        $this->account_number = $account_number;
    }

    /**
     * @param mixed $account_type
     */
    public function setAccount_type($account_type)
    {
        $this->account_type = $account_type;
    }

    /**
     * @param mixed $auth_code
     */
    public function setAuth_code($auth_code)
    {
        $this->auth_code = $auth_code;
    }

    /**
     * @param mixed $avs_result_code
     */
    public function setAvs_result_code($avs_result_code)
    {
        $this->avs_result_code = $avs_result_code;
    }

    /**
     * @param mixed $cavv_result_code
     */
    public function setCavv_result_code($cavv_result_code)
    {
        $this->cavv_result_code = $cavv_result_code;
    }

    /**
     * @param mixed $cvv_result_code
     */
    public function setCvv_result_code($cvv_result_code)
    {
        $this->cvv_result_code = $cvv_result_code;
    }

    /**
     * @param mixed $ref_trans_id
     */
    public function setRef_trans_id($ref_trans_id)
    {
        $this->ref_trans_id = $ref_trans_id;
    }

    /**
     * @param mixed $response_code
     */
    public function setResponse_code($response_code)
    {
        $this->response_code = $response_code;
    }

    /**
     * @param mixed $trans_id
     */
    public function setTrans_id($trans_id)
    {
        $this->trans_id = $trans_id;
    }

    /**
     * @param mixed $sale_id
     */
    public function setSale_id($sale_id)
    {
        $this->sale_id = $sale_id;
    }

    /**
     * @param mixed $customer_id
     */
    public function setCustomer_id($customer_id)
    {
        $this->customer_id = $customer_id;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;
    }

    
    
    
}

