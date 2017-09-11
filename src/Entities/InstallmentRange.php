<?php
/**
 * Created by PhpStorm.
 * User: anderson
 * Date: 11/09/17
 * Time: 13:57
 */

namespace Girolando\CieloCheckout\Entities;


use Girolando\CieloCheckout\Contracts\JsonableContract;
use Girolando\CieloCheckout\Traits\Jsonable;

class InstallmentRange implements JsonableContract
{
    use Jsonable;
    const MAX_VALUE = 999999999.99;

    protected $minInstallmentValue = 0;

    protected $maxInstallmentValue = self::MAX_VALUE;

    protected $maxInstallments = 1;


    /** Configura valor mínimo e máximo para a atual faixa de parcelamento.
     * @param $minValue
     * @param $maxValue
     * @return $this
     */
    public function setBetween($minValue, $maxValue)
    {
        $this->minInstallmentValue = $minValue;
        $this->maxInstallmentValue = $maxValue;
        return $this;
    }


    public function isBetween($value)
    {
        if($value >= $this->minInstallmentValue && $value <= $this->maxInstallmentValue) return true;
        return false;
    }




    public function getMinInstallmentValue() {
        return $this->minInstallmentValue;
    }
    public function setMinInstallmentValue($value) {
        $this->minInstallmentValue = $value;
        return $this;
    }

    public function getMaxInstallmentValue() {
        return $this->maxInstallmentValue;
    }
    public function setMaxInstallmentValue($value) {
        $this->maxInstallmentValue = $value;
        return $this;
    }

    public function getMaxInstallments() {
        return $this->maxInstallments;
    }

    /** Seta o número máximo de parcelas para a faixa atual de parcelamento.
     * @param $maxInstallments
     * @return $this
     */
    public function setMaxInstallments($maxInstallments)
    {
        $this->maxInstallments = $maxInstallments;
        return $this;
    }


}