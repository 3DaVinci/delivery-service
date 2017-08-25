<?php
/**
 * Author: Andrey Morozov
 * Email: andrey@3davinci.ru
 * Company: http://3davinci.ru
 */

namespace Delivery\Exception;


class UnknownLocationException extends \Exception
{
    public function __construct($message = 'Invalid location', $code = 0, $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}