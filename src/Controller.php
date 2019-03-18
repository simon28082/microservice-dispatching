<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2019-03-18 22:51
 *
 * @link http://crcms.cn/
 *
 * @copyright Copyright &copy; 2019 Rights Reserved CRCMS
 */

namespace CrCms\Microservice\Dispatching;

use CrCms\Foundation\Helpers\InstanceConcern;
use InvalidArgumentException;

abstract class Controller
{
    use InstanceConcern {
        InstanceConcern::__get as __instanceGet;
    }

    /**
     * @return ResponseFactory
     */
    protected function response(): ResponseFactory
    {
        return $this->app->make(ResponseFactory::class);
    }

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function __get(string $name)
    {
        if ($name === 'response') {
            return $this->response();
        }

        if ((bool)$instance = $this->__instanceGet($name)) {
            return $instance;
        }

        throw new InvalidArgumentException("Property not found [{$name}]");
    }
}