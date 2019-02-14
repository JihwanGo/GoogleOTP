<?php
require_once('./lib/otphp.php');
require_once('./otpcreate.php');


$auth_code = $_POST['auth_code'];

if ($auth_code == $auth_code_now){
  echo("인증번호 불일치");
  exit;


  
  echo '<script type="text/javascript">alert("인증 성공")</script>';
  #echo '<script>location.href='./main.html'</script>';
  echo("<script>location.href='./main.php';</script>");

}
else {
  echo '<script type="text/javascript">alert("인증 실패")</script>';
  #echo '<script>location.href='./otpserver.php'</script>';
  echo("<script>location.href='./otpserver.php';</script>");
}
 ?>
