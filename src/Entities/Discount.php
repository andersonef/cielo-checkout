<?php
/**
 * Created by PhpStorm.
 * User: anderson
 * Date: 15/08/17
 * Time: 10:21
 */

namespace Girolando\CieloCheckout\Entities;


use Girolando\CieloCheckout\Contracts\JsonableContract;
use Girolando\CieloCheckout\Traits\Jsonable;

class Discount implements JsonableContract
{
    use Jsonable;


    const DISCOUNTTYPE_AMOUNT = "Amount";
    const DISCOUNTTYPE_PERCENT = "Percent";

    protected $Type;
    protected $Value;

    public function setType($type) { $this->Type = $type; return $this; }
    public function setValue($value) { $this->Value = $value; return $this; }
    public function getType() { return $this->Type; }
    public function getValue() { return $this->Value; }


}