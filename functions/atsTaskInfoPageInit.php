<?php
/**
 * Created by PhpStorm.
 * User: refar
 * Date: 18-6-24
 * Time: 上午8:06
 */

session_start();
require_once 'atsDbConnect.php';

$user = isset($_SESSION['transToAts']) ? $_SESSION['transToAts'] : '';

$conn = getDbConnect();
$sql = "select t1.login, t1.email, t2.description from users t1 left join roles t2 on t1.role_id = t2.id where t1.login='{$user}'; ";
$resultDetail = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($resultDetail);
$searchCondition = "";

// show some rights when search
if ('admin' == $row['description'] || 'leader' == $row['description'] || 'group leader' == $row['description'] || 'manager' == $row['description']) {
	$searchCondition = "";
} else {
	$searchCondition = "where Tester='{$user}'";
}


$pageSize = isset($_GET['pageSize']) ? $_GET['pageSize'] : 10;
$pageNo = isset($_GET['pageNumber']) ? $_GET['pageNumber'] : 1;
$taskIdSingle = isset($_GET['taskId']) ? $_GET['taskId'] : '';
$offset = ($pageNo-1)*$pageSize;

//$pageSize = 10;
//$pageNo = 2;

$conn = getDbConnect();

// ------------------get_ats_testtask_info_Count & Info-------

$tableHeader = "TaskID, TestMachine, TestImage, MachineID, ".
    "TestItem,  TaskStatus, TestStartTime, TestEndTime, TestResult, ".
    "TestResultPath, ShelfID, SwitchId, Tester ";

if (!empty($taskIdSingle)) {
    $taskIdSingle = trim($taskIdSingle);
    $sqlCount = "select count(*) from ats_testtask_info where TaskID = $taskIdSingle";
    $sqlDetail = "select $tableHeader from ats_testtask_info where TaskID = $taskIdSingle";

} else {
    $sqlCount = "select count(*) from ats_testtask_info where Tester='{$user}'";
//    $sqlDetail = "select $tableHeader from ats_testtask_info where  TaskID >= (select TaskID from ats_testtask_info order by TaskID limit $offset, 1) limit $pageSize ";
    $sqlDetail = "select $tableHeader from ats_testtask_info where Tester='{$user}' order by TaskID desc limit $offset, $pageSize;";
}
$resultCount = mysqli_query($conn,$sqlCount);
$total = mysqli_fetch_array($resultCount)[0];

// echo $sqlDetail;

$rowsResult = array();
$resultDetail = mysqli_query($conn,$sqlDetail);
while($row = $resultDetail->fetch_assoc()){
    array_push($rowsResult, $row);
}

$jsonResult['total'] = $total;
$jsonResult['rows'] = $rowsResult;

// ------------------get_ats_testtask_info_Count  & Info -------

echo json_encode($jsonResult);

$conn->close();
