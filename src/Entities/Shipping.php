<?php
/**
 * Created by PhpStorm.
 * User: anderson
 * Date: 15/08/17
 * Time: 11:39
 */

namespace Girolando\CieloCheckout\Entities;


use Girolando\CieloCheckout\Contracts\JsonableContract;
use Girolando\CieloCheckout\Traits\Jsonable;

class Shipping implements JsonableContract
{
    use Jsonable;

    const TYPE_CORREIOS                 = "Correios";
    const TYPE_FIXEDAMOUNT              = "FixedAmount";
    const TYPE_FREE                     = "Free";
    const TYPE_WITHOUTSHIPPINGPICKUP    = "WithoutShippingPickUp";
    const TYPE_WITHOUTSHIPPING          = "WithoutShipping";

    /** Tipo do frete: “Correios”, “FixedAmount”, “Free”, “WithoutShippingPickUp”, “WithoutShipping”.
     * @var string
     */
    protected $Type;

    /** CEP de origem do carrinho de compras.
     * @var integer
     */
    protected $SourceZipCode;

    /** CEP do endereço de entrega do comprador.
     * @var integer
     */
    protected $TargetZipCode;

    /** Informações sobre o endereço de entrega do comprador.
     * @var Address
     */
    protected $Address;

    /** Lista de serviços de frete.
     * @var Service[]
     */
    protected $Services = [];

    /** Informações para cálculo de frete volumétrico do carrinho.
     * @var Measures
     */
    protected $Measures;


    public function getType() {
        return $this->Type;
    }
    public function setType($value) {
        $this->Type = $value;
        return $this;
    }

    public function getSourceZipCode() {
        return $this->SourceZipCode;
    }
    public function setSourceZipCode($value) {
        $this->SourceZipCode = $value;
        return $this;
    }

    public function getTargetZipCode() {
        return $this->TargetZipCode;
    }
    public function setTargetZipCode($value) {
        $this->TargetZipCode = $value;
        return $this;
    }

    public function getAddress() {
        return $this->Address;
    }
    public function setAddress(Address $value) {
        $this->Address = $value;
        return $this;
    }

    public function getServices() {
        return $this->Services;
    }
    public function addServices(Service $value) {
        $this->Services[] = $value;
        return $this;
    }

    public function getMeasures() {
        return $this->Measures;
    }
    public function setMeasures(Measures $value) {
        $this->Measures = $value;
        return $this;
    }



}