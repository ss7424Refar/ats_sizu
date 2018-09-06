<?php

ini_set("display_errors", "On");
error_reporting(E_ALL | E_STRICT);

// 指定允许其他域名访问  
header('Access-Control-Allow-Origin:*');
// 响应类型  
header('Access-Control-Allow-Methods:GET');
// 响应头设置  
header('Access-Control-Allow-Headers:x-requested-with,content-type');

require_once 'swiftmailer-5.4.3/lib/swift_required.php';

//**********************************************************************************************

// $to = array('lin.zhu@toshiba-tih.com','tianer.zhao@toshiba-tih.com','xiaoyan.ding@toshiba-tih.com');
$cc = array('wanliang.xu@toshiba-tih.com', 'lin.zhu@toshiba-tih.com', 'lin.qiu@toshiba-tih.com', 'bin.yan@toshiba-tih.com', 'xiaoyan.ding@toshiba-tih.com');
// $cc = array('lin.zhu@toshiba-tih.com');
$emailAddr = 'ats_swv@toshiba-tih.com';//'zhen.qiu@toshiba-tih.com';
$date = date("Y-m-d");
$mailTitle = '[SWV][Auto Test System][' . $date . ']You Need to run the baseline image';

//**********************************************************************************************

//---------------------DB---------------------------

$taskId = isset($_GET['taskId']) ? $_GET['taskId'] : 0;
// $taskId=12;
$rowsResult = array();

define('DB_TYPE', 'mysql');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_HOST', '172.30.52.29');
define('DB_NAME', 'tpms');
define('DB_PORT', '3306');
define('DB_CHARSET', 'utf8');

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

if (!$conn) {
    die('could not connect' . mysqli_connect_error());
    echo 'failed';
    exit;
}
mysqli_set_charset($conn, DB_CHARSET);

$sql = "select * from ats_testtask_info where TaskID=$taskId";

$resultDetail = mysqli_query($conn, $sql);
while ($row = $resultDetail->fetch_assoc()) {
    array_push($rowsResult, $row);
}

if (null != $rowsResult[0]['TaskStatus']) {
    if (0 == $rowsResult[0]['TaskStatus']) {
        $status = 'pending';
    } else if (1 == $rowsResult[0]['TaskStatus']) {
        $status = 'ongoing';
    } else if (2 == $rowsResult[0]['TaskStatus']) {
        $status = 'finished';
    }
}

$email = array();

if (null != $rowsResult[0]['Tester']) {
    $user = $rowsResult[0]['Tester'];
    $sql2 = "select email from users where login='$user'";
    $result = mysqli_query($conn, $sql2);
    $email = mysqli_fetch_assoc($result);

}

$to = $email['email'];
//---------------------DB---------------------------
$htmlBody = '<html>' .
    '	<head>' .
    '		<style type="text/css">' .
    '			p {margin: 5px;font-size: 13px;}' .
    '			th {' .
    '				font-size: 12px;' .
    '			}' .
    '		    table tr td {' .
    '				align:center;' .
    '				border: thin dotted #96B97D;' .
    '				font-size:12px;' .
    '				text-align: center;' .
    '			}' .
    '			th {padding: 6px;}' .
    '		</style>' .
    '	</head>' .
    '	<body>' .
    '		<p>Dear ' . $rowsResult[0]['Tester'] . ',</p>' .
    '		<p>Since OEM image test result is NOT passed the target metrics, please find your target machine on test shelf and click OK to start running baseline image.</p>' .
    '		<p style="font-size:12px;color:red"><i>The Jumpstart task as below.</i></p>' .
    '	<table>' .
    '		<tr bgcolor="#B8BFD8">' .
    '			<th>TaskID</th><th>Test Machine</th><th>Test Image</th><th>Machine ID</th><th>Assigned Task</th>' .
    '			<th>Task Status</th><th>StartDate</th><th>FinishDate</th><th>Test Result</th>' .
    '		</tr>' .
    '       <tr>' .
    '			<td>ATS_' . $rowsResult[0]['TaskID'] . '</td>' .
    '			<td>' . $rowsResult[0]['TestMachine'] . '</td>' .
    '			<td>' . $rowsResult[0]['TestImage'] . '</td>' .
    '			<td>' . $rowsResult[0]['MachineID'] . '</td>' .
    '			<td>JumpStart</td>' .
    '			<td>' . $status . '</td>' .
    '			<td>' . $rowsResult[0]['TestStartTime'] . '</td>' .
    '			<td>-</td>' .
    '			<td>' . 'N/A' . '</td>' .
    '		</tr>' .
    '	</table></body>' .
    '<p style="margin-top: 15px">Click here to view task list:&nbsp;&nbsp;&nbsp;<a style="font-size:12px;" href="http://172.30.52.43/ats/view/' .
    'taskManagerForJump.php">Link To ATS</a></p>' .
    '</html>';

//**********************************************************************************************
// Create the Transport
$transport = Swift_SmtpTransport::newInstance('172.30.52.43', 25); //172.30.216.196    172.30.52.76

$mailer = Swift_Mailer::newInstance($transport);

// Create a message
$message = Swift_Message::newInstance($mailTitle)
    ->setFrom(array($emailAddr))
    ->setTo($to)
    ->setCc($cc)
    ->setBody($htmlBody, 'text/html', 'utf-8');;

// Send the message
$result = $mailer->send($message);
echo $result;