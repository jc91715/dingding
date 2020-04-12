<?php namespace Jc91715\Dingding\Enterprise\H5;

use Hanson\Foundation\Foundation;
use Hanson\Foundation\Http;

class Application extends  Foundation
{

    protected $providers=[
        \Jc91715\Dingding\Kernel\ServiceProvider::class,
        \Jc91715\Dingding\Enterprise\H5\Auth\ServiceProvider::class,
        \Jc91715\Dingding\Enterprise\H5\User\ServiceProvider::class,
        \Jc91715\Dingding\Enterprise\H5\Department\ServiceProvider::class,
        \Jc91715\Dingding\Enterprise\H5\SmartWork\ServiceProvider::class,
    ];

    public function __construct($config)
    {
        parent::__construct($config);
    }

}
