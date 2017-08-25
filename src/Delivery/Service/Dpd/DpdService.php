<?php
/**
 * Author: Andrey Morozov
 * Email: andrey@3davinci.ru
 * Company: http://3davinci.ru
 */

namespace Delivery\Service\Dpd;

use Delivery\CostData;
use Delivery\DeliveryServiceAbstract;
use Delivery\DimensionsInterface;
use Delivery\Entity\ {City, Country, Region};
use Delivery\DeliveryServiceInterface;
use Delivery\Exception\InvalidResponseException;
use Delivery\Location;
use Delivery\ParametersInterface;

class DpdService extends DeliveryServiceAbstract implements DeliveryServiceInterface
{
    /**
     * @var GeographyIntegration
     */
    private $geography;

    /**
     * @var CostCalculationIntegration
     */
    private $costCalculation;

    /**
     * DpdService constructor.
     * DpdService constructor.
     * @param array $parameters
     * @param ClientInterface $client
     */
    public function __construct(array $parameters, ClientInterface $client = null)
    {
        if (!$client) {
            if (!isset($parameters['clientNumber']) || !isset($parameters['clientKey'])) {
                throw new \InvalidArgumentException('The "clientNumber" and "clientKey" parameter is required');
            }

            $testMode = (isset($parameters['testMode']) && true === $parameters['testMode']);
            $client = new Client($parameters['clientNumber'], $parameters['clientKey'], $testMode);
        }

        $this->geography = new GeographyIntegration($client);
        $this->costCalculation = new CostCalculationIntegration($client);
    }

    /**
     * Get all locations for countryCode = RU
     *
     * @return \Traversable
     */
    public function getLocations() : \Traversable
    {
        $cacheKey = 'dpd_locations';
        if ($this->cache) {
            if ($this->cache->has($cacheKey)) {
                /** @var Location $location */
                foreach ($this->cache->get($cacheKey) as $location) {
                    yield $location;
                }

                return;
            }
        }

        $data = $this->geography->getCitiesCashPay();
        $locationProto = new Location();
        $locations = [];
        foreach ($data as $item) {
            array_push($locations, $this->createLocation((array) $item, clone $locationProto));
        }

        if ($this->cache) {
            $this->cache->set($cacheKey, $locations);
        }

        foreach ($locations as $location) {
            yield $location;
        }
    }

    /**
     * Calculation of the cost of delivery
     *
     * @param Location $locationFrom
     * @param Location $locationTo
     * @param DimensionsInterface $dimensions
     * @param ParametersInterface $parameters
     * @return CostData
     * @throws InvalidResponseException
     */
    public function getCostData(
        Location $locationFrom,
        Location $locationTo,
        DimensionsInterface $dimensions,
        ParametersInterface $parameters
    ) : CostData
    {
        $cityFrom = $locationFrom->getCity();
        if (null === $cityFrom || !$cityFrom->getId()) {
            throw new UnknownLocationException('Invalid departure location');
        }
        $cityTo = $locationFrom->getCity();
        if (null === $cityTo || !$cityTo->getId()) {
            throw new UnknownLocationException('Invalid delivery location');
        }

        $arrayResponse = $this->costCalculation->getServiceCost($locationFrom, $locationTo, $dimensions, $parameters);

        if (empty($arrayResponse)) {
            throw new InvalidResponseException();
        }

        $data = (array) array_shift($arrayResponse);

        return new CostData($data['cost'], $data['days']);
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return 'Служба экспресс-доставки DPD';
    }

    /**
     * @param array $data
     * @param Location $locationProto
     * @return Location
     */
    private function createLocation(array $data, Location $locationProto) : Location
    {
        $locationProto->setCity(new City($data['cityId'], $data['cityName'], $data['cityCode']));
        $locationProto->setCountry(new Country($data['countryCode'], $data['countryName']));
        $locationProto->setRegion(new Region($data['regionCode'], $data['regionName']));

        return $locationProto;
    }
}