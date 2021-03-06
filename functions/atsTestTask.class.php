<?php
/**
 * Created by PhpStorm.
 * User: refar
 * Date: 18-6-25
 * Time: 上午9:52
 */

require_once 'atsDbConnect.php';
require_once '../ats_config.inc.php';

class atsTestTask{

    private $atsTaskInfoTable="ats_testtask_info";
    private $atsScheduleInfoTable="ats_schedule_info";

    function readTestPCInfo(){
        $file = fopen(ATS_PREPARE_PATH. ATS_PREPARE_FILE. ATS_FILE_suffix,'r');

        $machineId=isset($_GET['machineId']) ? $_GET['machineId'] : '';

        $jsonResult=array();
        $line=0;

        if(!empty($machineId)){
            while ($data = fgetcsv($file)) { //每次读取CSV里面的一行内容
                $line++;
                if ($line>=2){
                    if ($data[2] == $machineId){
                        $tmpArray = array('product'=> $data[6], 'sn' => $data[7], 'pn' => $data[8], 'oem' => $data[9], 'sys'=> $data[10], 'lanIp' => $data[3], 'shelfId' => $data[0], 'bios'=>$data[11]);
                        array_push($jsonResult, $tmpArray);
                    }
                }

            }

        }
        echo json_encode($jsonResult);
        fclose($file);
    }

    function readMachine4Select2(){
        $file = fopen(ATS_PREPARE_PATH. ATS_PREPARE_FILE. ATS_FILE_suffix,'r');
        $query = isset($_GET['q']) ? $_GET['q'] : '';

        $jsonResult=array();
        $line=0;
        while ($data = fgetcsv($file)) { //每次读取CSV里面的一行内容
            $line++;
            if ($line>=2){
                $machineId=$data[2];
                $appendedTestMachine=$data[1]. "(". $data[2]. ")" ;
                if (empty(trim($query))) {
                    $tmpArray = array('id' => $data[2], 'text' => $appendedTestMachine);
                    array_push($jsonResult, $tmpArray);
                }else {
                    if (stristr($appendedTestMachine, $query) !== false){
                        $tmpArray = array('id' => $data[2], 'text' => $appendedTestMachine);
                        array_push($jsonResult, $tmpArray);
                    }

                }

            }

        }
        echo json_encode($jsonResult);

        fclose($file);
    }

    function getImageName4Select2(){
        $query = isset($_GET['q']) ? $_GET['q'] : '';
        $handler = opendir(ATS_IMAGES_PATH);

        $i = 1;
        $jsonResult = array();

        while (($filename = readdir($handler)) !== false) {
            //略过linux目录的名字为'.'和‘..'的文件
            if ($filename != "." && $filename != "..") {
                if (empty(trim($query))) {
                    $tmpArray = array('id' => $filename, 'text' => $filename);
                    $i = $i + 1;
                    array_push($jsonResult, $tmpArray);
                } else {
                    if (stristr($filename, $query) !== false) {
                        $tmpArray = array('id' => $filename, 'text' => $filename);
                        $i = $i + 1;
                        array_push($jsonResult, $tmpArray);
                    }
                }
            }
        }

        echo json_encode($jsonResult);
    }
    function getAtsTaskInfoByTaskId($taskId=null){
        $jsonResult = array();

        $sql="select * from $this->atsTaskInfoTable where TaskID=$taskId";
        $conn = getDbConnect();

        $result=mysqli_query($conn, $sql);

        if($result){
            // 返回记录数
            $rowCount=mysqli_num_rows($result);
            // 关联数组 one
            $jsonResult['row']=mysqli_fetch_assoc($result);
            // 释放结果集
            mysqli_free_result($result);

            if ($rowCount){
                $jsonResult['flag'] = true;
            } else {
                $jsonResult['flag'] = false;
            }

        } else {
            $jsonResult['flag'] = false;
        }

        //close
        mysqli_close($conn);
        echo json_encode($jsonResult);

    }

