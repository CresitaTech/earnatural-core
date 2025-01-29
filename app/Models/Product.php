<?php
namespace App\Models;
use CodeIgniter\Model;

class Product extends Model {

	protected $table      = 'product';
    protected $primaryKey = 'id';
	
	protected $returnType     = 'array';

    protected $allowedFields = ['name', 'description', 'quantity', 'unitPrice', 'subtotal', 'created_at', 'updated_at'];

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
	

    

}