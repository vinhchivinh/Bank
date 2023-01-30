<?php
    function connect_db(){
        $sever="localhost";
        $user="root";
        $pass="";
        $db="quanlygiaodich";

        $connect=mysqli_connect($sever,$user,$pass,$db);
        return $connect;
}
    function count_row($rows){
        $count=mysqli_num_rows($rows);
        return $count;
    }
    function insert($x,$a,&$A){
      
        for($i=strlen($A);$i>=$x;$i--){
          $A[$i]=$A[$i-1];
        }
        $A[$x-1]=$a;
    }
    function money(&$m)
    {
        $m=(string)$m;
        $index=strlen($m);
       // echo"$index";
        while($index>3)
        {
            $index=$index-3;
            insert($index+1,'.',$m);
           
        }
    }


function chuyentienthanhChu($sotien)
{
        $text=array("không", "Một", "Hai", "Ba", "Bốn", "Năm", "Sáu", "Bảy", "Tám", "Chín");
        $donvi =array("","Nghìn", "Triệu", "Tỷ", "Ngàn tỷ", "Triệu tỷ", "Tỷ Tỷ");
        $textnumber = "";
        $length = strlen($sotien);
        for ($i = 0; $i < $length; $i++)
        $d[$i] = 0;
        for ($i = 0; $i < $length; $i++)
        {
            $so = substr($sotien, $length - $i -1 , 1);
            if ( ($so == 0) && ($i % 3 == 0) && ($d[$i] == 0)){
                for ($j = $i+1 ; $j < $length ; $j ++)
                {
                    $so1 = substr($sotien,$length - $j -1, 1);
                    if ($so1 != 0){
                        break;}
                }
              
                if (intval(($j - $i )/3) > 0){
                    //echo intval(($j - $i )/3) ;echo"<br>";
                  //  echo"$i";
                    for ($k = $i ; $k <intval(($j-$i)/3)*3 + $i; $k++)
                       { $d[$k] =1;
                       }
                }
            }
        }
        for ($i = 0; $i < $length; $i++)
        {
            $so = substr($sotien,$length - $i -1, 1);
            if ($d[$i] ==1)
           {continue;}

            if ( ($i% 3 == 0) && ($i > 0))
           {$textnumber = $donvi[$i/3] ." ". $textnumber;}

            if ($i % 3 == 2 )
            {$textnumber = 'trăm ' . $textnumber;}

            if ($i % 3 == 1)
           { $textnumber = 'mươi ' . $textnumber;}
            $textnumber = $text[$so] ." ". $textnumber;
        }
        $textnumber = str_replace("không mươi", "lẻ", $textnumber);
        $textnumber = str_replace("lẻ không", "", $textnumber);
        $textnumber = str_replace("mươi không", "mươi", $textnumber);
        $textnumber = str_replace("một mươi", "mười", $textnumber);
        $textnumber = str_replace("mươi năm", "mươi lăm", $textnumber);
        $textnumber = str_replace("mươi một", "mươi mốt", $textnumber);
        $textnumber = str_replace("mười năm", "mười lăm", $textnumber);
       // echo  $unread[2];

        return $textnumber;
}
    function thucthiSQL($conn,$sql){
        $results=mysqli_query($conn,$sql);
        return $results;
     }
     function doicho(&$a, &$b){
        $temp=$b;
        $a=$b;
        $b=$temp;
     }
     function sapxeptheoNgay(&$a,$n,$i){
            for($j=0; $j<$n-1; $j++){
                for($x=$j+1;$x<$n;$x++){
                    if($a[$j][$i]<$a[$x][$i])
                    {
                        doicho($a[$j],$a[$x]);
                    }
                }
            }
     }
    

 
   
?>