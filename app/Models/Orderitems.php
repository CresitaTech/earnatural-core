<?php
namespace App\Models;
use CodeIgniter\Model;
use Michalsn\Uuid\UuidModel;

class Orderitems extends Model { #UuidModel

	protected $table      = 'orderitems';
    protected $primaryKey = 'id';
	protected $returnType     = 'array';
    # protected $returnType = \App\Entities\Orderitems::class;
    protected $allowedFields = [
        'id',
        'orderId',
        'productName', 
        'productDesc', 
        'quantity', 
        'unitPrice',
        'promocode'
    ];
    
    
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'createdAt';
    protected $updatedField  = 'updatedAt';
    protected $deletedField  = 'deletedAt';
    
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
    


}
