<?php 
    session_start();
    if(!isset($_SESSION['nguoidung']))
    {
        echo"<script>window.location.href='login.php'</script>";
    }
    if(isset($_POST['doimatkhau'])){
        $tendangnhap=$_POST['tendangnhap'];
        $matkhau=$_POST['matkhau'];
        $matkhaumoi=$_POST['matkhaumoi'];
        $matkhaunhaplai=$_POST['matkhaunhaplai'];

        $matkhau=$matkhau."000iiizzz";
        $matkhau=md5($matkhau);

        include_once "../phpFunction/function.php" ;
        $conn=connect_db();
        $sql="SELECT *FROM KhachHang where KH_CCCD_CMND='$tendangnhap'";
        $result=mysqli_query($conn,$sql);
        $count=mysqli_num_rows($result);
        $row=mysqli_fetch_assoc($result);
        if($count==0){
            echo"<script>alert('Mật khẩu hoặc tài khoản không chính xác');</script>";
        }
        else if(!$matkhaumoi||!$matkhaunhaplai ||!$tendangnhap|| !$matkhau)
        {
            echo"<script>alert('Vui Lòng Nhập Đầy Đủ Thông Tin');</script>";
        }
        else if($matkhau==$row['KH_MATKHAU'])
        {
            if($matkhaumoi !=$matkhaunhaplai)
            {
                echo"<script>alert('Mật khẩu không trùng khớp');</script>";
            }
            else{
                $matkhaumoi=$matkhaumoi."000iiizzz";
                $matkhaumoi=md5($matkhaumoi);

                $sql1="UPDATE  KhachHang SET KH_MATKHAU='$matkhaumoi' WHERE KH_CCCD_CMND='$tendangnhap'";
                mysqli_query($conn,$sql1);
                echo"<script>alert('Đổi Mật Khẩu Thành Công');</script>";
            }

        }
        else{
            echo"<script>alert('Vui Lòng Nhập Đầy Đủ Thông Tin');</script>";
        }

    }
    require_once "header.php";
    require_once "menu.php";
?>
<div class="col-md-8">
                <form action="doiMK.php"method="POST" class="doiMatKhau">
                    <div >
                        <h3>Đổi Mật Khẩu</h3>
                        <table>
                            <tr>
                                <td>Tên Đăng Nhập</td>
                                <td><input type="text" name="tendangnhap"></td>
                            </tr>
                            <tr>
                                <td>Mật Khẩu Hiện Tại</td>
                                <td><input type="text" name="matkhau"></td>
                            </tr>
                            <tr>
                                <td>Mật Khẩu Mới</td>
                                <td><input type="text" name="matkhaumoi"></td>
                            </tr>
                            <tr>
                                <td>Nhập Lại Mật Khẩu</td>
                                <td><input type="text" name="matkhaunhaplai"></td>
                            </tr>
                        </table>
                        <div class="button-mk">
                            <input class="btn btn-primary"type="submit" value="Xác Nhận" name="doimatkhau">
                        </div>
                    </div>
                   
                </form>
            </div>
<?php 
    require_once "footer.php";
?>