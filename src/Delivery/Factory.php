<?php
/**
 * Author: Andrey Morozov
 * Email: andrey@3davinci.ru
 */

namespace Delivery;

use Delivery\DeliveryServiceInterface;

class Factory
{
    const DPD_SERVICE = 'dpd';

    /**
     * @var array
     */
    private $serviceList;

    public function __construct()
    {
        $this->serviceList = [
            self::DPD_SERVICE => '\Delivery\Service\Dpd\DpdService',
        ];
    }

    /**
     * Creates a delivery
     *
     * @param string $service a known service name
     * @param array connection parameters
     *
     * @return DeliveryServiceInterface a new instance of DeliveryServiceInterface
     * @throws \InvalidArgumentException
     */
    public function createDelivery($service, array $parameters)
    {
        if (!array_key_exists($service, $this->serviceList)) {
            throw new \InvalidArgumentException("$service is not valid service");
        }
        $className = $this->serviceList[$service];

        return new $className($parameters);
    }
}