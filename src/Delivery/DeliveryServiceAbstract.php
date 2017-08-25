<?php
/**
 * Author: Andrey Morozov
 * Email: andrey@3davinci.ru
 * Company: http://3davinci.ru
 */

namespace Delivery;

use Symfony\Component\Cache\Simple\FilesystemCache;

abstract class DeliveryServiceAbstract
{
    /**
     * @var FilesystemCache
     */
    protected $cache;

    /**
     * @param int $lifetime
     * @param string|null $directory
     */
    public function initCache(int $lifetime = 0, string $directory = null)
    {
        $this->cache = new FilesystemCache('', $lifetime, $directory);
    }
}