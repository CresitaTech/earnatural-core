<?php

namespace App\Entities;
use App\Utils\Mapper;
use App\Entities\CreditCardType;
/**
 * Class representing PaymentType
 *
 * 
 * XSD Type: paymentType
 */
class PaymentType implements \JsonSerializable
{

    /**
     * @property \net\authorize\api\contract\v1\CreditCardType $creditCard
     */
    private $creditCard = null;

    /**
     * @property \net\authorize\api\contract\v1\BankAccountType $bankAccount
     */
    private $bankAccount = null;

    /**
     * @property \net\authorize\api\contract\v1\CreditCardTrackType $trackData
     */
    private $trackData = null;

    /**
     * @property \net\authorize\api\contract\v1\EncryptedTrackDataType
     * $encryptedTrackData
     */
    private $encryptedTrackData = null;

    /**
     * @property \net\authorize\api\contract\v1\PayPalType $payPal
     */
    private $payPal = null;

    /**
     * @property \net\authorize\api\contract\v1\OpaqueDataType $opaqueData
     */
    private $opaqueData = null;

    /**
     * @property \net\authorize\api\contract\v1\PaymentEmvType $emv
     */
    private $emv = null;

    /**
     * @property string $dataSource
     */
    private $dataSource = null;

    /**
     * Gets as creditCard
     *
     * @return \net\authorize\api\contract\v1\CreditCardType
     */
    public function getCreditCard()
    {
        return $this->creditCard;
    }

    /**
     * Sets a new creditCard
     *
     * @param \net\authorize\api\contract\v1\CreditCardType $creditCard
     * @return self
     */
    public function setCreditCard(CreditCardType $creditCard)
    {
        $this->creditCard = $creditCard;
        return $this;
    }

    /**
     * Gets as bankAccount
     *
     * @return \net\authorize\api\contract\v1\BankAccountType
     */
    public function getBankAccount()
    {
        return $this->bankAccount;
    }

    /**
     * Sets a new bankAccount
     *
     * @param \net\authorize\api\contract\v1\BankAccountType $bankAccount
     * @return self
     */
    public function setBankAccount(BankAccountType $bankAccount)
    {
        $this->bankAccount = $bankAccount;
        return $this;
    }

    /**
     * Gets as trackData
     *
     * @return \net\authorize\api\contract\v1\CreditCardTrackType
     */
    public function getTrackData()
    {
        return $this->trackData;
    }

    /**
     * Sets a new trackData
     *
     * @param \net\authorize\api\contract\v1\CreditCardTrackType $trackData
     * @return self
     */
    public function setTrackData(CreditCardTrackType $trackData)
    {
        $this->trackData = $trackData;
        return $this;
    }

    /**
     * Gets as encryptedTrackData
     *
     * @return \net\authorize\api\contract\v1\EncryptedTrackDataType
     */
    public function getEncryptedTrackData()
    {
        return $this->encryptedTrackData;
    }

    /**
     * Sets a new encryptedTrackData
     *
     * @param \net\authorize\api\contract\v1\EncryptedTrackDataType $encryptedTrackData
     * @return self
     */
    public function setEncryptedTrackData(EncryptedTrackDataType $encryptedTrackData)
    {
        $this->encryptedTrackData = $encryptedTrackData;
        return $this;
    }

    /**
     * Gets as payPal
     *
     * @return \net\authorize\api\contract\v1\PayPalType
     */
    public function getPayPal()
    {
        return $this->payPal;
    }

    /**
     * Sets a new payPal
     *
     * @param \net\authorize\api\contract\v1\PayPalType $payPal
     * @return self
     */
    public function setPayPal(PayPalType $payPal)
    {
        $this->payPal = $payPal;
        return $this;
    }

    /**
     * Gets as opaqueData
     *
     * @return \net\authorize\api\contract\v1\OpaqueDataType
     */
    public function getOpaqueData()
    {
        return $this->opaqueData;
    }

    /**
     * Sets a new opaqueData
     *
     * @param \net\authorize\api\contract\v1\OpaqueDataType $opaqueData
     * @return self
     */
    public function setOpaqueData(OpaqueDataType $opaqueData)
    {
        $this->opaqueData = $opaqueData;
        return $this;
    }

    /**
     * Gets as emv
     *
     * @return \net\authorize\api\contract\v1\PaymentEmvType
     */
    public function getEmv()
    {
        return $this->emv;
    }

    /**
     * Sets a new emv
     *
     * @param \net\authorize\api\contract\v1\PaymentEmvType $emv
     * @return self
     */
    public function setEmv(PaymentEmvType $emv)
    {
        $this->emv = $emv;
        return $this;
    }

    /**
     * Gets as dataSource
     *
     * @return string
     */
    public function getDataSource()
    {
        return $this->dataSource;
    }

    /**
     * Sets a new dataSource
     *
     * @param string $dataSource
     * @return self
     */
    public function setDataSource($dataSource)
    {
        $this->dataSource = $dataSource;
        return $this;
    }


    // Json Serialize Code
    public function jsonSerialize(){
        $values = array_filter((array)get_object_vars($this),
        function ($val){
            return !is_null($val);
        });
        $mapper = Mapper::Instance();
        foreach($values as $key => $value){
            $classDetails = $mapper->getClass(get_class() , $key);
            if (isset($value)){
                if ($classDetails->className === 'Date'){
                    $dateTime = $value->format('Y-m-d');
                    $values[$key] = $dateTime;
                }
                else if ($classDetails->className === 'DateTime'){
                    $dateTime = $value->format('Y-m-d\TH:i:s\Z');
                    $values[$key] = $dateTime;
                }
                if (is_array($value)){
                    if (!$classDetails->isInlineArray){
                        $subKey = $classDetails->arrayEntryname;
                        $subArray = [$subKey => $value];
                        $values[$key] = $subArray;
                    }
                }
            }
        }
        return $values;
    }
    
    // Json Set Code
    public function set($data)
    {
        if(is_array($data) || is_object($data)) {
			$mapper = Mapper::Instance();
			foreach($data AS $key => $value) {
				$classDetails = $mapper->getClass(get_class() , $key);
	 
				if($classDetails !== NULL ) {
					if ($classDetails->isArray) {
						if ($classDetails->isCustomDefined) {
							foreach($value AS $keyChild => $valueChild) {
								$type = new $classDetails->className;
								$type->set($valueChild);
								$this->{'addTo' . $key}($type);
							}
						}
						else if ($classDetails->className === 'DateTime' || $classDetails->className === 'Date' ) {
							foreach($value AS $keyChild => $valueChild) {
								$type = new \DateTime($valueChild);
								$this->{'addTo' . $key}($type);
							}
						}
						else {
							foreach($value AS $keyChild => $valueChild) {
								$this->{'addTo' . $key}($valueChild);
							}
						}
					}
					else {
						if ($classDetails->isCustomDefined){
							$type = new $classDetails->className;
							$type->set($value);
							$this->{'set' . $key}($type);
						}
						else if ($classDetails->className === 'DateTime' || $classDetails->className === 'Date' ) {
							$type = new \DateTime($value);
							$this->{'set' . $key}($type);
						}
						else {
							$this->{'set' . $key}($value);
						}
					}
				}
			}
		}
    }
    
}

