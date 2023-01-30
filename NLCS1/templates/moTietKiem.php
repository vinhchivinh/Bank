
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
               <form method="POST" action="xacnhanMTK.php">
                   <div class="motietkiem">
                       <h3>Mở Tài Khoản Tiết Kiệm</h3>
                       <div>
                           <div class="tkm">
                                <h4>Tài Khoản Mở Tiết Kiệm</h4>
                                <hr>
                                <table>
                                <tr>
                                    <td style="width:300px"><b>Tài khoản thanh toán nguồn</b></td>
                                    <td>
                                            <select id="tentaikhoan" name="taikhoannguon">
                                              <option>--------------Chọn---------------</option>
                                            <?php  
                                             include_once "../phpFunction/function.php" ;
                                             $conn=connect_db(); 
                                             $ma=$_SESSION['nguoidung']['KH_MA'];
                                             $sql="SELECT* FROM TaiKhoan where KH_MA='$ma'and LTK_MA=1";
                                             $result=mysqli_query($conn,$sql);
                                            while($rows=mysqli_fetch_assoc($result)){
                                                echo"<option>".$rows['TK_SO']."</option>";
                                             }
                                            ?>
                                            </select>
                                       
                                    </td>
                                </tr>
                                <tr>
                                        <td><b>Số dư khả dụng</b></td>
                                        <td id="sodu"></td>
                                </tr>
                            </table>

                           </div>
                           <div class="tttkm">
                            <h4>Thông Tin Giao Dịch</h4>
                            <hr>
                            <table>
                                <tr>
                                    <td>Loại Tài Khoản</td>
                                    <td>Tiết Kiệm Có Kì Hạn</td>
                                </tr>
                                <tr>
                                    <td>Kì Hạn Gửi</td>
                                    <td>
                                        <select id="kihanten" name="kihant">
                                            <option>------------Chọn------------</option>
                                             <?php
                                             include_once "../phpFunction/function.php" ;
                                             $conn=connect_db(); 
                                             $sql="SELECT*FrOM kyhan";
                                             $result=mysqli_query($conn,$sql);
                                             while($rows=mysqli_fetch_assoc($result)){
                                                echo"<option>".$rows['KHAN_TEN']."</option>";
                                             }
                                             

                                             ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Lãi suất</td>
                                    <td id="kihan" value="0"></td>
 
                                </tr>
                                <tr>
                                    <td>Số Tiền Gửi</td>
                                    <td><input type="text" name="tiengui"></td>
 
                                </tr>
                                <tr>
                                    <td>Hình Thức Trả Lãi</td>
                                    <td>
                                        <select name="hinhthuclai">
                                            <?php
                                                include_once "../phpFunction/function.php" ;
                                                $conn=connect_db(); 
                                                $sql="SELECT * from hinhthuclai";
                                                $result=mysqli_query($conn,$sql);
                                                while($rows=mysqli_fetch_assoc($result)){
                                                   echo"<option>".$rows['HTL_TEN']."</option>";
                                                }
                                               
                                            ?>
                                        </select>
                                    </td>
                                </tr>
 
                            </table>

                           </div>
                
                         
                           
                       </div>
                       <div style="margin-left: 70%; margin-top:0px">
                           <input type="submit" class="btn btn-primary" value="Xác Nhận" name="xacnhanmotk">
                       </div>
                      
                   </div>
               </form>
            </div>
<script>
jQuery(document).ready(function($){
        $('#tentaikhoan').change(function(event){
            stentaikhoan=$("#tentaikhoan").val();
            $.post("sodu.php",{"Stentaikhoan":stentaikhoan},function(data){
                $("#sodu").html(data);
            });
        });
    });
    jQuery(document).ready(function($){
        $('#kihanten').change(function(event){
            kihans=$("#kihanten").val();
            $.post("kihan.php",{"kihanj":kihans},function(data){
                $("#kihan").html(data);
            });
        });
    });
</script>
<?php 
    require_once "footer.php";
?>
