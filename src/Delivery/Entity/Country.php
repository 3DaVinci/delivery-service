<?php
/**
 * Author: Andrey Morozov
 * Email: andrey@3davinci.ru
 * Company: http://3davinci.ru
 */

namespace Delivery\Entity;

class Country implements EntityInterface
{
    private $code;
    private $name;

    public function __construct($code, $name)
    {
        $this->code = (string) $code;
        $this->name = (string) $name;
    }

    /**
     * @return array
     */
    public function toArray() : array
    {
        return [
            'code' => $this->code,
            'name' => $this->name,
        ];
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}