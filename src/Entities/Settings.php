<?php
/**
 * Created by PhpStorm.
 * User: anderson
 * Date: 15/08/17
 * Time: 12:02
 */

namespace Girolando\CieloCheckout\Entities;


use Girolando\CieloCheckout\Contracts\JsonableContract;
use Girolando\CieloCheckout\Traits\Jsonable;

class Settings implements JsonableContract
{
    use Jsonable;

    /** URL de checkout do pedido. Formato: https://cieloecommerce.cielo.com.br/transacional/order/index?id={id}
     * @var string
     */
    protected $CheckoutUrl;

    /** Perfil do lojista: fixo “CheckoutCielo”.
     * @var string
     */
    protected $Profile;

    /** Versão do serviço de criação de pedido (versão: 1).
     * @var string
     */
    protected $Version;



    public function getCheckoutUrl() {
        return $this->CheckoutUrl;
    }
    public function setCheckoutUrl($value) {
        $this->CheckoutUrl = $value;
        return $this;
    }

    public function getProfile() {
        return $this->Profile;
    }
    public function setProfile($value) {
        $this->Profile = $value;
        return $this;
    }

    public function getVersion() {
        return $this->Version;
    }
    public function setVersion($value) {
        $this->Version = $value;
        return $this;
    }


}