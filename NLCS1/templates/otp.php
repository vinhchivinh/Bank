<?php
    //session_start();
    $a=mt_rand(100000,999999);
    $_SESSION['otp']=$a;
    $myFile = "maOTP.text";
    $fh = fopen($myFile, 'a');
    $string="\n";
   // echo$a;
    fwrite($fh,$a.$string);
    fclose($fh);
?>