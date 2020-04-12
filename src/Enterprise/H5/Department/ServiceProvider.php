<?php namespace Jc91715\Dingding\Enterprise\H5\Department;


use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{

    public function register(Container $app)
    {

        $app['department'] = function ($app) {
            return new Client($app);
        };
    }
}