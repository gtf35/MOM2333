<?php
//发送http头为json
header('Content-Type:text/json;charset=utf-8');

//建立短变量名
$mTimestamp = $_REQUEST['timestamp'];
//信息
$mInfo = $_REQUEST['info'];
//从时间戳提取年
$mYear = date("Y",$mTimestamp);
//从时间戳提取月
$mMonth = date("m",$mTimestamp);
//从时间戳提取日
$mDay = date("d",$mTimestamp);

// echo("YEAR:".date("Y",$mTimestamp))."   ";
// echo("MONTH:".date("m",$mTimestamp))."   ";
// echo("DAY:".date("d",$mTimestamp))."   ";
// echo("HOUR:".date("H",$mTimestamp))."   ";
// echo("MIN:".date("i",$mTimestamp))."   ";
// echo("INFO:".$mInfo."   ";

//链接数据库
include('connect.php');
//sql查询模板
$checkSql = "INSERT INTO `mom`.`GeographyInfo` (`year`, `month`, `day`, `timestamp`, `info`) VALUES (?, ?, ?, ?, ?)";
//数据库绑定sql语句
$result = $db->prepare($checkSql);
//绑定查询的变量，防止sql注入
$result -> bind_param('iiiis',$mYear, $mMonth, $mDay, $mTimestamp, $mInfo);
//获取查询是否成功
$isSuccess = $result -> execute();
if($isSuccess){
	//查询成功
	$code = 200;
	$msg = "成功";
	//返回结果
	returnMsg($code, $msg, "");
	//退出
	exit(0);
} else {
	//查询未成功
	$code = -2;
	$msg = "数据库查询失败";
	//返回结果
	returnMsg($code, $msg, "");
	//退出
	exit(0);
}