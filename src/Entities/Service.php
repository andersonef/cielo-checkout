<?php
/**
 * Created by PhpStorm.
 * User: anderson
 * Date: 15/08/17
 * Time: 11:53
 */

namespace Girolando\CieloCheckout\Entities;


use Girolando\CieloCheckout\Contracts\JsonableContract;
use Girolando\CieloCheckout\Traits\Jsonable;

class Service implements JsonableContract
{
    use Jsonable;
    /** Nome do serviço de frete.
     * @var string
     */
    protected $Name;


    /** Preço do serviço de frete (em centavos. Ex: R$ 1,00 = 100).
     * @var integer
     */
    protected $Price;


    /** Prazo de entrega (em dias).
     * @var integer
     */
    protected $Deadline;


    public function getName() {
        return $this->Name;
    }
    public function setName($value) {
        $this->Name = $value;
        return $this;
    }

    public function getPrice() {
        return $this->Price;
    }
    public function setPrice($value) {
        $this->Price = $value;
        return $this;
    }

    public function getDeadline() {
        return $this->Deadline;
    }
    public function setDeadline($value) {
        $this->Deadline = $value;
        return $this;
    }



}