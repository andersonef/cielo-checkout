<?php
/**
 * Created by PhpStorm.
 * User: anderson
 * Date: 15/08/17
 * Time: 12:00
 */

namespace Girolando\CieloCheckout\Entities;


use Girolando\CieloCheckout\Contracts\JsonableContract;
use Girolando\CieloCheckout\Traits\Jsonable;

class Customer implements JsonableContract
{
    use Jsonable;

    protected $Identity;

    protected $FullName;

    protected $Email;

    protected $Phone;


    public function getIdentity() {
        return $this->Identity;
    }
    public function setIdentity($value) {
        $this->Identity = $value;
        return $this;
    }

    public function getFullName() {
        return $this->FullName;
    }
    public function setFullName($value) {
        $this->FullName = $value;
        return $this;
    }

    public function getEmail() {
        return $this->Email;
    }
    public function setEmail($value) {
        $this->Email = $value;
        return $this;
    }

    public function getPhone() {
        return $this->Phone;
    }
    public function setPhone($value) {
        $this->Phone = $value;
        return $this;
    }


}