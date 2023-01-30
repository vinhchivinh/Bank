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
                <form class="content-right" action="xacnhanChuyenTien.php" method="POST">
                    <h3>CHUYỂN TIỀN NỘI BỘ NGÂN HÀNG</h3>
                    <div class="tb-chuyentien">
                        <div class="tb-chuyentien1">
                        <h4>Hình Thức Chuyển</h4>
                            <hr>
                            <table>
                                <tr>
                                    <td><b>Hình Thức Chuyển</b></td>
                                    <td>
                                            <select id="hinhthucchuyen" name="hinhthuc">
                                              <option>--------------Chọn---------------</option>
                                            <?php  
                                             include_once "../phpFunction/function.php" ;
                                             $conn=connect_db(); 
                                             $ma=$_SESSION['nguoidung']['KH_MA'];
                                             $sql="SELECT* FROM HINHTHUCCHUYEN";
                                             $result=mysqli_query($conn,$sql);
                                             while($rows=mysqli_fetch_assoc($result)){
                                                echo"<option>".$rows['HTC_TEN']."</option>";
                                             }
                                            ?>
                                            </select>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="tb-chuyentien1">
                            <h4>Thông tin người chuyển</h4>
                            <hr>
                            <table>
                                <tr>
                                    <td><b>Tài khoản ghi nợ</b></td>
                                    <td>
                                            <select id="tentaikhoan" name="tkgn">
                                              <option>--------------Chọn---------------</option>
                                            <?php  
                                             include_once "../phpFunction/function.php" ;
                                             $conn=connect_db(); 
                                             $ma=$_SESSION['nguoidung']['KH_MA'];
                                             $sql="SELECT* FROM TaiKhoan where KH_MA='$ma'";
                                             $result=mysqli_query($conn,$sql);
                                            while($rows=mysqli_fetch_assoc($result)){
                                                echo"<option>".$rows['TK_SO']."</option>";
                                             }
                                            ?>
                                            </select>
                                       
                                    </td>
                                </tr>
                                <td>
                                    <tr>
                                        <td><b>Số dư khả dụng</b></td>
                                        <td id="sodu"></td>
                                    </tr>

                                </td>
                            </table>

                        </div>
                        <div class="tb-chuyentien2">
                            <h4>Thông tin người nhận</h4>
                            <hr>
                            <table>
                                <tr>
                                    <td><b>Tài khoản ghi có</b></td>
                                    <td>
                                        <input name="tkn"type="text" style="width: 200px;" placeholder="số tài khoản">
                                    </td>
                                </tr>
                              <!--  <tr>
                                    <td><b>Tên người hưởng</b></td>
                                    <td><input type="text" disabled></td>
                                </tr>-->


                            </table>

                        </div>
                        <div class="tb-chuyentien3">
                            <h4>Thông tin chuyển tiền</h4>
                            <hr>
                            <table>
                                <tr>
                                    <td><b id="noidung">Nội Dung chuyển tiền</b></td>
                                    <td>
                                        <textarea cols="23" rows="2" name="noidungchuyen">

                               </textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Số tiền chuyển</b></td>
                                    <td>
                                        <input name="sotienchuyen"id="sotienchuyen"type="text" style="width:200px">VNĐ
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Phí chuyển</b></td>
                                    <td>
                                        <select id="phichuyen" name="phichuyentien"style="width: 200px;">
                                        <?php
                                          include_once "../phpFunction/function.php" ;
                                          $conn=connect_db(); 
                                          $sql="SELECT *FROM phichuyentien";
                                          $result=mysqli_query($conn,$sql);
                                          while ($rows=mysqli_fetch_assoc($result))
                                          {
                                            echo"<option>".$rows['PCT_TEN']."</option>";
                                          }
                                    ?>
                                        </select>
                                    </td>
                                </tr>


                            </table>


                        </div>
                        <div>
                            <button class="btn btn-primary" type="submit" name="chuyentien">Xác Nhận</button>

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
</script>
<?php
    require_once "footer.php";

?>