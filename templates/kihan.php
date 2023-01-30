<?php
    $kihan=$_POST['kihanj'];
    include_once "../phpFunction/function.php" ;
    $conn=connect_db();
    $sql="SELECT* from kyhan where KHAN_TEN='$kihan'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    echo$row['KHAN_LAISUAT'];


?>