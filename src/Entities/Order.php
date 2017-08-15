<?php
/**
 * Created by PhpStorm.
 * User: anderson
 * Date: 15/08/17
 * Time: 10:06
 */

namespace Girolando\CieloCheckout\Entities;


use Girolando\CieloCheckout\Contracts\JsonableContract;
use Girolando\CieloCheckout\Traits\Jsonable;

class Order implements JsonableContract
{
    use Jsonable;

    /** Identificador único da loja. Formato: 00000000-0000-0000-0000-000000000000
     * @var string
     */
    protected $MerchantId;


    /** Tipo do conteúdo da mensagem a ser enviada. Utilizar: “application/json”
     * @var string
     */
    protected $ContentType = "application/json";


    /**
     * Número do pedido da loja.Não enviar caracter especial
     * @optional
     * @var string
     */
    protected $OrderNumber;


    /** Texto para ser exibido na fatura do portador, após o nome do estabelecimento comercial.
     * @var string
     */
    protected $SoftDescriptor;


    /** Informações sobre o carrinho de compras.
     * @var Cart
     */
    protected $Cart;


    /** Informações sobre a entrega do pedido.
     * @var Shipping
     */
    protected $Shipping;


    /** Informações sobre o pagamento do pedido.
     * @var Payment
     */
    protected $Payment;


    /** Informações sobre dados pessoais do comprador.
     * @var Customer
     */
    protected $Customer;


    /** Informações sobre opções configuráveis do pedido.
     * @var Options
     */
    protected $Options;


    /** Informações da resposta sobre a criação do pedido.
     * @var Settings
     */
    protected $Settings;



    public function getMerchantId() {
        return $this->MerchantId;
    }
    public function setMerchantId($value) {
        $this->MerchantId = $value;
        return $this;
    }


    public function getOrderNumber() {
        return $this->OrderNumber;
    }
    public function setOrderNumber($value) {
        $this->OrderNumber = $value;
        return $this;
    }

    public function getSoftDescriptor() {
        return $this->SoftDescriptor;
    }
    public function setSoftDescriptor($value) {
        $this->SoftDescriptor = $value;
        return $this;
    }

    public function getCart() {
        return $this->Cart;
    }
    public function setCart(Cart $value) {
        $this->Cart = $value;
        return $this;
    }

    public function getShipping() {
        return $this->Shipping;
    }
    public function setShipping(Shipping $value) {
        $this->Shipping = $value;
        return $this;
    }

    public function getPayment() {
        return $this->Payment;
    }
    public function setPayment(Payment $value) {
        $this->Payment = $value;
        return $this;
    }

    public function getCustomer() {
        return $this->Customer;
    }
    public function setCustomer(Customer $value) {
        $this->Customer = $value;
        return $this;
    }

    public function getOptions() {
        return $this->Options;
    }
    public function setOptions(Options $value) {
        $this->Options = $value;
        return $this;
    }

    public function getSettings() {
        return $this->Settings;
    }
    public function setSettings(Settings $value) {
        $this->Settings = $value;
        return $this;
    }

    public function getContentType() {
        return $this->ContentType;
    }

    public function setContentType($type) {
        $this->ContentType = $type;
        return $this;
    }

}