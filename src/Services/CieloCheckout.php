<?php
/**
 * Created by PhpStorm.
 * User: anderson
 * Date: 15/08/17
 * Time: 10:04
 */

namespace Girolando\CieloCheckout\Services;


use Girolando\CieloCheckout\Entities\Discount;
use Girolando\CieloCheckout\Entities\InstallmentRange;
use Girolando\CieloCheckout\Entities\Order;
use Girolando\CieloCheckout\Entities\Settings;
use Girolando\CieloCheckout\Exceptions\CieloCheckoutException;
use GuzzleHttp\Client;

class CieloCheckout
{
    const CIELO_ORDER_ENDPOINTURL = 'https://cieloecommerce.cielo.com.br/api/public/v1/orders';


    private $merchantId;

    protected $Order;

    protected $installmentRange = [];


    public function __construct($merchantId)
    {
        $this->merchantId = $merchantId;
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
    public function processCheckoutUrl()
    {
        //setting up the MaxInstallments:
        if(!$this->getOrder()->getPayment()->getMaxNumberOfInstallments()) {
            //I'll only do it if this property is not setted up.
            $discountValue = $this->getOrder()->getCart()->getDiscount()->getValue();
            $discountType = $this->getOrder()->getCart()->getDiscount()->getType();
            $fullValue = 0;
            foreach($this->getOrder()->getCart()->getItems() as $item) $fullValue += $item->getUnitPrice() * $item->getQuantity();
            $finalValue = $fullValue - $discountValue;
            if($discountType == Discount::DISCOUNTTYPE_PERCENT) {
                $finalValue = $fullValue - ($fullValue * ($discountValue / 100));
            }
            foreach($this->getInstallments() as $range) {
                if($range->isBetween($finalValue)) {
                    $this->getOrder()->getPayment()->setMaxNumberOfInstallments($range->getMaxInstallments());
                }
            }
        }

        $client = new Client();
        $response = $client->post(self::CIELO_ORDER_ENDPOINTURL, [
            'headers'   => [
                'Accept'        => $this->getOrder()->getContentType(),
                'Content-Type'  => $this->getOrder()->getContentType(),
                'MerchantId'    => $this->merchantId
            ],
            'body'      => $this->getOrder()->toJson(),
            'verify'    => false
        ]);
        $objResponse = json_decode($response->getBody()->getContents());
        if(!empty($objResponse->message)) throw new CieloCheckoutException($objResponse->message);
        $this->getOrder()->setSettings(
            (new Settings())
                ->setProfile($objResponse->settings->profile)
                ->setVersion($objResponse->settings->version)
                ->setCheckoutUrl($objResponse->settings->checkoutUrl)
        );
        return $this->getOrder()->getSettings()->getCheckoutUrl();
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

}