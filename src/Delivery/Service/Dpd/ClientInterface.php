<?php
/**
 * Author: Andrey Morozov
 * Email: andrey@3davinci.ru
 * Company: http://3davinci.ru
 */

namespace Delivery\Service\Dpd;

interface ClientInterface
{
    /**
     * @param string $service
     * @param string $method
     * @param array $parameters
     * @return mixed
     */
    public function sendRequest(string $service, string $method, array $parameters = []);
}