<?php 
     session_start();
     if(!isset($_SESSION['nguoidung']))
     {
         echo"<script>window.location.href='login.php'</script>";
     }
     //echo $_SESSION['nguoidung']['KH_CCCD_CMND'];
    require_once "header.php";
    require_once "menu.php";
?>
<div class="col-md-8">
                <div class="thongtincanhan">
                    <h3>Thông Tin Cá Nhân</h3>
                    <div>
                        <div>
                            <img src="../image/user.png">
                        </div>
                        <table>
                            <tr>
                                <td><b>Họ Và Tên Khách Hàng</b></td>
                                <td><i><?php echo $_SESSION['nguoidung']['KH_TEN']  ?></i></td>
                            </tr>
                            <tr>
                                <td><b>Số CCCD/CMND</b></td>
                                <td><i><?php echo $_SESSION['nguoidung']['KH_CCCD_CMND']  ?></i></td>
                            </tr>
                            <tr>
                                <td><b>Địa Chỉ</b></td>
                                <td><i><?php echo $_SESSION['nguoidung']['KH_DIACHI']  ?></i></td>
                            </tr>
                            <tr>
                                <td><b>Email</b></td>
                                <td><i><?php echo $_SESSION['nguoidung']['KH_EMAIL']  ?></i></td>
                            </tr>
                            <tr>
                                <td><b>Số Điện Thoại</b></td>
                                <td><i><?php echo $_SESSION['nguoidung']['KH_SDT']?></i></td>
                            </tr>
                            <tr>
                                <td><b>Quốc Tịch</b></td>
                                <td>
                                    <i>
                                     <?php include_once "../phpFunction/function.php" ;
                                            $conn=connect_db();
                                            $sql="SELECT QT_Ten from KhachHang,QuocTich
                                                  where KhachHang.QT_MA=QuocTich.QT_Ma";
                                            $result=mysqli_query($conn,$sql);
                                            $row=mysqli_fetch_assoc($result);
                                            echo$row['QT_Ten'];
                                     ?>
                                   </i>
                               </td>
                            </tr>
                            <tr>
                                <td><b>Nghề Nghiệp</b></td>
                                <td><i><?php echo $_SESSION['nguoidung']['KH_NGHENGHIEP']  ?></i></td>
                            </tr>


                        </table>
                    </div>
                </div>
               
            </div>
<?php 
    require_once "footer.php";
?>
