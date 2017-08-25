<?php

$data1 = new stdClass();
$data1->serviceCode = 'MAX';
$data1->serviceName = 'DPD MAX domestic';
$data1->cost = 247.8;
$data1->days = 2;

$data2 = new stdClass();
$data2->serviceCode = 'CUR';
$data2->serviceName = 'DPD CLASSIC domestic';
$data2->cost = 1206.36;
$data2->days = 1;

$data3 = new stdClass();
$data3->serviceCode = 'PCL';
$data3->serviceName = 'DPD Online Classic';
$data3->cost = 454.3;
$data3->days = 1;

return [
    'return' => [$data1, $data2, $data3]
];
