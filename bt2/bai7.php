<?php
/**
 *  7. In ra tất cả số nguyên tố nhỏ hơn n (sử dụng vòng lặp for)
 *  Input :  
 *         + Khai báo number 
 *  Output:
 *         + Xác định $number có phải là số nguyên tố hay không ?
 *  
 *  Algorithm :
 *           - Số nguyên tố là số chia hết cho một và chính nó 
 *           . Khai báo biến $n 
 *           . Khai báo chuỗi $listPrime = ''
 *           . Sử dụng vòng lặp for với điều kiện ($i < $n)
 *           -> Gán $isPrime = true 
 *           . Sử dụng vòng lặp for với điều kiện ($j < $i)
 *           . Kiểm tra điều kiện $i % j != 0 
 *           -> true  => continue bỏ qua bước lặp hiện tại
 *           -> false => thực thi câu lệnh tiếp theo gán $isPrime = false
 *           . Quay lại vòng lặp for với điều kiện ($j < $i)
 *           . Kiểm tra điều kiện $isPrime 
 *           -> true  => Nối chuỗi $i vào $listPrime
 *           -> false => thì thôi :)
 */
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

$n = 10;
echo 'Các số nguyên tố nhỏ hơn ' . $n . ' là: ';
if($n >= 2){
   echo '2';
}
for ($i = 3; $i < $n; $i+=2) {
    if(soNT($i)){
        echo ' ' . $i;
    }
}


?>
