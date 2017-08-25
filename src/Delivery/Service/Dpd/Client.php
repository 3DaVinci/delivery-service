<?php
/**
 * Author: Andrey Morozov
 * Email: andrey@3davinci.ru
 * Company: http://3davinci.ru
 */

namespace Delivery\Service\Dpd;

use Delivery\Exception\InvalidResponseException;

class Client implements ClientInterface
{
    /**
     * @var string
     */
    protected $clientNumber;

    /**
     * @var string
     */
    protected $clientKey;

    /**
     * @var bool
     */
    protected $testMode = false;

    /**
     * Client constructor.
     * @param string $clientNumber
     * @param string $clientKey
     * @param bool $testMode
     */
    public function __construct($clientNumber, $clientKey, $testMode = false)
    {
        $this->clientNumber = $clientNumber;
        $this->clientKey = $clientKey;
        $this->testMode = $testMode;
    }

    /**
     * @param string $service
     * @param string $method
     * @param array $parameters
     * @return array
     * @throws \Exception
     */
    public function sendRequest(string $service, string $method, array $parameters = [])
    {
        try {
            return (array) call_user_func([$this->getClient($service), $method], [
                'request' => array_merge($parameters, [
                    'auth' => [
                        'clientNumber' => $this->clientNumber,
                        'clientKey' => $this->clientKey,
                    ],
                ]),
            ]);
        } catch (\Exception $e) {
            //(mb_strpos($e->getMessage(), 'Превышен лимит', 0, 'UTF-8') === 0)
            throw new InvalidResponseException($e->getMessage());
        }
    }

    /**
     * @param $service
     *
     * @return SoapClient
     */
    private function getClient($service)
    {
        return new \SoapClient(sprintf(
            'http://ws%s.dpd.ru/services/%s?wsdl',
            $this->testMode ? 'test' : '', $service
        ));
    }
}