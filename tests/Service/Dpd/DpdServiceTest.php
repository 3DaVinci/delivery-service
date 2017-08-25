<?php
/**
 * Author: Andrey Morozov
 * Email: andrey@3davinci.ru
 * Company: http://3davinci.ru
 */

namespace Delivery\Tests\Service\Dpd;

use Delivery\Tests\Mock\Client;
use PHPUnit\Framework\TestCase;
use Delivery\Service\Dpd\DpdService;
use Delivery\Entity\City;
use Delivery\Entity\Country;
use Delivery\{Location, Dimensions, Parameters};

class DpdServiceTest extends TestCase
{
    private $parametrs = [
        'clientNumber' => '111',
        'clientKey' => 'C80E',
        'testMode' => true,
    ];

    public function testConstructor()
    {
        $this->expectException(\InvalidArgumentException::class);
        new DpdService(['clientNumber' => '111']);

        $this->expectException(\InvalidArgumentException::class);
        new DpdService(['clientKey' => 'C80E']);

        // ok
        new DpdService($this->parametrs);
    }

    public function testGetLocations()
    {
        $mockClient = new Client();
        $dpdService = new DpdService($this->parametrs, $mockClient);

        /** @var \Delivery\Location $location */
        $location = $dpdService->getLocations()->current();
        $this->assertInstanceOf('\Delivery\Location', $location);
        $this->assertInstanceOf('\Delivery\Entity\City', $location->getCity());
        $this->assertInstanceOf('\Delivery\Entity\Region', $location->getRegion());
        $this->assertInstanceOf('\Delivery\Entity\Country', $location->getCountry());
    }

    public function testGetCostData()
    {
        $mockClient = new Client();
        $dpdService = new DpdService($this->parametrs, $mockClient);

        $locationFrom = new Location();
        $locationFrom->setCity(new City(49468352, 'Воронеж'));
        $locationFrom->setCountry(new Country('RU', 'Россия'));

        $locationTo = new Location();
        $locationTo->setCity(new City(49694102, 'Москва'));
        $locationTo->setCountry(new Country('RU', 'Россия'));

        $dimensions = new Dimensions();
        $dimensions->setVolume(0.05);
        $dimensions->setWeight(12);

        $parameters = new Parameters();
        $parameters->setSelfDelivery(true);
        $parameters->setSelfPickup(true);

        // Without serviceCode parameter
        /** @var \Delivery\CostData $costData */
        $costData = $dpdService->getCostData($locationFrom, $locationTo, $dimensions, $parameters);

        $this->assertInstanceOf('\Delivery\CostData', $costData);
        $this->assertTrue(is_float($costData->getPrice()));
        $this->assertTrue(is_integer($costData->getDays()));

        // With serviceCode parameter
        $parameters->setServiceCode('PCL');

        /** @var \Delivery\CostData $costData */
        $costData = $dpdService->getCostData($locationFrom, $locationTo, $dimensions, $parameters);
        $this->assertInstanceOf('\Delivery\CostData', $costData);
        $this->assertTrue(is_float($costData->getPrice()));
        $this->assertTrue(is_integer($costData->getDays()));
    }
}