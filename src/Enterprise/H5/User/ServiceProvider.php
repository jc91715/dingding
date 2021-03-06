<?php namespace Jc91715\Dingding\Enterprise\H5\User;


use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{

    public function register(Container $app)
    {

        $app['user'] = function ($app) {
            return new Client($app);
        };
    }
}