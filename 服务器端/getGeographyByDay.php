<?php
//发送http头为json
header('Content-Type:text/json;charset=utf-8');

//建立短变量名
$mYear = $_REQUEST['year'];
$mMonth = $_REQUEST['month'];
$mDay = $_REQUEST['day'];

//链接数据库
include('connect.php');
//装载查询的结果
$resultArray = array();
//sql查询模板
$checkSql = "SELECT id, year, month, day, timestamp, info FROM `GeographyInfo` WHERE `year` = ? AND `month` = ? AND `day` = ?";
//数据库绑定sql语句
$result = $db->prepare($checkSql);
//绑定查询的变量，防止sql注入
$result -> bind_param('iii',$mYear, $mMonth, $mDay);
//绑定查询的结果
$result->bind_result($id, $year, $month, $day, $timestamp, $info);
//获取查询是否成功
$isSuccess = $result -> execute();
//对结果进行处理
if ($isSuccess){
	//标记是否查询到结果，查询到了就会置true
	$hasResult = false;
		//遍历查询结果
        while($result->fetch()){
			//查询到了数据
			$hasResult = true;
            //把结果装进数组
			$position = array(
				id => $id,
				year => $year,
				month => $month,
				day => $day,
				timestamp => $timestamp,
				info => $info
			);
			//把单次查询到的结果装入最终结果的数组
			array_push($resultArray, $position);
        }
		//判断标志位，看看有没有查询到结果
		if($hasResult == false){
			//没有查询到结果，返回值为 100
			$code = 100;
			$msg = "所查询的日期没有结果";
			//返回json
			returnMsg($code, $msg, "");
			//退出
			exit(0);
		} else {
			//查询到了结果，返回值200
			$code = 200;
			$msg = "查询成功";
			//返回json
			returnMsg($code, $msg, $resultArray);
			//退出
			exit(0);
		}
    } else {
		//查询未成功
		$code = -2;
		$msg = "数据库查询失败";
		//返回结果
		returnMsg($code, $msg, "");
		//退出
		exit(0);
	}

