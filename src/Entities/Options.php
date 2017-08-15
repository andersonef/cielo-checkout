<?php
/**
 * Created by PhpStorm.
 * User: anderson
 * Date: 15/08/17
 * Time: 12:01
 */

namespace Girolando\CieloCheckout\Entities;


use Girolando\CieloCheckout\Contracts\JsonableContract;
use Girolando\CieloCheckout\Traits\Jsonable;

class Options implements JsonableContract
{
    use Jsonable;

    protected $AntifraudEnabled = true;

    public function getAntifraudEnabled() {
        return $this->AntifraudEnabled;
    }
    public function setAntifraudEnabled($value) {
        $this->AntifraudEnabled = $value;
        return $this;
    }



}