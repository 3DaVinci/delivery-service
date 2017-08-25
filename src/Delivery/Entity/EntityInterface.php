<?php
/**
 * Author: Andrey Morozov
 * Email: andrey@3davinci.ru
 * Company: http://3davinci.ru
 */

namespace Delivery\Entity;

interface EntityInterface
{
    public function toArray() : array;
}