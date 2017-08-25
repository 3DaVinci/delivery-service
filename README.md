# Библиотека для расчета стоимости доставки груза

[![Build Status](https://api.travis-ci.org/3DaVinci/delivery-service.png?branch=master)](https://travis-ci.org/3DaVinci/delivery-service)

## Возможности

* Получение списка локаций, в которые возможна отправка груза.
* Расчет стоимости отправки и количества дней для двух локаций.

Пока используется только одна служба экспресс-доставки - DPD. [Интеграция по API.](hhttp://www.dpd.ru/dpd/integration/integration.do2)

## Установка

Добавить в composer.json репозиторий и зависимость:

```json
	"repositories": [
        {
            "type": "git",
            "url": "https://github.com/3davinci/delivery-service",
            "branch": "master"
        }
    ],
    ...
    "require": {
        ...
        "3davinci/delivery-service": "0.1.0"
    }
```

Выполнить
```
    $ curl -s http://getcomposer.org/installer | php
    $ php composer.phar update
```

## Пример использования

```php
<?php

use Delivery\Entity\City;
use Delivery\Entity\Country;
use Delivery\{Factory, Location, Dimensions, Parameters};


$factory = new Factory();

$delivery = $factory->createDelivery(
    Factory::DPD_SERVICE,
    [
        'clientNumber' => 'Your client number',
        'clientKey' => 'Your client key'
    ]
);
```

```php
// Использование кеширования на 1 час
$delivery->initCache(3600);

// Получение списка локаций
/** @var \Delivery\Location $location */
foreach ($delivery->getLocations() as $location) {
    
}
```

```php
/**
 * Получение стоимости и количества дней доставки груза 
 * весом 12 кг, обёмом 0.05 м.кв. 
 * из Москвы в Иркутск (услуга PCL)
 */
// Данные об отправлении
$locationFrom = new Location();
$locationFrom->setCity(new City(49694102, 'Москва'));
$locationFrom->setCountry(new Country('RU', 'Россия'));
```

```php
// Данные о месте доставки
$locationTo = new Location();
$locationTo->setCity(new City(49572207, 'Иркутск'));
$locationTo->setCountry(new Country('RU', 'Россия'));
```

```php
// Габаритные размеры груза и вес
$dimensions = new Dimensions();
$dimensions->setVolume(0.05);
$dimensions->setWeight(12);
```

```php
// Дополнительные параметры
$parameters = new Parameters();
$parameters->setSelfDelivery(true);
$parameters->setSelfPickup(true);
$parameters->setServiceCode('PCL');
```

```php
$costData = $delivery->getCostData($locationFrom, $locationTo, $dimensions, $parameters);
$costData->getPrice(); // Стоимость доставки
$costData->getDays(); // Количество дней

```
