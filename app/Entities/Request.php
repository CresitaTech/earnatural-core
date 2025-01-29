<?php

namespace App\Entities;
use CodeIgniter\Entity;
/**
 * Class representing Customer
 *
 *
 * XSD Type: Customer
 */
class Request extends Entity
{
    private $id = null;
    private $cardHolderName = null;
    private $cardNumber = null;
    private $cvv = null;
    private $expiryDate = null;
    
    private $email = null;
    private $address1 = null;
    private $address2 = null;
    private $city = null;
    private $state = null;
    private $zip = null;
    
    private $shippingAddress1 = null;
    private $shippingAddress2 = null;
    private $shippingCity = null;
    private $shippingState = null;
    private $shippingZip = null;
    
    private $promocode = null;
    private $productName = null;
    private $productDesc = null;
    private $quantity = null;
    private $unitPrice = null;
    private $optradio = null;
    
    private $createdAt = null;
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
    public function getCardHolderName()
    {
        return $this->cardHolderName;
    }

    /**
     * @return mixed
     */
    public function getCardNumber()
    {
        return $this->cardNumber;
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
    public function getExpiryDate()
    {
        return $this->expiryDate;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * @return mixed
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @return mixed
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @return mixed
     */
    public function getShippingAddress1()
    {
        return $this->shippingAddress1;
    }

    /**
     * @return mixed
     */
    public function getShippingAddress2()
    {
        return $this->shippingAddress2;
    }

    /**
     * @return mixed
     */
    public function getShippingCity()
    {
        return $this->shippingCity;
    }

    /**
     * @return mixed
     */
    public function getShippingState()
    {
        return $this->shippingState;
    }

    /**
     * @return mixed
     */
    public function getShippingZip()
    {
        return $this->shippingZip;
    }

    /**
     * @return mixed
     */
    public function getPromocode()
    {
        return $this->promocode;
    }

    /**
     * @return mixed
     */
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * @return mixed
     */
    public function getProductDesc()
    {
        return $this->productDesc;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @return mixed
     */
    public function getUnitPrice()
    {
        return $this->unitPrice;
    }

    /**
     * @return mixed
     */
    public function getOptradio()
    {
        return $this->optradio;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $cardHolderName
     */
    public function setCardHolderName($cardHolderName)
    {
        $this->cardHolderName = $cardHolderName;
    }

    /**
     * @param mixed $cardNumber
     */
    public function setCardNumber($cardNumber)
    {
        $this->cardNumber = $cardNumber;
    }

    /**
     * @param mixed $cvv
     */
    public function setCvv($cvv)
    {
        $this->cvv = $cvv;
    }

    /**
     * @param mixed $expiryDate
     */
    public function setExpiryDate($expiryDate)
    {
        $this->expiryDate = $expiryDate;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param mixed $address1
     */
    public function setAddress1($address1)
    {
        $this->address1 = $address1;
    }

    /**
     * @param mixed $address2
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @param mixed $zip
     */
    public function setZip($zip)
    {
        $this->zip = $zip;
    }

    /**
     * @param mixed $shippingAddress1
     */
    public function setShippingAddress1($shippingAddress1)
    {
        $this->shippingAddress1 = $shippingAddress1;
    }

    /**
     * @param mixed $shippingAddress2
     */
    public function setShippingAddress2($shippingAddress2)
    {
        $this->shippingAddress2 = $shippingAddress2;
    }

    /**
     * @param mixed $shippingCity
     */
    public function setShippingCity($shippingCity)
    {
        $this->shippingCity = $shippingCity;
    }

    /**
     * @param mixed $shippingState
     */
    public function setShippingState($shippingState)
    {
        $this->shippingState = $shippingState;
    }

    /**
     * @param mixed $shippingZip
     */
    public function setShippingZip($shippingZip)
    {
        $this->shippingZip = $shippingZip;
    }

    /**
     * @param mixed $promocode
     */
    public function setPromocode($promocode)
    {
        $this->promocode = $promocode;
    }

    /**
     * @param mixed $productName
     */
    public function setProductName($productName)
    {
        $this->productName = $productName;
    }

    /**
     * @param mixed $productDesc
     */
    public function setProductDesc($productDesc)
    {
        $this->productDesc = $productDesc;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @param mixed $unitPrice
     */
    public function setUnitPrice($unitPrice)
    {
        $this->unitPrice = $unitPrice;
    }

    /**
     * @param mixed $optradio
     */
    public function setOptradio($optradio)
    {
        $this->optradio = $optradio;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    
    
    
    
    
}

