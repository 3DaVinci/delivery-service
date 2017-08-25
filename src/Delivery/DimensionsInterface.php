<?php
/**
 * Author: Andrey Morozov
 * Email: andrey@3davinci.ru
 * Company: http://3davinci.ru
 */

namespace Delivery;

interface DimensionsInterface
{
    /**
     * @return float|null
     */
    public function getLength();

    /**
     * @return float|null
     */
    public function getHeight();

    /**
     * @return float|null
     */
    public function getWidth();

    /**
     * @return float|null
     */
    public function getWeight();

    /**
     * @return float|null
     */
    public function getVolume();
}