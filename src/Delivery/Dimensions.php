<?php
/**
 * Author: Andrey Morozov
 * Email: andrey@3davinci.ru
 * Company: http://3davinci.ru
 */

namespace Delivery;

class Dimensions implements DimensionsInterface
{
    /**
     * @var float
     */
    protected $volume;

    /**
     * @var float
     */
    protected $weight;

    /**
     * @var float
     */
    protected $width;

    /**
     * @var float
     */
    protected $height;

    /**
     * @var float
     */
    protected $length;

    /**
     * @return float|null
     */
    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * @param float $volume
     */
    public function setVolume(float $volume)
    {
        $this->volume = $volume;
    }

    /**
     * @return float|null
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param float $weight
     */
    public function setWeight(float $weight)
    {
        $this->weight = $weight;
    }

    /**
     * @return float|null
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param float $width
     */
    public function setWidth(float $width)
    {
        $this->width = $width;
    }

    /**
     * @return float|null
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param float $height
     */
    public function setHeight(float $height)
    {
        $this->height = $height;
    }

    /**
     * @return float|null
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @param float $length
     */
    public function setLength(float $length)
    {
        $this->length = $length;
    }
}