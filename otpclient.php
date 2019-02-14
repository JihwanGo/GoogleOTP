<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>otp test</title>
  <!-- <base href="/"> -->

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link rel="icon" type="image/x-icon" href="favicon.ico"> -->

  <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="css/util.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">

  <script  src="//code.jquery.com/jquery-3.2.1.min.js"  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="  crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
  <!-- jsSHA 라이브러리 호출  -->
  <script src="https://caligatio.github.io/jsSHA/sha.js"></script>
</head>

<body>

<div class="limiter">
  <div class="container-login100" style="background-image: url('images/bg-01.jpg');">
    <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
      <form class="login100-form validate-form" method="post" action="otpauth.php">
          <input class="input100" type="hidden" name="userID" id="userID" value="<?php echo $_SESSION['ses_userid']; ?>">
          <input class="input100" type="hidden" name="secret" id="secret" value="" >
          <div class="clearfix">
            <label>QR Code</label>
            <div class="input">
              <img id="qrImg" src="" />
            </div>
          </div>
          <?php

          ?>
          <div class="clearfix">
            <label>TOTP(출력 테스트)</label>
            <div class="input">
              <input id="otp" name="otp" value=""></input>
            </div>
          </div>

          <div class="clearfix">
            <label>30초마다 인증번호 변경됨.</label>
            <div class="input">
              <span id='updatingIn'></span>
            </div>
          </div>

          <div class="clearfix">
              <input type="text" id="otptext" name="otptext" placeholder="OTP 번호를 입력하세요">
          </div>

          <div class="container-login100-form-btn">
            <div class="wrap-login100-form-btn">
              <div class="login100-form-bgbtn"></div>
              <!--<button class="login100-form-btn" type="submit" id="otpregister">-->
              <button class="login100-form-btn" id="#">
                등록하기
              </button>
            </div>
          </div>
      </form>
    </div>
  </div>
</div>

</body>

</html>
<script src="secretkey.js"></script>
