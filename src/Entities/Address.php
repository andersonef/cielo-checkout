<?php
/**
 * Created by PhpStorm.
 * User: anderson
 * Date: 15/08/17
 * Time: 11:50
 */

namespace Girolando\CieloCheckout\Entities;


use Girolando\CieloCheckout\Contracts\JsonableContract;
use Girolando\CieloCheckout\Traits\Jsonable;

class Address implements JsonableContract
{
    use Jsonable;

    /** Rua, avenida, travessa, etc, do endereço de entrega do comprador.
     * @var string
     */
    protected $Street;

    /** Número do endereço de entrega do comprador.
     * @var string
     */
    protected $Number;

    /* Complemento do endereço de entrega do comprador.
     * @optional
     * @var string
     */
    protected $Complement;

    /** Bairro do endereço de entrega do comprador.
     * @var string
     */
    protected $District;

    /** Cidade do endereço de entrega do comprador.
     * @var string
     */
    protected $City;

    /** Estado (UF) do endereço de entrega do comprador.
     * @var string
     */
    protected $State;



    public function getStreet() {
        return $this->Street;
    }
    public function setStreet($value) {
        $this->Street = $value;
        return $this;
    }

    public function getNumber() {
        return $this->Number;
    }
    public function setNumber($value) {
        $this->Number = $value;
        return $this;
    }

    public function getComplement() {
        return $this->Complement;
    }
    public function setComplement($value) {
        $this->Complement = $value;
        return $this;
    }

    public function getDistrict() {
        return $this->District;
    }
    public function setDistrict($value) {
        $this->District = $value;
        return $this;
    }

    public function getCity() {
        return $this->City;
    }
    public function setCity($value) {
        $this->City = $value;
        return $this;
    }

    public function getState() {
        return $this->State;
    }
    public function setState($value) {
        $this->State = $value;
        return $this;
    }


}