    function checkAtsInfoByMultiTaskId($multiTask=null){
        $jsonResult = array();

        $pdoc = getPDOConnect();
        // pdo
        $sql="select * from $this->atsTaskInfoTable where TaskID=?";
        $stmt = $pdoc->prepare($sql);

        $saveNoTaskId = '';
        $saveNotPending = '';
        for ($i = 0; $i < count($multiTask); $i++) {
            if($stmt->execute(array($multiTask[$i]['TaskID']))){
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                // checkTaskId
                if (!$row) {
                    $saveNoTaskId = $saveNoTaskId . $multiTask[$i]['TaskID']. ',';
                }else{
                    // pending check
                    if (0 != $row['TaskStatus']){
                        $saveNotPending = $saveNotPending. $multiTask[$i]['TaskID']. ',';
                    }
                }
            }
        }

        $jsonResult['NoTaskIdFlag'] = empty($saveNoTaskId) ? false : true;
        $jsonResult['saveNoTaskId'] = !empty($saveNoTaskId) ? substr($saveNoTaskId, 0 , strlen($saveNoTaskId) - 1) : '';
        $jsonResult['NotPendingFlag'] = empty($saveNotPending) ? false : true;
        $jsonResult['saveNotPending'] = !empty($saveNotPending) ? substr($saveNotPending, 0 , strlen($saveNoTaskId) - 1) : '';

        echo json_encode($jsonResult);
        $pdoc = null;
    }

