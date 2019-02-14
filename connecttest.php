<?php

fucniton connect_mysqli($host, $user, $pw,$dbName) {
  if(!$conn = mysqli_connect($host, $user, $pw)) {
    echo "mysql 연결실패<br / />";
  }
  if(!mysqli_select_db($conn,$dbName){
    echo "DB 선택 실패<br / />";
  }
  return $conn;
}


 ?>
