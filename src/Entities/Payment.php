<?php
/**
 * Created by PhpStorm.
 * User: anderson
 * Date: 15/08/17
 * Time: 11:56
 */

namespace Girolando\CieloCheckout\Entities;


use Girolando\CieloCheckout\Contracts\JsonableContract;
use Girolando\CieloCheckout\Traits\Jsonable;

class Payment implements JsonableContract
{
    use Jsonable;

    /** Desconto, em porcentagem, para pagamentos a serem realizados com boleto.
     * @var float
     */
    protected $BoletoDiscount;

    /** Desconto, em porcentagem, para pagamentos a serem realizados com débito online.
     * @var float
     */
    protected $DebitDiscount;

    /** Objeto necessário para pagamentos recorrentes
     * @var RecurrentPayment
     */
    protected $RecurrentPayment;


    public function getBoletoDiscount() {
        return $this->BoletoDiscount;
    }
    public function setBoletoDiscount($value) {
        $this->BoletoDiscount = $value;
        return $this;
    }

    public function getDebitDiscount() {
        return $this->DebitDiscount;
    }
    public function setDebitDiscount($value) {
        $this->DebitDiscount = $value;
        return $this;
    }

    public function getRecurrentPayment() {
        return $this->RecurrentPayment;
    }
    public function setRecurrentPayment($value) {
        $this->RecurrentPayment = $value;
        return $this;
    }



}