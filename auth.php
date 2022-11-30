<?php

namespace api\auth;

session_start();

use Database\dbconnect;
use PDO;
use PDOException;

require_once('config/db.php');

class Authsystem {
    public static function loginUser($username, $password) {
        try {
            $stmt = dbconnect::connect()->prepare("SELECT * FROM user WHERE user_name = '$username'");
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($stmt->rowCount() > 0) {
                if ($username == $row['user_name']) {
                    if ($password == $row['user_pass']) {
                            $_SESSION['user_id'] = $row['user_id'];
                            $_SESSION['user_name'] = $row['user_name'];
                            $_SESSION['login_status'] = "เข้าสู่ระบบสำเร็จ";
                            $response = array(
                                'status' => 'success',
                                'message' => 'เข้าสู่ระบบสำเร็จ',
                                'href' => '/index.php'
                            );
                            echo json_encode($response);
                        } else {
                            $_SESSION['login_status'] = "รหัสผ่านผิด";
                            $_SESSION['error'] = 'รหัสผ่านผิด';
                            $response = array(
                                'status' => 'error',
                                'message' => 'รหัสผ่านผิด'
                            );
                            echo json_encode($response);
                        }
                    } else {
                        $_SESSION['login_status'] = "username ผิด";
                        $_SESSION['error'] = 'username ผิด';
                        $response = array(
                            'status' => 'error',
                            'message' => 'username ผิด'
                        );
                        echo json_encode($response);
                    }
            } else {
                $_SESSION['login_status'] = "ไม่มีข้อมูลในระบบ";
                $_SESSION['error'] = "ไม่มีข้อมูลในระบบ";
                $response = array(
                    'status' => 'success',
                    'message' => 'ไม่มีข้อมูลในระบบ'
                );
                echo json_encode($response);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function registerUser($user, $pass){
        try{
            $sql = "SELECT * FROM user WHERE user_name = $user";
            $stmt = dbconnect::connect()->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetch();

            if($row['user_name'] == $user){
                echo json_encode(array('ststus' => 'error', 'msg' => 'มีเลขประจำตัวนักเรียนนี้อยู่ในระบบแล้ว'));
            } else {
                $passHash = password_hash($pass, PASSWORD_DEFAULT);
                $stmt = dbconnect::connect()->prepare("INSERT INRO (user_name, user_pass) VALUES ($user, $passHash)");
                $stmt->execute();
                echo json_encode(array('status'=>"success",'msg'=>"สมัครสมาชิกเรียบร้อยแล้ว",'href'=>"/index.php"));
            }
        } catch (PDOException $e){
            echo $e->getMessage();
        }
    }
}
