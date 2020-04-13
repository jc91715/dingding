<?php

include './vendor/autoload.php';

use Jc91715\Dingding\Enterprise\H5\Application;

$config = [
    'appkey' => '',
    'appsecret' => '',
    'debug' => true
];

$h5 = new Application($config);


//print_r($h5->access_token->getAccessToken());
//exit();
$h5->access_token->setAccessToken(['access_token' => '']);


//获取部门列表



$userIds=[];
$nextStart=0;
while (true){
    $res = $h5->smartwork->hrmEmployeeQueryonjob('2,3,5',$nextStart);
    $userIds = array_merge($userIds, $res['result']['data_list']);

    if(count($res['result']['data_list'])!=20){
        break;
    }
    $nextStart+=20;
    echo json_encode($userIds)."\n";


}


//exit();
//
//echo json_encode($userIds);
//exit();

$useridsChunk=array_chunk($userIds,20);
$users = [];

foreach ($useridsChunk as $useridChunk){
    $userid_list = implode(',', $useridChunk);

    $field_filter_list = 'sys00-name,sys00-email,sys02-birthTime,sys02-certNo';

    $response = $h5->smartwork->hrmEmployeeList($userid_list, $field_filter_list);
    print_r($response);
    foreach ($response['result'] as $item) {
        $user = [];
        $user['user_id'] = $item['userid'];
        foreach ($item['field_list'] as $field) {
            if ($field['field_code'] == 'sys00-name' && isset($field['value'])) {
                $user['name'] = $field['value'];
            }
            if ($field['field_code'] == 'sys00-email' && isset($field['value'])) {
                $user['email'] = $field['value'];
            }
            if ($field['field_code'] == 'sys02-birthTime' && isset($field['value'])) {
                $user['birthday'] = $field['value'];
            }
            if ($field['field_code'] == 'sys02-certNo' && isset($field['value'])) {
                $user['card'] = $field['value'];
            }
        }
        if (!isset($user['email'])) {
            $user['email'] = '';
        }
        if (!isset($user['name'])) {
            $user['name'] = '';
        }
        if (!isset($user['birthday'])) {
            $user['birthday'] = '';
        }
        if (!isset($user['card'])) {
            $user['card'] = '';
            $user['card_birthday'] = '';
        }else{
            $user['card_birthday'] = substr($user['card'],6,8);
        }
        $users[] = $user;
    }
}



print_r($users);
//file_put_contents('./user.txt',json_encode($users,JSON_UNESCAPED_UNICODE));