    function assignAtsInfoByMultiTaskId($multiTask=null){
        // pdo
        $pdoc = getPDOConnect();

//        $sql4Schedule="insert into  $this->atsScheduleInfoTable select * from  $this->atsTaskInfoTable where TaskID=?";
        $sql4TestTask="update $this->atsTaskInfoTable  set TaskStatus = '1', TestStartTime = now() where TaskID=?";
        $sql4SelectTask="select * from $this->atsTaskInfoTable where TaskID=?";

        // extract
        $stmt = $pdoc->prepare($sql4SelectTask);
        for ($i = 0; $i < count($multiTask); $i++) {
            $stmt->execute(array($multiTask[$i]['TaskID']));
            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $filePath = ATS_TMP_TASKS_PATH;
                $fileName = ATS_TMP_TASKS_HEADER. $row['ShelfID']. ATS_FILE_UNDERLINE. $row['SwitchId'].
                    ATS_FILE_UNDERLINE. $multiTask[$i]['TaskID']. ATS_FILE_suffix;
                $fileCreate = $filePath. $fileName;
                $file = fopen($fileCreate,"x+");
                foreach ($row as $key=>$value){
                    if(null == $value){
                        $value='NULL';
                    }
                    if ('Fast Startup,Standby,Microsoft Edge' == $value){
                        $value = 1;
                    } elseif ('Fast Startup' == $value){
                        $value = 2;
                    } elseif ('BatteryLife' == $value){
                        $value = 5;
                    } elseif('Fast Startup,Standby,Microsoft Edge,BatteryLife,DataGrab' == $value) {
                        $value = 6;
                    }

                    $str = $key. '='. $value.PHP_EOL;
                    file_put_contents($fileCreate, $str,FILE_APPEND);

                }
                fclose($file);
                // unix
                chmod($fileCreate, 0777);
                $cpRe = copy($fileCreate, ATS_TASKS_PATH. $fileName);
                chmod(ATS_TASKS_PATH. $fileName, 0777);
                $unRe = unlink($fileCreate);

                if(1 != $cpRe){
                    echo json_encode($multiTask[$i]['TaskID']. " copy fail". $cpRe);
                    exit();
                }else if (1 != $unRe){
                    echo json_encode($multiTask[$i]['TaskID']. "delete fail". $unRe);
                    exit();
                }else {
                    // update
                    $stmtUpdate = $pdoc->prepare($sql4TestTask);
                    $stmtUpdate->bindParam(1, $multiTask[$i]['TaskID']);
                    $stmtUpdate->execute();
                }
            }
        }
        echo json_encode("done");
    }

    function insertAtsTaskInfo($addTaskFormData, $user){

        $switchId = explode("_",$addTaskFormData['shelf'])[1];
        $shelfId = explode("_",$addTaskFormData['shelf'])[0];

        $columns = "`TaskID`, `TestImage`, `ExecuteJob`, `run_baseline`, `OSActivation`,  `DMI_PartNumber`, `DMI_SerialNumber`, `DMI_ProductName`,".
            "`DMI_OEMString`, `DMI_SystemConfig`, `BIOS_EC`, `TestItem`, `TestMachine`, `MachineID`, `LANIP`, `SwitchId`, ".
            "`ShelfID`, `TestResult`, `TestResultPath`, `TestStartTime`, `TestEndTime`, `TaskStatus`, `Tester`";
        $sql = "insert into $this->atsTaskInfoTable ($columns)".
                " values (NULL, '{$addTaskFormData['testImage']}', '{$addTaskFormData['exJob']}', '{$addTaskFormData['rb']}', '{$addTaskFormData['osA']}', '{$addTaskFormData['addPN']}',".
                " '{$addTaskFormData['addSN']}', '{$addTaskFormData['product']}', '{$addTaskFormData['addOem']}',  '{$addTaskFormData['addSystem']}', '{$addTaskFormData['bios']}', '{$addTaskFormData['testItem']}', '{$addTaskFormData['testMachine']}', ".
                "'{$addTaskFormData['machineId']}', '{$addTaskFormData['lanIp']}', '{$switchId}', '{$shelfId}',  NULL,  NULL, NULL, NULL, '0', '{$user}')";

        $conn = getDbConnect();

        if (mysqli_query($conn, $sql)) {
            // insert success
            echo "success";
        } else {
            echo "error". "<br>". $sql;
        }
    }

    function deleteAtsInfoByMultiTaskId($multiTask=null){
        $sql = "delete from  $this->atsTaskInfoTable where TaskID = ?";
        $pdoc = getPDOConnect();

        $stmt = $pdoc->prepare($sql);
        for ($i = 0; $i < count($multiTask); $i++) {
            $stmt->execute(array($multiTask[$i]['TaskID']));

            if (! $stmt->rowCount() > 0){
                echo "error". "<br> when delete ". $multiTask[$i]['TaskID'];
                exit();
            }
        }
        echo "done";

    }

    function updateTaskById($editTaskFormData){
        $sql4Update = "UPDATE  $this->atsTaskInfoTable SET `TestImage`=?, `DMIModifyFlag`=?, `DMI_ProductName`=?, `DMI_PartNumber`=?, `DMI_SerialNumber`=?, `DMI_OEMString`=?, `DMI_SystemConfig`=? WHERE `TaskID`=?";

        $pdoc = getPDOConnect();
        $stmt = $pdoc->prepare($sql4Update);
        $stmt->bindParam(1, $editTaskFormData['editImage'], PDO::PARAM_STR);
        $stmt->bindParam(2, $editTaskFormData['customer'], PDO::PARAM_STR);
        $stmt->bindParam(3, $editTaskFormData['editProduct'], PDO::PARAM_STR);
        $stmt->bindParam(4, $editTaskFormData['editSN'], PDO::PARAM_STR);
        $stmt->bindParam(5, $editTaskFormData['editPN'], PDO::PARAM_STR);
        $stmt->bindParam(6, $editTaskFormData['editOem'], PDO::PARAM_STR);
        $stmt->bindParam(7, $editTaskFormData['editSystem'], PDO::PARAM_STR);
        $stmt->bindParam(8, $editTaskFormData['editId'], PDO::PARAM_INT);

        $stmt->execute();

        $count = $stmt->rowCount();

        echo json_encode($count);

    }


}