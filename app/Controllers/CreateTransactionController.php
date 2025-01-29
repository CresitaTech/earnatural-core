<?php
namespace App\Controllers;

use App\Entities\AnetApiRequestType;
use App\Controllers\base\ApiOperationBase;

use net\authorize\api\controller as AnetController;


class CreateTransactionController extends ApiOperationBase
{
    public function __construct(AnetApiRequestType $request)
    {
        $responseType = 'App\Entities\CreateTransactionResponse';
        parent::__construct($request, $responseType);
    }

    protected function validateRequest()
    {
        //validate required fields of $this->apiRequest->
        //validate non-required fields of $this->apiRequest->
    }
}