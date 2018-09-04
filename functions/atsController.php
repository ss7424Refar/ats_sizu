<?php
/**
 * Created by PhpStorm.
 * User: refar
 * Date: 18-6-25
 * Time: 上午9:44
 */
session_start();

require_once 'atsTestTask.class.php';
$action=isset($_GET['do']) ? $_GET['do'] : '';
$user = isset($_SESSION['user']) ? $_SESSION['user'] : '';

// handler
if(!empty($action)){
    // $atsTaskInfo
    $atsTask = new atsTestTask;

    switch ($action){
        case 'readTestPCInfo':
            $atsTask->readTestPCInfo();
            break;
        case 'readMachine4Select2':
            $atsTask->readMachine4Select2();
            break;
        case 'getImageName4Select2':
            $atsTask->getImageName4Select2();
            break;
        case 'getAtsInfoByTaskId':
            $taskID=isset($_GET['taskID']) ? $_GET['taskID'] : 0;
            $atsTask->getAtsTaskInfoByTaskId($taskID, $user);
            break;
        case 'checkAtsInfoByMultiTaskId':
            $multiTask=isset($_GET['multiTask']) ? $_GET['multiTask'] : 0;
            $atsTask->checkAtsInfoByMultiTaskId($multiTask);
            break;
        case   'assignAtsInfoByMultiTaskId':
            $multiTask=isset($_GET['multiTask']) ? $_GET['multiTask'] : 0;
            $atsTask->assignAtsInfoByMultiTaskId($multiTask);
            break;
        case 'deleteAtsInfoByMultiTaskId':
            $multiTask=isset($_GET['multiTask']) ? $_GET['multiTask'] : 0;
            $atsTask->deleteAtsInfoByMultiTaskId($multiTask);
            break;
        case 'addTask':
            $atsTask->insertAtsTaskInfo(process4InitAddTaskForm(), $user);
            break;
        case 'updateTaskById':
            $atsTask->updateTaskById(process4InitEditTaskForm());
            break;
        default:

    }

}

function process4InitAddTaskForm(){

    $testMachine=isset($_GET['testMachine']) ? $_GET['testMachine'] : '' ;
    if(!empty($testMachine)){
        $testMachine = substr($testMachine, 0, stripos($testMachine, "("));
    }

    $machineId=isset($_GET['machineId']) ? $_GET['machineId'] : '';
    $testItem=isset($_GET['testItem']) ? $_GET['testItem'] : '';
    $testImage=isset($_GET['testImage']) ? $_GET['testImage'] : '';
    $exJob=isset($_GET['exJob']) ? $_GET['exJob'] : '';
    $osA=isset($_GET['osA']) ? $_GET['osA'] : '';
    $addProduct=isset($_GET['addProduct']) ? $_GET['addProduct'] : '';
    $addSN=isset($_GET['addSN']) ? $_GET['addSN'] : '';
    $addPN=isset($_GET['addPN']) ? $_GET['addPN'] : '';
    $addOem=isset($_GET['addOem']) ? $_GET['addOem'] : '';
    $addSystem=isset($_GET['addSystem']) ? $_GET['addSystem'] : '';
    $bios=isset($_GET['bios']) ? $_GET['bios'] : '';
    $lanIp=isset($_GET['lanIp']) ? $_GET['lanIp'] : '';
    $shelf=isset($_GET['shelf']) ? $_GET['shelf'] : '';

    $addFormArray = array('testMachine'=> $testMachine, 'machineId'=> $machineId, 'testItem'=> $testItem, 'testImage'=>$testImage, 'exJob'=> $exJob,  'osA'=>$osA, 'product'=>$addProduct,
        'addSN'=>$addSN, 'addPN'=>$addPN, 'addOem'=>$addOem, 'addSystem'=> $addSystem, 'bios'=> $bios, 'lanIp'=> $lanIp, 'shelf'=>$shelf);

    return $addFormArray;
}

function process4InitEditTaskForm(){

    $editId=isset($_GET['editId']) ? $_GET['editId'] : '';
    $editImage=isset($_GET['editImage']) ? $_GET['editImage'] : '';
    $customer=isset($_GET['customer']) ? ($_GET['customer'] =='default' ? 0 : 1) : '';
    $editProduct=isset($_GET['editProduct']) ? $_GET['editProduct'] : '';
    $editSN=isset($_GET['editSN']) ? $_GET['editSN'] : '';
    $editPN=isset($_GET['editPN']) ? $_GET['editPN'] : '';
    $editOem=isset($_GET['editOem']) ? $_GET['editOem'] : '';
    $editSystem=isset($_GET['editSystem']) ? $_GET['editSystem'] : '';

    $editFormArray = array('editId'=> $editId, 'editImage'=> $editImage, 'customer'=> $customer, 'editProduct'=>$editProduct, 'editSN'=>$editSN, 'editPN'=>$editPN,
        'editOem'=>$editOem, 'editSystem'=>$editSystem);

    return $editFormArray;
}