<?php

$loc1 = new stdClass();
$loc1->cityId = 9113480088;
$loc1->countryCode = 'RU';
$loc1->countryName = 'Россия';
$loc1->regionCode = 91;
$loc1->regionName = 'Крым';
$loc1->cityCode = 91007000054;
$loc1->cityName = 'Семеновка';
$loc1->abbreviation = 'с';
$loc1->indexMin = 298213;
$loc1->indexMax = 298213;

$loc2 = new stdClass();
$loc2->cityId = 9090290671;
$loc2->countryCode = 'RU';
$loc2->countryName = 'Россия';
$loc2->regionCode = 47;
$loc2->regionName = 'Ленинградская';
$loc2->cityCode = 47012000361;
$loc2->cityName = 'Виллозское Сельское Поселение';
$loc2->abbreviation = 'п';

return [
    'return' => [$loc1, $loc2]
];