<?php
/**
 * Author: Andrey Morozov
 * Email: andrey@3davinci.ru
 * Company: http://3davinci.ru
 */

namespace Delivery\Tests;

use PHPUnit\Framework\TestCase;
use Delivery\CostData;

class CostDataTest extends TestCase
{
    public function testConstructor()
    {
        $price = 25.8;
        $days = 10;
        $costData = new CostData($price, $days);

        $this->assertEquals($price, $costData->getPrice());
        $this->assertEquals($days, $costData->getDays());

        $costData = new CostData($price);
        $this->assertNull($costData->getDays());
    }
}