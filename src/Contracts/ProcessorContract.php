<?php
/**
 * Created by PhpStorm.
 * User: anderson
 * Date: 22/09/17
 * Time: 10:22
 */

namespace Girolando\CieloCheckout\Contracts;


use Girolando\CieloCheckout\Services\CieloCheckout;

interface ProcessorContract
{
    public function withCheckout(CieloCheckout $checkout);
    public function execute();
}