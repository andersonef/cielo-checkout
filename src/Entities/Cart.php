<?php
/**
 * Created by PhpStorm.
 * User: anderson
 * Date: 15/08/17
 * Time: 10:13
 */

namespace Girolando\CieloCheckout\Entities;


use Girolando\CieloCheckout\Contracts\JsonableContract;
use Girolando\CieloCheckout\Traits\Jsonable;

class Cart implements JsonableContract
{
    use Jsonable;
    /** Informações do desconto sobre o carrinho de compras.
     * @var Discount
     */
    protected $Discount;


    /** Lista de itens do carrinho de compras (deve conter no mínimo 1 item).
     * @var Item[]
     */
    protected $Items = [];


    public function getDiscount() { return $this->Discount; }

    public function getItems() { return $this->Items; }

    public function addDiscount(Discount $discount)
    {
        $this->Discount = $discount;
        return $this;
    }

    public function insertDiscount($discountType, $discountValue)
    {
        $discount = new Discount();
        $discount->setType($discountType);
        $discount->setValue($discountValue);
        $this->Discount = $discount;
        return $this;
    }

    public function addItem(Item $item)
    {
        $this->Items[] = $item;
        return $this;
    }
}