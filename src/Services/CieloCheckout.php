<?php
/**
 * Created by PhpStorm.
 * User: anderson
 * Date: 15/08/17
 * Time: 10:04
 */

namespace Girolando\CieloCheckout\Services;


use Girolando\CieloCheckout\Contracts\ProcessorContract;
use Girolando\CieloCheckout\Entities\Discount;
use Girolando\CieloCheckout\Entities\InstallmentRange;
use Girolando\CieloCheckout\Entities\Order;
use Girolando\CieloCheckout\Entities\Settings;
use Girolando\CieloCheckout\Exceptions\CieloCheckoutException;
use Girolando\CieloCheckout\Exceptions\InvalidGatewayException;
use Girolando\CieloCheckout\Processors\CieloProcessor;
use Girolando\CieloCheckout\Processors\PaypalProcessor;
use GuzzleHttp\Client;

class CieloCheckout
{
    private $merchantId;

    protected $Order;

    protected $installmentRange = [];


    /**
     * CieloCheckout constructor.
     * Parametro depreciado e opcional. Se for utilizar cielo, informe a merchantId diretamente pelo processor, da seguinte forma:
     * CieloProcessor::setMerchantId($merchantid);
     *
     * @param @deprecated null $merchantId
     */
    public function __construct($merchantId = null)
    {
        $this->merchantId = $merchantId;
        if($merchantId)
            CieloProcessor::setMerchantId($merchantId);
    }




    /** Creates a new order using the merchantId
     * @return Order
     */
    public function newOrder()
    {
        $order = new Order();
        $order->setMerchantId($this->merchantId);
        $this->setOrder($order);
        return $order;
    }

    /** Returns the order this checkout is mounting.
     * @return Order
     */
    public function getOrder() {
        return $this->Order;
    }
    public function setOrder($value) {
        $this->Order = $value;
        return $this;
    }

    /**
     * Process the order and returns the checkoutUrl
     */
    public function processCheckoutUrl(ProcessorContract $processor)
    {
        return $processor->withCheckout($this)->execute();
    }


    /**
     * @param array $range
     * @return $this
     */
    public function setupInstallments(array $range)
    {
        foreach($range as $obj) if(!($obj instanceof InstallmentRange)) throw new \InvalidArgumentException('This method requires an InstallmentRange array');
        $this->installmentRange = $range;
        return $this;
    }

    /**
     * @return array InstallmentRange
     */
    public function getInstallments()
    {
        return $this->installmentRange;
    }

    public function getMerchantId()
    {
        return $this->merchantId;
    }

}