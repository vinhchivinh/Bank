<?php
    session_start();
    if(isset($_SESSION['nguoidung'])){
        echo"<script>window.location.href='templates/thongtinCaNhan.php'</script>";
    }
    else{
       echo"<script>window.location.href='templates/login.php'</script>";
      // echo"loi";
    }

?>