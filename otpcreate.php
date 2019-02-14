<?php
session_start();
require_once('./lib/otphp.php');

$Base32 = new Base32();

$mb_id = $_SESSION['ses_userid'];

$mb_id_long = str_pad($mb_id, 30, "!@$%!@$^&*(#*$*%@_#$%*^&**#($)!@#$%^)"); //비밀키 생성 규칙

$encoded = $Base32->encode($mb_id_long);//사용자별 비밀키 생성.

$totp = new \OTPHP\TOTP($encoded);

$auth_code_now = $totp->now();// 현재 시점의 인증번호(30초마다 바뀜).


?>
