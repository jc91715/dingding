<?php namespace Jc91715\Dingding\Enterprise\H5\SmartWork;


use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{

    public function register(Container $app)
    {

        $app['smartwork'] = function ($app) {
            return new Client($app);
        };
    }
}