<?php
/**
 * Author: Andrey Morozov
 * Email: andrey@3davinci.ru
 * Company: http://3davinci.ru
 */

namespace Delivery\Service\Dpd;

class GeographyIntegration extends IntegrationAreaAbstract
{
    const SERVICE_NAME = 'geography2';

    /**
     * @return array
     */
    public function getCitiesCashPay() : array
    {
        $response = $this->client->sendRequest(self::SERVICE_NAME, 'getCitiesCashPay');

        return $response['return'] ?? [];
    }
}