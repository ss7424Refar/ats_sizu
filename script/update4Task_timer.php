<?php
/**
 * Created by PhpStorm.
 * User: refar
 * Date: 18-9-9
 * Time: 下午12:41
 */

/*
 * set DB's status to expired
 */
ini_set("display_errors", "On");
error_reporting(E_ALL | E_STRICT);

// 指定允许其他域名访问
header('Access-Control-Allow-Origin:*');
// 响应类型
header('Access-Control-Allow-Methods:GET');
// 响应头设置
header('Access-Control-Allow-Headers:x-requested-with,content-type');

require_once '../functions/atsDbConnect.php';
require_once '../ats_config.inc.php';
require_once '../plugins/swiftmailer-5.4.3/lib/swift_required.php';

$conn = getDbConnect();
$rowsResult = array();

if (!$conn) {
    die('could not connect' . mysqli_connect_error());
    echo 'failed';
    exit;
}
mysqli_set_charset($conn, DB_CHARSET);

$sql = "select * from ats_testtask_info  where TIMESTAMPDIFF(hour, TestStartTime, now()) >= 24 and TaskStatus = '1';";

$resultDetail = mysqli_query($conn, $sql);
while ($row = $resultDetail->fetch_assoc()) {

    mysqli_query($conn, "update ats_testtask_info set TaskStatus=5, TestEndTime = now() where TaskID = ". $row['TaskID'] );

    $tester = $row['Tester'];
    $result = mysqli_query($conn, "select email from users where login='". $tester ."'");
    $email = mysqli_fetch_assoc($result);

    sendMail($email['email'], $row);

}

/*
 * send mail api
 */
function sendMail($to, $info){

    $date = date("Y-m-d");
    $mailTitle = '[SWV][Auto Test System][' . $date . ']You Need to run the baseline image';

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
        '		<p>Dear ' . $info['Tester'] . ',</p>' .
        '		<p>Since OEM image test result is NOT passed the target metrics, please find your target machine on test shelf and click OK to start running baseline image.</p>' .
        '		<p style="font-size:12px;color:red"><i>The Jumpstart task as below.</i></p>' .
        '	<table>' .
        '		<tr bgcolor="#B8BFD8">' .
        '			<th>TaskID</th><th>Test Machine</th><th>Test Image</th><th>Machine ID</th><th>Assigned Task</th>' .
        '			<th>Task Status</th><th>StartDate</th><th>FinishDate</th><th>Test Result</th>' .
        '		</tr>' .
        '       <tr>' .
        '			<td>ATS_' . $info['TaskID'] . '</td>' .
        '			<td>' . $info['TestMachine'] . '</td>' .
        '			<td>' . $info['TestImage'] . '</td>' .
        '			<td>' . $info['MachineID'] . '</td>' .
        '			<td>' . $info['TestItem'] . '</td>' .
        '			<td>expired</td>' .
        '			<td>' . $info['TestStartTime'] . '</td>' .
        '			<td>' . $info['TestEndTime'] . '</td>' .
        '			<td>' . 'N/A' . '</td>' .
        '		</tr>' .
        '	</table></body>' .
        '<p style="margin-top: 15px">Click here to view task list:&nbsp;&nbsp;&nbsp;<a style="font-size:12px;" href="http://172.30.52.43/ats/view/' .
        'taskManagerForJump.php">Link To ATS</a></p>' .
        '</html>';

    // Create the Transport
    $transport = Swift_SmtpTransport::newInstance(SMTP_HOST, SMTP_PORT);

    $mailer = Swift_Mailer::newInstance($transport);

    // Create a message
    $message = Swift_Message::newInstance($mailTitle)
        ->setFrom(array(Mail_FROM))
        ->setTo($to)
        ->setCc(json_decode(MAIL_CC, true))
        ->setBody($htmlBody, 'text/html', 'utf-8');;

    // Send the message
    $result = $mailer->send($message);
    echo date("Y-m-d H:i:s", time()) . ' : ' . $result. '<br>';

}