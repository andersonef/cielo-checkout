<?php
/**
 * Created by PhpStorm.
 * User: anderson
 * Date: 15/08/17
 * Time: 10:38
 */

namespace Girolando\CieloCheckout\Contracts;


interface JsonableContract
{
    public function toPlainObject();

    public function toJson();
}