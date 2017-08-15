<?php
/**
 * Created by PhpStorm.
 * User: anderson
 * Date: 15/08/17
 * Time: 10:50
 */

namespace Girolando\CieloCheckout\Entities;


use Girolando\CieloCheckout\Contracts\JsonableContract;
use Girolando\CieloCheckout\Traits\Jsonable;

class Item implements JsonableContract
{
    use Jsonable;

    const TYPE_ASSET = 'Asset';
    const TYPE_DIGITAL = 'Digital';
    const TYPE_SERVICE = 'Service';
    const TYPE_PAYMENT = 'Payment';

    /** Nome do item no carrinho.
     * @var string
     */
    protected $Name;


    /**
     * Descrição do item no carrinho.
     * @optional
     * @var string
     */
    protected $Description;


    /**
     * Preço unitário do item no carrinho (em centavos.* Ex: R$ 1,00 = 100)*.
     * @var int
     */
    protected $UnitPrice;


    /**
     * Quantidade do item no carrinho.
     * @var float
     */
    protected $Quantity;


    /** Tipo do item no carrinho.
     *  Valores possíveis:
     *  Asset - Material Físico
     *  Digital - Produtos Digitais
     *  Service - Serviços
     *  Payment - Outros pagamentos
     * @var string
     */
    protected $Type;


    /** Sku do ítem no carrinho
     * @var string
     */
    protected $Sku;


    /** Peso em gramas do produto no carrinho.
     * @var int
     */
    protected $Weight;


    public function getName() {
        return $this->Name;
    }
    public function setName($value) {
        $this->Name = $value;
        return $this;
    }

    public function getDescription() {
        return $this->Description;
    }
    public function setDescription($value) {
        $this->Description = $value;
        return $this;
    }

    public function getUnitPrice() {
        return $this->UnitPrice;
    }
    public function setUnitPrice($value) {
        $this->UnitPrice = $value;
        return $this;
    }

    public function getQuantity() {
        return $this->Quantity;
    }
    public function setQuantity($value) {
        $this->Quantity = $value;
        return $this;
    }

    public function getType() {
        return $this->Type;
    }
    public function setType($value) {
        $this->Type = $value;
        return $this;
    }

    public function getSku() {
        return $this->Sku;
    }
    public function setSku($value) {
        $this->Sku = $value;
        return $this;
    }

    public function getWeight() {
        return $this->Weight;
    }
    public function setWeight($value) {
        $this->Weight = $value;
        return $this;
    }

}
?>
