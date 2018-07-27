

<?php
/**
 * Created by PhpStorm.
 * User: refar
 * Date: 18-7-27
 * Time: 下午6:03
 */

session_start(); // 初始化session
$_SESSION['name'] = "admin"; //保存某个session信息

echo isset($_GET['message']) ? $_GET['message'] : '';
?>

<a href="atsIndex.php">click me here!</a>