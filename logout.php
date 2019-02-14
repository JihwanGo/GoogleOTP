<?php
session_start(); // 세션

if(isset($_SESSION['ses_userid'])){

        unset($_SESSION['ses_userid']);
        session_destroy();
    }
echo '<script type="text/javascript">alert("로그아웃 됨")</script>';
echo "<script>location.href='login.php';</script>";


?>
