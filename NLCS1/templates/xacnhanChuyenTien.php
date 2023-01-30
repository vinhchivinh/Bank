<?php 
    session_start();
    if(!isset($_SESSION['nguoidung']))
    {
        echo"<script>window.location.href='login.php'</script>";
    }
    if(isset($_POST['chuyentien']))
    {
        $array['tkgn']=$_POST['tkgn'];
        $array['tkn']=$_POST['tkn'];
        $array['noidungchuyen']= $_POST['noidungchuyen'];
        $array['sotienchuyen']= $_POST['sotienchuyen'];
        $array['phichuyentien']= $_POST['phichuyentien'];
        $array['hinhthuc']= $_POST['hinhthuc'];
        $_SESSION['thongtinchuyen']=$array;
        require_once "otp.php";
    }
    if(isset($_POST['xacnhanchuyen']))
    {
      $otp=$_POST['OTP'];
      $sotien=$_SESSION['thongtinchuyen']['sotienchuyen'];
      $maotp= $_SESSION['otp'];
      $maGD=$_SESSION['thongtinchuyen']['magiaodich'];
     // echo $maGD;
     // var_dump($maGD);
      $tkg=$_SESSION['thongtinchuyen']['tkgn'];
      $tkn=$_SESSION['thongtinchuyen']['tkn'];
     // echo"$tkn";
      $noidung=$_SESSION['thongtinchuyen']['noidungchuyen'];
      $phi=$_SESSION['thongtinchuyen']['phichuyentien'];
      $date=date('y-m-d');
      $hinhthuc=$_SESSION['thongtinchuyen']['hinhthuc'];
      include_once "../phpFunction/function.php" ;
      $conn=connect_db();
      $sql="SELECT *from phichuyentien where PCT_Ten='$phi'";
      $result=mysqli_query($conn,$sql);
      $row=mysqli_fetch_assoc($result);
      $matenphi=$row['PCT_MA'];
      $tienphi=$row['PCT_MUCPHI'];
      $sql1="SELECT *from hinhthucchuyen where HTC_TEN='$hinhthuc'";
      $result1=mysqli_query($conn,$sql1);
      $row1=mysqli_fetch_assoc($result1);
      $mahinhthuc=$row1['HTC_MA'];
      if($otp != $maotp)
      {
          echo"<script>alert('Mã OTP Không chính xác')</script>";
          echo"<script>window.location.href='chuyentien.php';</script>";
      }
      else
      {
        $sql2="SELECT *FROM TaiKhoan where TaiKhoan.TK_So='$tkn'";
        $result2=mysqli_query($conn,$sql2);
        $count=mysqli_num_rows($result2);
          if($count==0)
          {
           echo"<script>alert('Giao Dịch Thất Bại Do Số Tài Khoản Không Hợp Lệ')</script>";
           echo"<script>window.location.href='chuyentien.php'</script>";
           }
         else
          {
            $sql3="INSERT INTO gdchuyentien (GDCT_MA,TKGUI_SO,TKNHAN_SO,GDCT_SOTIEN,GDCT_NOIDUNG,HTC_MA,PCT_MA,GDCT_NGAY)values( '$maGD','$tkg','$tkn','$sotien','$noidung','$mahinhthuc','$matenphi','$date')";
            mysqli_query($conn,$sql3);
            if($matenphi==1)
            {
                $sql5="UPDATE TaiKhoan SET TK_SODU=TK_SODU-$sotien-$tienphi where TaiKhoan.TK_So='$tkg'";
                mysqli_query($conn,$sql5);
                $sql4="UPDATE TaiKhoan SET TK_SODU=TK_SODU+$sotien where TaiKhoan.TK_So='$tkn'";
                mysqli_query($conn,$sql4);
                echo"<script>alert('Chuyển Tiền Thành Công')</script>";
                echo"<script>window.location.href='chuyentien.php'</script>";
            }
            else{
                $sql5="UPDATE TaiKhoan SET TK_SODU=TK_SODU-$sotien where TaiKhoan.TK_So='$tkg'";
                mysqli_query($conn,$sql5);
                $sql4="UPDATE TaiKhoan SET TK_SODU=TK_SODU+$sotien-$tienphi where TaiKhoan.TK_So='$tkn'";
                mysqli_query($conn,$sql4);
                echo"<script>alert('Chuyển Tiền Thành Công')</script>";
                echo"<script>window.location.href='chuyentien.php'</script>";
            }
            }
          }
      }
    require_once "header.php";
    require_once "menu.php";
