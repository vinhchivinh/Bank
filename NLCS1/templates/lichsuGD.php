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
                    <h3>Lịch Sử Giao Dịch</h3>
                    <div class="tb">
                        <h4>Giao Dịch Gần Đây</h4>
                        <hr>
                        <table style="border-collapse: collapse; border: 1px solid black;" border=1>
                            <tr>
                                <th>Ngày</th>
                                <th>Số tài khoản</th>
                                <th>Số Tiền</th>
                                <th>Chi tiết</th>
                            </tr>
                            <?php
                                    include_once "../phpFunction/function.php" ;
                                    $conn=connect_db(); 
                                    $makh=$_SESSION['nguoidung']['KH_MA'];

                                    $sql="SELECT * FROM gdchuyentien,TaiKhoan
                                    where gdchuyentien.TKGUI_SO=TaiKhoan.TK_So
                                    and KH_MA='$makh'";

                                    $sql1="SELECT * FROM gdchuyentien,TaiKhoan
                                    where gdchuyentien.TKNHAN_SO=TaiKhoan.TK_So
                                    and KH_MA='$makh'";
                                    $result=mysqli_query($conn,$sql);
                                    $result1=mysqli_query($conn,$sql1);
                                  /*  while($rows=mysqli_fetch_assoc($result))
                                    {
                                    echo" <tr>";
                                    echo"  <td>".$rows['GDCT_NGAY']."</td>";
                                    echo" <td>".$rows['TK_SO']."</td>";
                                    $tien=$rows['GDCT_SOTIEN'];
                                    money($tien);
                                    echo"<td>-".$tien."</td>";
                                    echo" <td><a href='#'>Xem chi tiết</a></td>";
                                    echo" </tr>";
                                    }*/
                                    $array=array();
                                    $j=0;
                                    while($rows=mysqli_fetch_assoc($result))
                                    {
                                        $array[$j][0]=$rows['GDCT_NGAY'];
                                        $array[$j][1]=$rows['TK_SO'];
                                        $tien=$rows['GDCT_SOTIEN'];
                                        money($tien);
                                        $array[$j][2]="-".$tien;
                                        $array[$j][3]=$rows['GDCT_MA'];
                                        $j=$j+1;
                                    }
                                    while($rows1=mysqli_fetch_assoc($result1))
                                    {
                                        $array[$j][0]=$rows1['GDCT_NGAY'];
                                        $array[$j][1]=$rows1['TK_SO'];
                                        $tien=$rows1['GDCT_SOTIEN'];
                                        money($tien);
                                        $array[$j][2]="+".$tien;
                                        $array[$j][3]=$rows1['GDCT_MA'];
                                        $j=$j+1;
                                    }
                                    sapxeptheoNgay($array,$j,3);
                                    for($i=0; $i<$j;$i++){
                                        echo" <tr>";
                                        echo" <td>".$array[$i][0]."</td>";
                                        echo" <td>".$array[$i][1]."</td>";
                                        echo" <td>".$array[$i][2]."</td>";
                                        echo" <td><a href='chitietlichsuGD.php?magd=".$array[$i][3]."'>Xem chi tiết</a></td>";
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