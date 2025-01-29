<?php
namespace App\Models;
use CodeIgniter\Model;

class Order extends Model {

	protected $table      = 'orders';
    protected $primaryKey = 'id';
    protected $returnType     = 'array';
    
    # protected $returnType     = \App\Entities\Order::class;

    protected $allowedFields = [
        'id',
        'refId',
        'accountNumber',
        'accountType',
        'authCode',
        'avsResultCode',
        'cavvResultCode',
        'cvvResultCode',
        'refTransID',
        'responseCode',
        'transId',
        'saleId',
        'customerId',
        'status',
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