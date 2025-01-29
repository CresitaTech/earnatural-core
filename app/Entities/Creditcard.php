<?php

namespace App\Entities;
use CodeIgniter\Entity;
/**
 * Class representing Customer
 *
 *
 * XSD Type: Customer
 */
class Creditcard extends Entity
{
    private $id = null;
    private $customer_id = null;
    private $card_number = null;
    private $card_holder_name = null;
    private $cvv = null;
    private $expiry_date = null;
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
    public function getCustomer_id()
    {
        return $this->customer_id;
    }

    /**
     * @return mixed
     */
    public function getCard_number()
    {
        return $this->card_number;
    }

    /**
     * @return mixed
     */
    public function getCard_holder_name()
    {
        return $this->card_holder_name;
    }

    /**
     * @return mixed
     */
    public function getCvv()
    {
        return $this->cvv;
    }

    /**
     * @return mixed
     */
    public function getExpiry_date()
    {
        return $this->expiry_date;
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
     * @param mixed $customer_id
     */
    public function setCustomer_id($customer_id)
    {
        $this->customer_id = $customer_id;
    }

    /**
     * @param mixed $card_number
     */
    public function setCard_number($card_number)
    {
        $this->card_number = $card_number;
    }

    /**
     * @param mixed $card_holder_name
     */
    public function setCard_holder_name($card_holder_name)
    {
        $this->card_holder_name = $card_holder_name;
    }

    /**
     * @param mixed $cvv
     */
    public function setCvv($cvv)
    {
        $this->cvv = $cvv;
    }

    /**
     * @param mixed $expiry_date
     */
    public function setExpiry_date($expiry_date)
    {
        $this->expiry_date = $expiry_date;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;
    }

    
    
    
    
}

