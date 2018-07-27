<?php
/**
 * Created by PhpStorm.
 * User: refar
 * Date: 18-7-27
 * Time: 下午8:43
 */

require_once 'atsDbConnect.php';
$username = isset($_POST['username']) ? $_POST['username'] : '';

$conn = getDbConnect();

if (!empty($username)){
    $sql = "select t1.login, t1.email, t2.description from users t1 left join roles t2 on t1.role_id = t2.id where t1.login='{$username}'; ";
    $resultDetail = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($resultDetail);
    echo json_encode($row);
}

$conn->close();