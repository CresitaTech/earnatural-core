<?php
namespace App\Models;
use CodeIgniter\Model;
use Michalsn\Uuid\UuidModel;

class Creditcard extends Model { #UuidModel

	protected $table      = 'creditcards';
    protected $primaryKey = 'id';
	protected $returnType     = 'array';
    # protected $returnType = \App\Entities\Creditcard::class;
    protected $allowedFields = [
        'id',
        'customerId',
        'cardNumber', 
        'cardHolderName', 
        'cvv', 
        'expiryDate'
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
