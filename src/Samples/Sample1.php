<?php
/**
 * Created by PhpStorm.
 * User: anderson
 * Date: 15/08/17
 * Time: 13:53
 */

namespace Girolando\CieloCheckout\Samples;


use Girolando\CieloCheckout\Entities\Discount;
use Girolando\CieloCheckout\Services\CieloCheckout;
use Girolando\CieloCheckout\Entities\Cart;
use Girolando\CieloCheckout\Entities\Customer;
use Girolando\CieloCheckout\Entities\Item;
use Girolando\CieloCheckout\Entities\Options;
use Girolando\CieloCheckout\Entities\Payment;
use Girolando\CieloCheckout\Entities\Shipping;
use Girolando\CieloCheckout\Entities\InstallmentRange;

class Sample1
{
    public static function main()
    {
        $checkout = new CieloCheckout('edfd4486-6257-4152-8442-7f4786212c3d');

        $checkout->setupInstallments([
            (new InstallmentRange())->setBetween(0, 200)->setMaxInstallments(2),
            (new InstallmentRange())->setBetween(201, 600)->setMaxInstallments(3),
            (new InstallmentRange())->setBetween(601, InstallmentRange::MAX_VALUE)->setMaxInstallments(5),
        ]);

        //Setting up the customer:
        $checkout
            ->newOrder()


            ->setCustomer((new Customer())
                ->setEmail('anderson.nuneseth@gmail.com')
                ->setFullName('Anderson Nunes da Silva')
                ->setIdentity('11111111111')
                ->setPhone('34991289656')
            )

            ->setShipping((new Shipping())
                ->setType(Shipping::TYPE_WITHOUTSHIPPING)
            )

            ->setPayment((new Payment())
                ->setBoletoDiscount(0)
                ->setDebitDiscount(0)
                ->setMaxNumberOfInstallments(5)     //It will override the default value from installments table.
            )

            ->setOptions((new Options())
                ->setAntifraudEnabled(true)
            )

            ->setOrderNumber('65065456406545')

            ->setSoftDescriptor('GIRHOL')

            ->setCart(
                (new Cart())
                ->insertDiscount(Discount::DISCOUNTTYPE_AMOUNT, 20)
                ->addItem(
                    (new Item())
                    ->setType(Item::TYPE_SERVICE)
                    ->setName('Registro Definitivo Fêmea')
                    ->setUnitPrice(35)
                    ->setSku('RGDGC-FEMEA')
                    ->setQuantity(100)
                )

                ->addItem(
                    (new Item())
                    ->setType(Item::TYPE_SERVICE)
                    ->setQuantity(100)
                    ->setUnitPrice(48)
                    ->setName('Registro de Nascimento')
                    ->setSku('RGN')
                )
            );


        //If you wanna save it in the database before generate the checkout url, the time is now.

        $checkout->setCurrentGateway(CieloCheckout::GATEWAY_PAYPAL);

        $checkoutUrl = $checkout->processCheckoutUrl();
        die('url: ' . $checkoutUrl . ' - ' . $checkout->getOrder()->getSettings()->getCheckoutUrl());

        //Update the information on the database right now
        die('Location: ' . $checkoutUrl);
    }
}