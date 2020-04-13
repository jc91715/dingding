<?php


namespace Jc91715\Dingding\Enterprise\H5\SmartWork;

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


    public function hrmEmployeeQueryonjob($status_list='',$offset=0,$size=20)
    {
        $params=[
            'status_list'=>$status_list,
            'offset'=>$offset,
            'size'=>$size
        ];
        $response = $this->app['http']->post($this->baseUri.'topapi/smartwork/hrm/employee/queryonjob?access_token='.$this->app['access_token']->getAccessToken()['access_token'],$params) ;

        $data = json_decode(strval($response->getBody()), true);

        if($data['errcode']){
            throw new HttpException($data['errmsg']);
        }
        return $data;
    }


    public function hrmEmployeeList($userid_list='',$field_filter_list='',$agentid='')
    {
        $params=[
            'userid_list'=>$userid_list,
            'field_filter_list'=>$field_filter_list,
        ];
        if($agentid){
            $params['agentid']=$agentid;
        }

        $response = $this->app['http']->post($this->baseUri.'topapi/smartwork/hrm/employee/list?access_token='.$this->app['access_token']->getAccessToken()['access_token'],$params) ;

        $data = json_decode(strval($response->getBody()), true);

        if($data['errcode']){
            throw new HttpException($data['errmsg']);
        }
        return $data;
    }








}