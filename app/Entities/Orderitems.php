<?php

namespace App\Entities;
use CodeIgniter\Entity;
/**
 * Class representing Customer
 *
 *
 * XSD Type: Customer
 */
class Orderitems extends Entity
{
    private $id = null;
    private $order_id = null;
    private $product_name = null;
    private $product_desc = null;
    private $quantity = null;
    private $unitPrice = null;
    private $promocode = null;
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
    public function getOrder_id()
    {
        return $this->order_id;
    }

    /**
     * @return mixed
     */
    public function getProduct_name()
    {
        return $this->product_name;
    }

    /**
     * @return mixed
     */
    public function getProduct_desc()
    {
        return $this->product_desc;
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
    public function getPromocode()
    {
        return $this->promocode;
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
     * @param mixed $order_id
     */
    public function setOrder_id($order_id)
    {
        $this->order_id = $order_id;
    }

    /**
     * @param mixed $product_name
     */
    public function setProduct_name($product_name)
    {
        $this->product_name = $product_name;
    }

    /**
     * @param mixed $product_desc
     */
    public function setProduct_desc($product_desc)
    {
        $this->product_desc = $product_desc;
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
     * @param mixed $promocode
     */
    public function setPromocode($promocode)
    {
        $this->promocode = $promocode;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;
    }

    
    
    
}

