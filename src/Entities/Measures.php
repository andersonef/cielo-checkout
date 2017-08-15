<?php
/**
 * Created by PhpStorm.
 * User: anderson
 * Date: 15/08/17
 * Time: 11:55
 */

namespace Girolando\CieloCheckout\Entities;


use Girolando\CieloCheckout\Contracts\JsonableContract;
use Girolando\CieloCheckout\Traits\Jsonable;

class Measures implements JsonableContract
{
    use Jsonable;


    protected $Package;

    protected $Lenght;

    protected $Height;

    protected $Width;

    protected $Diameter;



    public function getPackage() {
        return $this->Package;
    }
    public function setPackage($value) {
        $this->Package = $value;
        return $this;
    }

    public function getLenght() {
        return $this->Lenght;
    }
    public function setLenght($value) {
        $this->Lenght = $value;
        return $this;
    }

    public function getHeight() {
        return $this->Height;
    }
    public function setHeight($value) {
        $this->Height = $value;
        return $this;
    }

    public function getWidth() {
        return $this->Width;
    }
    public function setWidth($value) {
        $this->Width = $value;
        return $this;
    }

    public function getDiameter() {
        return $this->Diameter;
    }
    public function setDiameter($value) {
        $this->Diameter = $value;
        return $this;
    }



}