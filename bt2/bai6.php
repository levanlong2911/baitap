<?php
/***
 *  6. Kiểm tra một số có phải là số nguyên tố hay không (sử dụng vòng lặp while)
 *  Input :  
 *         + Khai báo number 
 *  Output:
 *         + Xác định $number có phải là số nguyên tố hay không ?
 *  
 *  Algorithm :
 *           - Số nguyên tố là số chia hết cho một và chính nó 
 *           . Khai báo biến $number 
 *           . Khai báo biến $i       = 1
 *           . Khai báo biến $isPrime = true
 *           . Sử dụng vòng lặp while 
 *           . Lặp với theo điều kiện ($i < $number)
 *           -> Kiểm tra điều kiện $number % $i == 0 => gán $isPrime = false và break thoát khỏi vòng lặp while
 *           -> Nếu điều kiện $number % $i == 0 không xảy ra => $isPrime = true không thay đổi
 *           . Kiểm tra điều kiện $isPrime 
 *           -> true  => $number là số nguyên tố
 *           -> false => $number không phải là số nguyên tố
 */
// $number = 2;
// $i = 1;
// $isPrime = true;
// while ($i < $number) {
//     if($number % $i == 0) {
//         $isPrime = false;
//         break;
//     }else{
//         $isPrime = true;
//     }
//     $i++;
// } 
// if($isPrime == true) {
//     echo $number . ' là số nguyên tố';
// }else{
//     echo $number . ' không phải là số nguyên tố';
// }

function soNT($n){
    if($n < 2){
        return false;
    }
    for($i = 2; $i < sqrt($n); $i++){
        if($n % $i == 0){
            return false;
        }
    }
    return true;
}
$n = 2;
if(soNT($n) == true) {
    echo $n . ' là số nguyên tố';
}else{
    echo $n . ' không phải là số nguyên tố';
}

?>