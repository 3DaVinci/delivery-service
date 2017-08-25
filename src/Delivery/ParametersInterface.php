<?php
/**
 * Author: Andrey Morozov
 * Email: andrey@3davinci.ru
 * Company: http://3davinci.ru
 */

namespace Delivery;

interface ParametersInterface
{
    /**
     * @return boolean
     */
    public function isSelfPickup();

    /**
     * @return boolean
     */
    public function isSelfDelivery();

    /**
     * @return string
     */
    public function getServiceCode(): string;
}