?>
<div class="col-md-8">
        <div class="content-right">
            <h3>CHUYỂN TIỀN NỘI BỘ NGÂN HÀNG</h3>
            <form class="tb-chuyentien" method="POST" action="xacnhanChuyenTien.php">
                <div class="tb-chuyentien1">
                    <h4>Thông tin người chuyển</h4>
                    <hr>
                    <table>
                        <tr>
                            <td><b>Tài khoản ghi nợ</b></td>
                            <td name="tkg">
                               <?php
                                    $taikhoanghino=$_SESSION['thongtinchuyen']['tkgn'];
                                    echo$taikhoanghino;

                                ?>
                            </td>
                        </tr>
                        <td>
                            <tr>
                                <td><b>Số dư khả dụng</b></td>
                                <td>
                                    <?php
                                        include_once "../phpFunction/function.php" ;
                                        $conn=connect_db(); 
                                        $stk=$_SESSION['thongtinchuyen']['tkgn'];
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
                                </td>
                            </tr>

                        </td>
                    </table>

                </div>
                <div class="tb-chuyentien2">
                    <h4>Thông tin người nhận</h4>
                    <hr>
                    <table>
                        <tr>
                            <td>
                               <b>Tài Khoản ghi có</b>
                            </td>
                            <td name="tknt">
                                <?php
                                    $tkn=$_SESSION['thongtinchuyen']['tkn'];
                                    echo"<b>".$tkn."</b>";
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Tên người hưởng</b></td>
                            <td>
                                <?php
                                     include_once "../phpFunction/function.php" ;
                                     $conn=connect_db();
                                     $tkn=$_SESSION['thongtinchuyen']['tkn'];
                                     $sql="SELECT *FROM TAIKHOAN WHERE TK_SO='$tkn'";
                                     $result=mysqli_query($conn,$sql);
                                     $row=mysqli_fetch_assoc($result);
                                     echo$row['TK_TEN'];
                                ?>
                            </td>
                        </tr>


                    </table>

                </div>
                <div class="tb-chuyentien3">
                    <h4>Thông tin chuyển tiền</h4>
                    <hr>
                    <table>
                        <tr>
                            <td><b>Nội Dung chuyển tiền</b></td>
                            <td name="nd">
                              <?php
                                    $noidung=$_SESSION['thongtinchuyen']['noidungchuyen'];
                                    echo$noidung;

                              ?>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Hình Thức Chuyển<b></td>
                            <td name="hinhthucchuyen"><?php $hinhthuc=$_SESSION['thongtinchuyen']['hinhthuc']; echo$hinhthuc; ?><td>
                        </tr>   
                        <tr>
                            <td><b>Số tiền chuyển</b></td>
                            <td name="tien">
                                <?php
                                    $sotien=$_SESSION['thongtinchuyen']['sotienchuyen'];
                                    echo$sotien;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Số Tiền Bằng chữ</b></td>
                            <td>
                                <?php
                                    include_once "../phpFunction/function.php";
                                    $sotien=$_SESSION['thongtinchuyen']['sotienchuyen'];
                                    echo chuyentienthanhChu($sotien);
                                ?>
                            </td>   
                        </tr>
                        <tr>
                            <td name="phic"><b>Phí chuyển</b></td>
                            <td>
                                <?php
                                    $phi=$_SESSION['thongtinchuyen']['phichuyentien'];
                                    echo$phi;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Mức Phí</b></td>
                            <td>
                                <?php
                                     include_once "../phpFunction/function.php" ;
                                     $conn=connect_db(); 
                                     $phi=$_SESSION['thongtinchuyen']['phichuyentien'];;
                                     $sql="SELECT *FROM phichuyentien where PCT_TEN='$phi'";
                                     $result=mysqli_query($conn,$sql);
                                     while ($rows=mysqli_fetch_assoc($result))
                                     {
                                       echo"<option>".$rows['PCT_MUCPHI']."</option>";
                                     }

                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Mã Giao dịch</b></td>
                            <td name="maGD">
                                <?php
                                    include_once "../phpFunction/function.php" ;
                                    $conn=connect_db(); 
                                    $stk=$_SESSION['thongtinchuyen']['tkgn'];
                                    $magd=time();
                                    $sql="SELECT KH_Ma FROM TaiKhoan
                                     where TaiKhoan.TK_So='$stk'";
                                    $result=mysqli_query($conn,$sql);
                                    $row=mysqli_fetch_assoc($result);
                                    $magd=$row['KH_Ma']+$magd;
                                    $array['magiaodich']=$magd;
                                    $_SESSION['thongtinchuyen']=$array;

                                    echo$magd;
                                ?>
                            </td>   
                        </tr>
                        <tr>
                            <td><b>Mã OTP</b></td>
                            <td><input type="text" name="OTP"></td>   
                        </tr>
                        


                    </table>


                </div>
                <div class="ql">
                    <button class="btn btn-primary" type="submit" id="btn1">Quay lại</button>

               
                    <button class="btn btn-primary" type="submit" name="xacnhanchuyen" value="1">Xác Nhận</button>

                </div>



            </form>
           


        </div>

      </div>
    
<?php 
    require_once "footer.php";
?>