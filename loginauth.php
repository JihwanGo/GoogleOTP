<?php
session_start();
require_once('./connect.php');

    $id = $_POST['id'];
       $password = md5($password = $_POST['password']);


       $sql = "SELECT * FROM userinfo WHERE id = '{$id}' AND password = '{$password}'";
       $res = $mysqli->query($sql);


           $row = $res->fetch_array(MYSQLI_ASSOC);


           if ($id == $row['id'] && $password == $row['password']) {

               $_SESSION['ses_userid'] = $row['id'];

               echo '<script type="text/javascript">alert("로그인 성공")</script>';
               echo("<script>location.href='./otpserver.php';</script>");

               exit();

           }
           if($id !== $row['id'] || $password !== $row['password']){

               echo '<script type="text/javascript">alert("로그인 실패")</script>';
               echo("<script>location.href='./login.php';</script>");

               exit();

           }

 ?>
