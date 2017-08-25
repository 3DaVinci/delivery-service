<?php
/**
 * Author: Andrey Morozov
 * Email: andrey@3davinci.ru
 * Company: http://3davinci.ru
 */

namespace Delivery;

interface LocationInterface
{
    /**
     * @return int|string
     */
    public function getCountry();

    /**
     * @return int|string
     */
    public function getRegion();

    /**
     * @return int|string
     */
    public function getCity();

    /**
     * @return int|string
     */
    public function getAddress();
}