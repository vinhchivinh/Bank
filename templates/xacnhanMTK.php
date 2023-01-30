<?php 
     session_start();
     if(!isset($_SESSION['nguoidung']))
     {
         echo"<script>window.location.href='login.php'</script>";
     }
     if(isset($_POST['xacnhanmotk'])){
        require_once "otp.php";
        $array['taikhoannguon']=$_POST['taikhoannguon'];
        $array['kihant']=$_POST['kihant'];
        $array['hinhthuclai']=$_POST['hinhthuclai'];
        $array['tiengui']=$_POST['tiengui'];
        $_SESSION['tietkiem']=$array;
     }
     if(isset($_POST['mo'])){
         $otp=$_SESSION['otp'];
         echo"<br>";
         //echo$otp;
         $maotp=$_POST['maotp'];
         if($maotp !=$otp)
         {
            echo"<script>alert('Mã otp không chính xác')</script>";
            echo"<script>window.location.href='moTietKiem.php'</script>";
         }
         else {
            include_once "../phpFunction/function.php" ;
            $conn=connect_db();
            
            $date=date('Y-m-d');

            $hinhthuclai=$_SESSION['tietkiem']['hinhthuclai'];
            $sql4="SELECT HTL_MA from hinhthuclai where HTL_TEN='$hinhthuclai'";
            $result4=mysqli_query($conn,$sql4);
            $row4=mysqli_fetch_assoc($result4);
            $hinhthuclaima=$row4['HTL_MA'];

            $kihan=$_SESSION['tietkiem']['kihant'];
            $sql3="SELECT KHAN_MA from kyhan where KHAN_TEN='$kihan'";
            $result3=mysqli_query($conn,$sql3);
            $row3=mysqli_fetch_assoc($result3);
            $makhihan=$row3['KHAN_MA'];

             $chuoi=mt_rand(100000,999999);
             $sotk=$_SESSION['tietkiem']['taikhoannguon'];
             $chuoi=substr($sotk,0,5).$chuoi;
             $ma=$_SESSION['nguoidung']['KH_MA'];
            
             $tien=$_SESSION['tietkiem']['tiengui'];
             $sql="INSERT INTO taikhoan (KH_MA,LTK_MA,TK_SO,TK_SODU) VALUES('$ma',2,'$chuoi','$tien')";
             $result=mysqli_query($conn,$sql);

             $sql1="INSERT into motietkiem(TKMOTK_SO,TKTK_SO,MTK_SOTIEN,KHAN_MA,HTL_MA,MTK_NGAY) values('$sotk','$chuoi','$tien','$makhihan','$hinhthuclaima','$date')";
             $result1=mysqli_query($conn,$sql1);

             $sql5="UPDATE TaiKhoan SET TK_SODU=TK_SODU-$tien where TaiKhoan.TK_So='$sotk'";
             $result5=mysqli_query($conn,$sql5);
             

             if($result4 && $result3 && $result && $result1&&$result5)
             {
                echo"<script>alert('Mở tài khoản tiết kiệm thành công')</script>";
                echo"<script>window.location.href='moTietKiem.php'</script>";
             }
             else{
                 echo"thất bại";
             }
             
         }
     }
    require_once "header.php";
    require_once "menu.php";

?>
<div class="col-md-8">
               <form method="POST" action="xacnhanMTK.php">
                   <div class="motietkiem">
                       <h3>Mở Tài Khoản Tiết Kiệm</h3>
                       <div>
                           <div class="tkm">
                                <h4>Thông Tin Tài Khoản Mở Tiết Kiệm</h4>
                                <hr>
                                <table>
                                    <tr>
                                    <td><strong>Số Tài Khoản</strong></td>
                                    <td><?php echo $_SESSION['tietkiem']['taikhoannguon']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Số Dư Khả Dụng</strong></td>
                                        <td><?php
                                            include_once "../phpFunction/function.php" ;
                                            $conn=connect_db(); 
                                            $stk= $_SESSION['tietkiem']['taikhoannguon'];
                                            $sql="SELECT TK_SODU from TaiKhoan where TK_SO='$stk'";
                                            $results=mysqli_query($conn,$sql);
                                            // $sodu=($row['TK_SODU']);
                                            // echo"hrllo";
                                            $row=mysqli_fetch_assoc($results);
                                            $sodu=($row['TK_SODU']);
                                            //$sodu=100000;
                                            money($sodu);
                                            echo"<b>".$sodu."</b>";

                                        ?></td>
                                    </tr>
                            </table>

                           </div>
                           <div class="tttkm">
                            <h4>Thông Tin Tài Khoản Tiết Kiệm </h4>
                            <hr>
                            <table>
                                <tr>
                                    <td><strong>Loại Tài Khoản</strong></td>
                                    <td>Tiết Kiệm Có Kì Hạn</td>
                                </tr>
                                <tr>
                                    <td><strong>Kì Hạn Gửi</strong></td>
                                    <td><?php echo$_SESSION['tietkiem']['kihant']; ?></td>
                                    
                                </tr>
                                <tr>
                                    <td><strong>Lãi Suất</strong></td>
                                    <td><?php
                                    $kihan=$_SESSION['tietkiem']['kihant'];
                                    include_once "../phpFunction/function.php" ;
                                    $conn=connect_db();
                                    $sql="SELECT* from kyhan where KHAN_TEN='$kihan'";
                                    $result=mysqli_query($conn,$sql);
                                    $row=mysqli_fetch_assoc($result);
                                    echo$row['KHAN_LAISUAT'];
                                    ?><td>
                                </tr>
                                <tr>
                                    <td><strong>Số Tiền Gửi</strong></td>
                                    <td><?php echo$_SESSION['tietkiem']['tiengui']; ?></td>
 
                                </tr>
                                <tr>
                                    <td><strong>Hình Thức Trả Lãi</strong></td>
                                    <td>
                                        <?php echo$_SESSION['tietkiem']['hinhthuclai'];  ?>
                                   </td>
                                </tr>
                                <tr>
                                   <td><strong>Mã OTP</strong></td>
                                    <td>
                                        <input name ="maotp"type="text" style="width:200px;">
                                   </td>

                                </tr>   
 
                            </table>

                           </div>
                
                         
                           
                       </div>
                       <div style="margin-left: 70%; margin-top:0px">
                           <input type="submit" value="Quay Lại"class="btn btn-primary">
                           <input type="submit" class="btn btn-primary" value="Xác Nhận" name="mo">
                       </div>
                      
                   </div>
               </form>
            </div>
<?php 
    require_once "footer.php";
?>


