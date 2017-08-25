<?php
/**
 * Author: Andrey Morozov
 * Email: andrey@3davinci.ru
 * Company: http://3davinci.ru
 */

namespace Delivery;

class Parameters implements ParametersInterface
{
    /**
     * @var bool
     */
    protected $selfPickup = false;

    /**
     * @var bool
     */
    protected $selfDelivery = true;

    /**
     * @var string
     */
    protected $serviceCode = '';

    /**
     * @return string
     */
    public function getServiceCode(): string
    {
        return $this->serviceCode;
    }

    /**
     * @param string $serviceCode
     */
    public function setServiceCode(string $serviceCode)
    {
        $this->serviceCode = $serviceCode;
    }

    /**
     * @return bool
     */
    public function isSelfPickup(): bool
    {
        return $this->selfPickup;
    }

    /**
     * @param bool $selfPickup
     */
    public function setSelfPickup(bool $selfPickup)
    {
        $this->selfPickup = $selfPickup;
    }

    /**
     * @return bool
     */
    public function isSelfDelivery(): bool
    {
        return $this->selfDelivery;
    }

    /**
     * @param bool $selfDelivery
     */
    public function setSelfDelivery(bool $selfDelivery)
    {
        $this->selfDelivery = $selfDelivery;
    }
}