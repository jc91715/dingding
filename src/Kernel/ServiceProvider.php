<?php namespace Jc91715\Dingding\Kernel;


use Pimple\Container;
use Pimple\ServiceProviderInterface;
//use Hanson\Foundation\Http;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
         $app['http'] = function ($app) {
            return new Http($app);
         };
    }



}