<?php 
    session_start();
    if(!isset($_SESSION['nguoidung']))
    {
        echo"<script>window.location.href='login.php'</script>";
    }
    require_once "header.php";
    require_once "menu.php";
?>
<div class="col-md-8">
                <div class="content-right">
                    <h3>Danh Sách Tài Khoản</h3>
                    <div class="tb">
                        <h4>Danh Sách Tài Khoản Thanh Toán</h4>
                        <hr>
                        <table style="border-collapse: collapse; border: 1px solid black;" border=1>
                            <tr>
                                <th>Số tài khoản</th>
                                <th>Số dư</th>
                                <th>Chi tiết</th>
                            </tr>
                            <?php
                                    include_once "../phpFunction/function.php" ;
                                    $conn=connect_db();
                                    $ma=$_SESSION['nguoidung']['KH_MA'];
                                    $sql="SELECT* from TaiKhoan where LTK_MA=1 and KH_MA='$ma' ";
                                    $result=mysqli_query($conn,$sql);
                                    while($rows=mysqli_fetch_assoc($result)){
                                    echo"<tr>";
                                    echo"<td>".$rows['TK_SO']."</td>";
                                        $sodu=$rows['TK_SODU'];
                                        money($sodu);
                                        echo"<td>".$sodu."</td>";
                                        echo"<td><a href='#'>Xem chi tiết</a></td>";
                                    echo" </tr>";
                                    }

                                ?>
                        </table>

                    </div>
                    <div class="tb">
                        <h4>Danh Sách Tài Khoản Tiết Kiệm</h4>
                        <hr>
                        <table style="border-collapse: collapse; border: 1px solid black;" border=1>
                            <tr>
                                <th>Số tài khoản tiết kiêm</th>
                                <th>Số dư</th>
                                <th>Tài Khoản Mở Tiết Kiệm</th>
                                <th>Chi tiết</th>
                            </tr>
                            <?php
                                    include_once "../phpFunction/function.php" ;
                                    $conn=connect_db();
                                    $ma=$_SESSION['nguoidung']['KH_MA'];
                                    $sql="SELECT* from TaiKhoan,motietkiem where LTK_MA=2 and KH_MA='$ma'and TaiKhoan.TK_SO=motietkiem.TKTK_SO";
                                    $result=mysqli_query($conn,$sql);
                                    while($rows=mysqli_fetch_assoc($result)){
                                    echo"<tr>";
                                        echo"<td>".$rows['TKTK_SO']."</td>";
                                        $sodu=$rows['TK_SODU'];
                                        money($sodu);
                                        echo"<td>".$sodu."</td>";
                                        echo"<td>".$rows['TKMOTK_SO']."</td>";
                                        echo"<td><a href='chitietTietKiem.php?tktk=".$rows['TKTK_SO']."'>Xem chi tiết</a></td>";
                                    echo" </tr>";
                                    }
                                  ?>      
                        </table>
                     </div>


                </div>



            </div>
<?php 
    require_once "footer.php";
?>
