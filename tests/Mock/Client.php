<?php
/**
 * Author: Andrey Morozov
 * Email: andrey@3davinci.ru
 * Company: http://3davinci.ru
 */

namespace Delivery\Tests\Mock;

use Delivery\Service\Dpd\ClientInterface;

class Client implements ClientInterface
{
    /**
     * @param string $service
     * @param string $method
     * @param array $parameters
     * @return mixed
     */
    public function sendRequest(string $service, string $method, array $parameters = [])
    {
        switch ($method) {
            case 'getCitiesCashPay':
                $response = require(__DIR__ . '/locations.php');
                break;

            case 'getServiceCost2':
            case 'getServiceCostInternational':
                if (isset($parameters['serviceCode']) && $parameters['serviceCode']) {
                    $response = require(__DIR__ . '/cost_data_one_service.php');
                } else {
                    $response = require(__DIR__ . '/cost_data_many_service.php');
                }
                break;

            default:
                $response = null;
        }

        return $response;
    }
}