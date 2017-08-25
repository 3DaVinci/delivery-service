<?php
/**
 * Author: Andrey Morozov
 * Email: andrey@3davinci.ru
 * Company: http://3davinci.ru
 */

namespace Delivery;

class CostData implements CostDataInterface
{
    /**
     * @var float
     */
    private $price;

    /**
     * @var integer
     */
    private $days;

    /**
     * CostData constructor.
     * @param float $price
     * @param int $days
     */
    public function __construct($price, $days = null)
    {
        $this->price = (float) $price;
        if ($days) {
            $this->days = (int) $days;
        }
    }

    /**
     * @return float
     */
    public function getPrice() : float
    {
        return $this->price;
    }

    /**
     * @return int|null
     */
    public function getDays()
    {
        return $this->days;
    }
}