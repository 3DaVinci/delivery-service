<?php
/**
 * Author: Andrey Morozov
 * Email: andrey@3davinci.ru
 * Company: http://3davinci.ru
 */

namespace Delivery\Service\Dpd;

use Delivery\DimensionsInterface;
use Delivery\ParametersInterface;
use Delivery\Location;

class CostCalculationIntegration extends IntegrationAreaAbstract
{
    const SERVICE_NAME = 'calculator2';

    /**
     * @param Location $locationFrom
     * @param Location $locationTo
     * @param DimensionsInterface $dimensions
     * @param ParametersInterface $parameters
     * @return array
     */
    public function getServiceCost(
        Location $locationFrom,
        Location $locationTo,
        DimensionsInterface $dimensions,
        ParametersInterface $parameters
    ) : array
    {
        if ($locationFrom->getCountry() != $locationTo->getCountry()) {
            // International
            $method = 'getServiceCostInternational';
        } else {
            // Russia
            $method = 'getServiceCost2';
        }

        $response = $this->client->sendRequest(self::SERVICE_NAME, $method, [
            'pickup' => [
                'cityId' => $locationFrom->getCity()->getId(),
            ],
            'delivery' => [
                'cityId' => $locationTo->getCity()->getId(),
            ],

            'weight' => $dimensions->getWeight(),
            'volume' => $dimensions->getVolume(),

            'selfPickup' => $parameters->isSelfPickup(),
            'selfDelivery' => $parameters->isSelfDelivery(),
            'serviceCode' => $parameters->getServiceCode(),
        ]);

        if (!isset($response['return'])) {

            return [];
        }

        return (is_array($response['return'])) ? $response['return'] : [$response['return']];
    }
}