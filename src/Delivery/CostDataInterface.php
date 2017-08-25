<?php
/**
 * Author: Andrey Morozov
 * Email: andrey@3davinci.ru
 * Company: http://3davinci.ru
 */

namespace Delivery;

interface CostDataInterface
{
    /**
     * @return float
     */
    public function getPrice() : float;

    /**
     * @return int|null
     */
    public function getDays();
}