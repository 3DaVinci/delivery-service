<?php
/**
 * Author: Andrey Morozov
 * Email: andrey@3davinci.ru
 * Company: http://3davinci.ru
 */

namespace Delivery\Tests;

use PHPUnit\Framework\TestCase;
use Delivery\Factory;

class FactoryTest extends TestCase
{
    private $parametrs = [
        'clientNumber' => '111',
        'clientKey' => 'C80E',
        'testMode' => true,
    ];

    public function testCreateDeliveryDpdSuccess()
    {
        $factory = new Factory();

        $delivery = $factory->createDelivery(
            Factory::DPD_SERVICE,
            $this->parametrs
        );

        $this->assertInstanceOf('\Delivery\Service\Dpd\DpdService', $delivery);
    }

    public function testCreateDeliveryDpdError()
    {
        $factory = new Factory();

        $this->expectException(\InvalidArgumentException::class);

        $delivery = $factory->createDelivery(
            'non-existent_service',
            $this->parametrs
        );
    }
}