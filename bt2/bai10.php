<?php
/**
 *  10. Bài toán tính tiền taxi với số km cho trước 
 *  Input :  
 *         + 1km đầu giá = 15000 đ 
 *         + từ 1km đến 5km giá = 12000 đ 
 *         + từ 6km trở đi giá  = 90000 đ
 *         + từ 140km trở đi được giảm 12 % tổng tiền
 *  Output:
 *         + Số tiền cần thanh toán
 */

$n = 140;

if($n <= 1){
    $km1 = $n*15000;
    echo 'Với ' . $n . ' km đã đi thì số tiền cần thanh toán là: ' . $km1 . 'đ';
}elseif($n <= 5){
    $km5 = 1*15000 + ($n-1)*12000;
    echo 'Với ' . $n . ' km đã đi thì số tiền cần thanh toán là: ' . $km5 . 'đ';
}elseif($n >= 6 && $n < 140){
    $km6 = 1*15000 + 4*12000 + (($n-5)*9000);
    echo 'Với ' . $n . ' km đã đi thì số tiền cần thanh toán là: ' . $km6 . 'đ';
}elseif($n >= 140){
    $km6 = 1*15000 + 4*12000 + (($n-5)*9000);
    $km140 = ($km6 - ($km6*12/100));
    echo 'Với ' . $n . ' km đã đi thì số tiền cần thanh toán là: ' . $km140 . 'đ';
}

?>