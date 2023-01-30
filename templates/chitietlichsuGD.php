<?php 
      session_start();
      if(!isset($_SESSION['nguoidung'])||!$_GET['magd'])
      {
          echo"<script>window.location.href='lichsuGD.php'</script>";
      }
    require_once "header.php";
    require_once "menu.php";
?>
<div class="col-md-8">
                <div class="giaodich">
                    <h3>Chi Tiết Giao Dịch</h3>
                    <table class="ctgd" border=1>
                    <?php
                                include_once "../phpFunction/function.php" ;
                                $conn=connect_db();
                                $ma=$_GET['magd'];
                                $sql="SELECT *FROM gdchuyentien,phichuyentien where gdchuyentien.PCT_MA=phichuyentien.PCT_MA AND GDCT_MA='$ma'";
                                $result=mysqli_query($conn,$sql);
                                while($row=mysqli_fetch_assoc($result)){
                                    echo"<tr>";
                                    echo"<td><strong>Tài Khoản Ghi Nợ</strong></td>";
                                    echo"<td>".$row['TKGUI_SO']."</td>";
                                    echo"</tr>";
                                    echo"<tr>";
                                    echo"<td><strong>Tài Khoản ghi có</strong></td>";
                                    echo"<td>".$row['TKNHAN_SO']."</td>";
                                    echo"</tr>";
                                    echo"<tr>";
                                        echo"<td><strong>Số Tiền Giao Dịch</strong></td>";
                                        echo"<td>".$row['GDCT_SOTIEN']."</td>";
                                    echo"</tr>";
                                    echo"<tr>";
                                        echo"<td><strong>Tiền Tệ</strong></td>";
                                        echo"<td>VNĐ</td>";
                                    echo"</tr>";
                                    echo"<tr>";
                                        echo"<td><strong>Nội Dung Giao Dịch</strong></td>";
                                        echo"<td>".$row['GDCT_NOIDUNG']."</td>";
                                    echo"</tr>";
                                    echo"<tr>";
                                        echo"<td><strong>Phí Chuyển</strong></td>";
                                        echo"<td>".$row['PCT_MUCPHI']."</td>";
                                    echo"</tr>";
                                    echo"<tr>";
                                        echo"<td><strong>Ngày Giao Dịch</strong></td>";
                                        echo"<td>".$row['GDCT_NGAY']."</td>";
                                    echo"</tr>";
                                }

                        ?>
                    </table>

                </div>
             
            </div>
<?php 
    require_once "footer.php";
?>
