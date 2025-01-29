<?php
namespace App\Models;
use CodeIgniter\Model;
use Michalsn\Uuid\UuidModel;

class Customer extends Model { #UuidModel

	protected $table      = 'customers';
    protected $primaryKey = 'id';
	protected $returnType     = 'array';
    # protected $returnType = \App\Entities\Customer::class;
    protected $allowedFields = [
        'id',
        'cardHolderName', 
        'phoneNumber', 
        'email', 
        'address1',
        'address2',
        'city',
        'state',
        'zip',
        'shippingAddress1',
        'shippingAddress2',
        'shippingCity',
        'shippingState',
        'shippingZip'
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
