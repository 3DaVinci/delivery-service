<?php
/**
 * Author: Andrey Morozov
 * Email: andrey@3davinci.ru
 * Company: http://3davinci.ru
 */

namespace Delivery;

interface DeliveryServiceInterface
{
    /**
     * @return string
     */
    public function getName() : string;

    /**
     * @param int $lifetime
     * @param string|null $directory
     */
    public function initCache(int $lifetime = 0, string $directory = null);

    /**
     * @return \Traversable
     */
    public function getLocations() : \Traversable;

    /**
     * Calculation of the cost of delivery
     *
     * @param Location $locationFrom
     * @param Location $locationTo
     * @param DimensionsInterface $dimensions
     * @param ParametersInterface $parameters
     * @return CostData
     */
    public function getCostData(
        Location $locationFrom,
        Location $locationTo,
        DimensionsInterface $dimensions,
        ParametersInterface $parameters
    ) : CostData;

}