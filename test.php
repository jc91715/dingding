<?php

include './vendor/autoload.php';

use Jc91715\Dingding\Enterprise\H5\Application;

$config = [
    'appkey' => '',
    'appsecret' => '',
    'debug' => true
];

$h5 = new Application($config);


print_r($h5->access_token->getAccessToken());
//exit();
//$h5->access_token->setAccessToken(['access_token' => '']);


//获取部门列表
$data = $h5->department->list();

//file_put_contents('./depart.txt',json_encode($data,JSON_UNESCAPED_UNICODE));
//print_r($data);
//exit();

$userIds=[];
foreach ($data['department'] as $dept) {
    $deptMembers = $h5->user->getDeptMember($dept['id']);
    $userIds = array_merge($userIds, $deptMembers['userIds']);
    echo json_encode($userIds)."\n";

}
//
//echo json_encode($userIds);
//exit();

$useridsChunk=array_chunk($userIds,20);
$users = [];

foreach ($useridsChunk as $useridChunk){
    $userid_list = implode(',', $useridChunk);

    $field_filter_list = 'sys00-name,sys02-birthTime,sys00-email';

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
        $users[] = $user;
    }
}



print_r($users);
//file_put_contents('./user.txt',json_encode($users,JSON_UNESCAPED_UNICODE));
