
<!DOCTYPE html>
<html lang="en">
<?php
session_start();
require_once('./otpcreate.php');
?>
<head>
  <meta charset="utf-8">
  <title>otp test</title>
  <!-- <base href="/"> -->

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
  <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
  <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
  <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
  <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
  <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" type="text/css" href="css/util.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">

  <script  src="//code.jquery.com/jquery-3.2.1.min.js"  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="  crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="bootstrap.min.css">

</head>

<body>

<div class="limiter">
  <div class="container-login100" style="background-image: url('images/bg-01.jpg');">
    <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
      <form class="login100-form validate-form" method="post" action="otpauth.php">
          <br />
          <span>테스트 사용방법</span>
          <br />
          <? echo time()?>
          <br />
          <span>Google OTP APP을 이용하여 비밀키로 생성된 QR코드를 인식하여 등록하여 주시기 바랍니다.
          등록이 완료되었으면 APP에 표시된 6자리 숫자를 입력하여 주세요.</span>
          <br />
          <div class="clearfix">
                <br />
            <label>QR Code</label>
            <div class="input">
            <img id="qrImg" style="margin:0 auto;" src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=150x150&chld=M|0&cht=qr&chl=otpauth://totp/테스트 (<?=$mb_id?>)%3Fsecret%3D<?=$encoded?>" />
            <br />
            </div>
          </div>
          <div class="clearfix">
              <input type="text" id="auth_code" name="auth_code" placeholder="OTP 번호를 입력하세요">
          </div>

          <div class="container-login100-form-btn">
            <div class="wrap-login100-form-btn">
              <div class="login100-form-bgbtn"></div>
              <!--<button class="login100-form-btn" type="submit" id="otpregister">-->
              <button class="login100-form-btn" id="#">
                인증하기
              </button>
            </div>
          </div>
      </form>
    </div>
  </div>
</div>

</body>

</html>
