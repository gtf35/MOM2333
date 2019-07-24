<?php
$server="localhost";//主机
//$server = "ecs.gtf35.top";//主机
$db_username = "momUser";//数据库用户名
$db_password = "gtf0305gtf";//数据库密码
$db_name = "mom";

//实例化mysqli类并连接数据库
$db = new mysqli($server, $db_username,$db_password,$db_name);
//数据库连接有效性检查
if (mysqli_connect_errno()) {
    //如果连接失败就显示错误信息
    $code = -1;
    $msg = "服务端数据库连接失败";
	returnMsg($code, $msg, '');
    exit(0);
}

function returnMsg($code, $msg, $data){
	$json = array(
            code => $code,
            msg => $msg,
            data=>$data
        );
    $jsonencode = json_encode($json, JSON_UNESCAPED_UNICODE);
    echo $jsonencode;
}

?>