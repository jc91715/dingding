<?php


namespace Jc91715\Dingding\Enterprise\H5\Department;

use Hanson\Foundation\AbstractAPI;
use Pimple\Container;
use Jc91715\Dingding\Kernel\Exceptions\HttpException;

class Client
{

    protected $app;
    protected $baseUri = 'https://oapi.dingtalk.com/';


    public function __construct(Container $app)
    {
        $this->app = $app;
    }


    public function list()
    {
        $response = $this->app['http']->get($this->baseUri.'department/list', [
            'access_token' => $this->app['access_token']->getAccessToken()['access_token'],
        ]);

        $data = json_decode(strval($response->getBody()), true);

        if($data['errcode']){
            throw new HttpException($data['errmsg']);
        }
        return $data;
    }








}