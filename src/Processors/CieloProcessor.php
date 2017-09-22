<?php
/**
 * Created by PhpStorm.
 * User: anderson
 * Date: 22/09/17
 * Time: 10:23
 */

namespace Girolando\CieloCheckout\Processors;


use Girolando\CieloCheckout\Contracts\ProcessorContract;
use Girolando\CieloCheckout\Entities\Discount;
use Girolando\CieloCheckout\Entities\Settings;
use Girolando\CieloCheckout\Exceptions\CieloCheckoutException;
use Girolando\CieloCheckout\Services\CieloCheckout;
use GuzzleHttp\Client;

class CieloProcessor implements ProcessorContract
{
    const CIELO_ORDER_ENDPOINTURL   = 'https://cieloecommerce.cielo.com.br/api/public/v1/orders';

    protected static $merchantId;

    protected $checkout;

    public function __construct(CieloCheckout $checkout)
    {
        $this->checkout = $checkout;
    }

    public function execute()
    {
        //setting up the MaxInstallments:
        if(!$this->checkout->getOrder()->getPayment()->getMaxNumberOfInstallments()) {
            //I'll only do it if this property is not setted up.
            $discountValue = $this->checkout->getOrder()->getCart()->getDiscount()->getValue();
            $discountType = $this->checkout->getOrder()->getCart()->getDiscount()->getType();
            $fullValue = 0;
            foreach($this->checkout->getOrder()->getCart()->getItems() as $item) $fullValue += $item->getUnitPrice() * $item->getQuantity();
            $finalValue = $fullValue - $discountValue;
            if($discountType == Discount::DISCOUNTTYPE_PERCENT) {
                $finalValue = $fullValue - ($fullValue * ($discountValue / 100));
            }
            foreach($this->checkout->getInstallments() as $range) {
                if($range->isBetween($finalValue)) {
                    $this->checkout->getOrder()->getPayment()->setMaxNumberOfInstallments($range->getMaxInstallments());
                }
            }
        }

        $client = new Client();
        $response = $client->post(self::CIELO_ORDER_ENDPOINTURL, [
            'headers'   => [
                'Accept'        => $this->checkout->getOrder()->getContentType(),
                'Content-Type'  => $this->checkout->getOrder()->getContentType(),
                'MerchantId'    => self::$merchantId
            ],
            'body'      => $this->checkout->getOrder()->toJson(),
            'verify'    => false
        ]);
        $objResponse = json_decode($response->getBody()->getContents());
        if(!empty($objResponse->message)) throw new CieloCheckoutException($objResponse->message);
        $this->checkout->getOrder()->setSettings(
            (new Settings())
                ->setProfile($objResponse->settings->profile)
                ->setVersion($objResponse->settings->version)
                ->setCheckoutUrl($objResponse->settings->checkoutUrl)
        );
        return $this->checkout->getOrder()->getSettings()->getCheckoutUrl();
    }

    public static function setMerchantId($merchantId)
    {
        self::$merchantId = $merchantId;
    }

}