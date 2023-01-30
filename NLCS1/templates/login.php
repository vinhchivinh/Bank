<?php
    session_start();
    if(isset($_POST['dangnhap'])){
        $user=$_POST['user'];
        $pass=$_POST['pass'];
        $pass=$pass."000iiizzz";
        $pass=md5($pass);
        $capcha=$_POST['capcha'];
        $capcha0 =$_SESSION['capcha'];
        include_once "../phpFunction/function.php";
        $conn=connect_db();

        $sql="SELECT * FROM KhachHang Where KH_CCCD_CMND='$user'";
        $result=mysqli_query($conn,$sql);
        $count=count_row($result);
        $row=mysqli_fetch_assoc($result);
      
        if(!$user || !$pass || !$capcha){
            echo"<script>alert('Vui Lòng Nhập Đầy Đủ Thông Tin')</script>";
        }
        else if($capcha != $capcha0){
            echo"<script>alert('Vui Lòng Kiểm Tra Lại mã xác nhận')</script>";
        }
        else if($count==0) {
            echo"<script>alert('Mật khẩu hoặc tài khoản không chính xác')</script>";

        }
        else if($pass==$row['KH_MATKHAU']&& $user==$row['KH_CCCD_CMND']){
            $_SESSION['nguoidung']=$row;
            echo"<script>window.location.href='thongtinCaNhan.php'</script>";

        }
        else{
            echo"<script>alert('Mật khẩu hoặc tài khoản không chính xác')</script>";
        }



    }
    

?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login Form</title>
        <link rel="stylesheet" href="../bootstrap4/css/bootstrap.min.css">
    </head>
    <style>
        body{
            background-color: #00ac96;
        }
        .content {
            background-color: #fff;
            margin-top:5%;
        }
        .form{
            margin-top: 5%;
        }
        h4 {
            color:#00ac96;
            font-size:20px;
        }
        .form-control{
            display: block;
            width:100%;
            font-size: 1rem;
            font-weight: 400;
            line-height: 400;
            border-color:#00ac96 !important;
            border-style: solid !important;
            border-width: 0 0 1px 0 !important;
            padding: 0px !important;
            color:#495057;
            
            border-radius: 0;
            background-color: #fff;
            background-clip:padding-box;
        }
        .form-control:focus {
            color:#495057;
            background-color: #fff;
            border-color: #fff;
            outline: 0;
            box-shadow: 0;
            
        }
        form{
            margin-top: 20px;;
        }
        .box {
            margin-top: 15px;
            margin-bottom:15px ;
        }
        .btn-class {
            background-color: #00ac96;
            margin-top: 10px;
            font-weight: 500;
        }
    </style>
    <body>
        <div class="container">
            <div class="row  content">
                <div class="col-md-6">
                    <img src="../image/finance.png" class="image">

                </div>
                <div class="col-md-6 form">
                    <h4>CHÀO MỪNG BẠN ĐẾN VỚI NGÂN HÀNG TRỰC TUYẾN</h4>
                    <form method="post" action="login.php">
                        <div class="box">
                            <label for="user"><b>Tài Khoản</b></label>
                            <input type="text" name="user" class="form-control">
                        </div>
                        <div  class="box">
                            <label for="pass"><b>Mật Khẩu</b></label>
                            <input type="password" name="pass" class="form-control">
                        </div>
                        <div>
                            <input type="text" style="width: 150px;" placeholder="Nhập Mã Xác Nhận" name="capcha">
                            <img src="capcha.php">
                        </div>
                        <div>
                            <button type="submit" class="btn btn-class" name="dangnhap">Đăng Nhập</button>
                        </div>

                    </form>

                </div>

            </div>

        </div>
    </body>

</html>