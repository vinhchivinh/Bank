<?php 
    session_start();
    if(!isset($_SESSION['nguoidung']))
    {
        echo"<script>window.location.href='login.php'</script>";
    }
    require_once "header.php";
    require_once "menu.php";
    if(!isset($_GET['tktk'])){
        echo"<script>window.location.href='danhsachTK.php'</script>";
    }
?>
<div class="col-md-8">
               <div class="thongtinchitietTK">
                   <h3>Thông Tin Tiết Kiệm</h3>
                   
                       <div class="ttctTietKiem">
                        <table>
                    <?php
                        include_once "../phpFunction/function.php" ;
                        $conn=connect_db();
                        $tktk=$_GET['tktk'];
                        $sql="SELECT *FROM motietkiem,hinhthuclai,kyhan where motietkiem.HTL_MA=hinhthuclai.HTL_MA AND motietkiem.KHAN_MA=kyhan.KHAN_MA and TKTK_SO='$tktk'";
                        $result=mysqli_query($conn,$sql);
                        while($row=mysqli_fetch_assoc($result)){
                        echo" <tr>";
                                echo"  <th>Tài Khoản Mở Tiết Kiệm</th>";
                                echo"<td>".$row['TKMOTK_SO']."</td>";

                        echo"</tr>";
                        echo"<tr>";
                            echo"<th>Số Tài Khoản TK</th>";
                            echo"<td>".$row['TKTK_SO']."</td>";
                        echo"</tr>";
                        echo"<tr>";
                            echo"<th> Số Tiền Gửi</th>";
                            echo"<td>".$row['MTK_SOTIEN']."</td>";
                        echo"</tr>";
                        echo"<tr>";
                            echo"<th> Kỳ Hạn</th>";
                            echo"<td>".$row['KHAN_TEN']."</td>";
                            echo"</tr>";
                        echo"<tr>";
                            echo"<th> Lãi Suất</th>";
                            echo"<td>".$row['KHAN_LAISUAT']."</td>";
                        echo"</tr>";
                        echo"<tr>";
                                echo"<th>Hình Thức Lãi</th>";
                                echo"<td>".$row['HTL_TEN']."</td>";
                            
                        echo"</tr>";
                        echo"<tr>";
                            echo"<th> Ngày Gửi</th>";
                            echo"<td>".$row['MTK_NGAY']."</td>";
                        echo"</tr>";
                        echo"<tr>";
                            echo"<th> Ngày Kết Thúc</th>";
                            $ngay=$row['MTK_NGAY'];
                            $tg=$row['KHAN_MA'];
                            $newdate = strtotime ( '+'.$tg.'month' , strtotime ( $ngay ) ) ;
                            $newdate = date ( 'Y-m-j' , $newdate );
                            echo"<td>".$newdate."</td>";
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
