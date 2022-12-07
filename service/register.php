<?php
require_once("../config/db.php");

use api\auth\Authsystem;
require_once '../auth.php';

$user = $_POST['login_username'];
$pass = $_POST['login_password'];

if(empty($user and $pass)){
    echo json_encode(array('status'=>"error",'msg'=>"กรุณากรอกข้อมูลให้ครบ"));
}else{
    Authsystem::loginUser($user,$pass);
}

?>