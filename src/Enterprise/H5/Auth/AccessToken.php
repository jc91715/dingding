<?php


namespace Jc91715\Dingding\Enterprise\H5\Auth;

use Pimple\Container;

class AccessToken
{
    protected $app;
    protected $accessToken;

    protected $baseUri = 'https://oapi.dingtalk.com/';

    public function __construct(Container $app)
    {
        $this->app = $app;
    }

    public function getAccessToken($refresh=false)
    {
        if($this->accessToken&&!$refresh){
            return $this->accessToken;
        }
        $response = $this->app['http']->get($this->baseUri.'gettoken', [
            'appkey' => $this->app->getConfig('appkey'),
            'appsecret' => $this->app->getConfig('appsecret')
        ]);
        $data=json_decode(strval($response->getBody()), true);
        $this->setAccessToken($data);
        return $data;
    }

    /**
     * [access_token/expires_in]
     * @param $accessToken
     */

    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }


}