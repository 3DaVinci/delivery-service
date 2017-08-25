<?php
/**
 * Author: Andrey Morozov
 * Email: andrey@3davinci.ru
 * Company: http://3davinci.ru
 */

namespace Delivery\Service\Dpd;

abstract class IntegrationAreaAbstract
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * Geography constructor.
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }
}