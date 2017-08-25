<?php
/**
 * Author: Andrey Morozov
 * Email: andrey@3davinci.ru
 * Company: http://3davinci.ru
 */

namespace Delivery\Entity;

class City implements EntityInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $name;

    /**
     * City constructor.
     * @param $id
     * @param $name
     * @param string $code
     */
    public function __construct($id, $name, $code = null)
    {
        $this->id = (integer) $id;
        $this->name = (string) $name;
        if ($code) {
            $this->code = $code;
        }
    }

    /**
     * @return array
     */
    public function toArray() : array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code
        ];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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