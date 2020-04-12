<?php


namespace Jc91715\Dingding\Enterprise\H5\User;

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


    public function getDeptMember($department_id)
    {
        $response = $this->app['http']->get($this->baseUri.'user/getDeptMember', [
            'access_token' => $this->app['access_token']->getAccessToken()['access_token'],
            'deptId'=>$department_id
        ]);

        $data = json_decode(strval($response->getBody()), true);

        if($data['errcode']){
            throw new HttpException($data['errmsg']);
        }
        return $data;
    }








}