<?php
/**
 * Created by PhpStorm.
 * User: anderson
 * Date: 22/09/17
 * Time: 13:16
 */

namespace Girolando\CieloCheckout\Traits;


use Girolando\CieloCheckout\Services\CieloCheckout;

trait Processable
{
    protected $checkout;

    public function withCheckout(CieloCheckout $checkout)
    {
        $this->checkout = $checkout;
        return $this;
    }
}