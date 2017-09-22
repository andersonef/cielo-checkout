<?php
/**
 * Created by PhpStorm.
 * User: anderson
 * Date: 22/09/17
 * Time: 10:31
 */

namespace Girolando\CieloCheckout\Processors;


use Girolando\CieloCheckout\Contracts\ProcessorContract;
use Girolando\CieloCheckout\Entities\Discount;
use Girolando\CieloCheckout\Exceptions\CieloCheckoutException;
use Girolando\CieloCheckout\Services\CieloCheckout;
use PayPal\Api\Item;
use PayPal\Api\ItemList;

class PaypalProcessor implements ProcessorContract
{
    protected static $returnUrl;
    protected static $cancelUrl;
    protected static $clientId = null;
    protected static $clientSecret = null;
    protected static $testMode = false;

    protected $checkout;

    public function __construct(CieloCheckout $checkout)
    {
        $this->checkout = $checkout;
    }

    public function execute()
    {
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(self::$clientId, self::$clientSecret)
        );
        if(self::$testMode) {
            $apiContext->setConfig([
                'mode' => "sandbox",
            ]);
        }

        $itemList = new \PayPal\Api\ItemList;
        $itens = $this->checkout->getOrder()->getCart()->getItems();
        $totalValue = 0;
        foreach($itens as $item) {
            $totalValue += ($item->getUnitPrice() / 100) * $item->getQuantity();
            $itemList->addItem(
                (new \PayPal\Api\Item)
                ->setName($item->getName())
                ->setCurrency('BRL')
                ->setQuantity($item->getQuantity())
                ->setPrice($item->getUnitPrice() / 100)
                ->setSku($item->getSku())
            );
        }

        //possui desconto?
        $discountValue = 0;
        if($discount = $this->checkout->getOrder()->getCart()->getDiscount()) {
            $discountValue = $discount->getValue();
            if($discount->getType() == Discount::DISCOUNTTYPE_PERCENT) {
                $discountValue = $totalValue - ($totalValue / ($discount->getValue() / 100));
            }
            $itemList->addItem((new Item())
                ->setName('Discount')
                ->setCurrency('BRL')
                ->setQuantity(1)
                ->setPrice($discountValue * -1)
                ->setSku('DESCONTO'));
        }


        //finalizando:
        $details = new \PayPal\Api\Details;
        $details
            ->setShipping(0)
            ->setSubtotal($totalValue);

        $amount = new \PayPal\Api\Amount;
        $amount->setCurrency('BRL')
            ->setTotal($totalValue - $discountValue)
            ->setDetails($details);

        $transaction = new \PayPal\Api\Transaction;
        $transaction
            ->setItemList($itemList)
            ->setAmount($amount)
            ->setSoftDescriptor($this->checkout->getOrder()->getSoftDescriptor())
            ->setInvoiceNumber($this->checkout->getOrder()->getOrderNumber());

        // links para redirecionamento
        $redirectUrls = new \PayPal\Api\RedirectUrls;
        $redirectUrls->setReturnUrl(self::$returnUrl)
            ->setCancelUrl(self::$cancelUrl);

        // sistema de pagamento: "paypal"
        $payer = new \PayPal\Api\Payer;
        $payer->setPaymentMethod("paypal");

// criando pagamento
        $payment = new \PayPal\Api\Payment;
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions([ $transaction ])
            ->setRedirectUrls($redirectUrls)
            ->setNoteToPayer("Contact us for any questions on your order.");

        try {
            $payment->create($apiContext);
            $this->checkout->getOrder()->setSettings((new Settings())
                ->setProfile('paypal')
                ->setVersion('2.0.1')
                ->setCheckoutUrl($payment->getApprovalLink())
            );

            return $payment->getApprovalLink();
        } catch (\Exception $e) {
            throw new CieloCheckoutException($e->getMessage());
        }

    }


    public static function setClientId($key)
    {
        self::$clientId = $key;
    }

    public static function setClientSecret($key)
    {
        self::$clientSecret = $key;
    }

    public static function setTestMode($testMode)
    {
        self::$testMode = $testMode;
    }

    public static function setReturnUrl($url)
    {
        self::$returnUrl = $url;
    }
    public static function setCancelUrl($url)
    {
        self::$cancelUrl = $url;
    }
}