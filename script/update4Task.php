<?php
/**
 * Created by PhpStorm.
 * User: JuL
 * Date: 7/13/2018
 * Time: 9:05 AM
 */

require_once '../functions/atsDbConnect.php';
require_once '../ats_config.inc.php';

$handler = opendir(ATS_FINISH_PATH);

$filename = isset($_GET['filename']) ? $_GET['filename'] : '';
$taskId = isset($_GET['taskId']) ? $_GET['taskId'] : '';

$pdoc = getPDOConnect();

$sql4UpdateTask = "UPDATE `ats_testtask_info` SET `TestResult`=?, `TestResultPath`=?," .
    " `TestEndTime`=?, `TaskStatus`=? WHERE `TaskID`=?";
$file = fopen(ATS_FINISH_PATH . $filename, 'r');
$tmpArray = array();

while ($data = fgetcsv($file, 0, '=')) {

    if ('TestResult' == $data[0]) {
        $tmpArray['TestResult'] = $data[1];
    } else if ('TestResultPath' == $data[0]) {
        $tmpArray['TestResultPath'] = $data[1];
    } else if ('TestEndTime' == $data[0]) {
        $tmpArray['TestEndTime'] = $data[1];
    } else if ('TaskStatus' == $data[0]) {
        $tmpArray['TaskStatus'] = $data[1];
    }

}
fclose($file);

if (!empty($tmpArray)) {
    $stmt = $pdoc->prepare($sql4UpdateTask);
    $stmt->bindParam(1, $tmpArray['TestResult'], PDO::PARAM_STR);
    $stmt->bindParam(2, $tmpArray['TestResultPath'], PDO::PARAM_STR);
    $stmt->bindParam(3, $tmpArray['TestEndTime'], PDO::PARAM_STR);
    $stmt->bindParam(4, $tmpArray['TaskStatus'], PDO::PARAM_STR);
    $stmt->bindParam(5, $taskId, PDO::PARAM_INT);

    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo date("Y-m-d H:i:s", time()) . ' : ' . $filename . ' [ updated success ] taskDB result --> ' . $stmt->rowCount() . PHP_EOL;
    } else {
        echo date("Y-m-d H:i:s", time()) . ' : ' . $filename . ' [ updated fail ] taskDB result --> ' . $stmt->rowCount() . PHP_EOL;
    }

}
//关闭连接
$pdoc = null;