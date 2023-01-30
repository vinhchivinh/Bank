<?php
     include_once "../phpFunction/function.php" ;
     $conn=connect_db(); 
     $stk=$_POST['Stentaikhoan'];
     $sql="SELECT TK_SODU from TaiKhoan where TK_SO='$stk'";
     $results=mysqli_query($conn,$sql);
    // $sodu=($row['TK_SODU']);
    // echo"hrllo";
    $row=mysqli_fetch_assoc($results);
    $sodu=($row['TK_SODU']);
    //$sodu=100000;
    money($sodu);
    echo"<b>".$sodu."</b>";

?>
