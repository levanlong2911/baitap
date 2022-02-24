<?php
/**
 *  5. Bài tập tính S = 1! + 2! + 3! + ... + n! (sử dụng vòng lặp while)
 *  Input :  
 *         + Khai báo n 
 *  Output:
 *         + Kết quả của biểu thức S 
 *  
 *  Algorithm :
 *           . Khai báo biến $n 
 *           . Khai báo biến $total = 0
 *           . Khai báo biến $i     = 1
 *           . Sử dụng 2 vòng lặp while lồng nhau
 *           . Vòng lặp với $i lặp theo điều kiện ($i <= $n)
 *           -> Khai báo biến $j        = 1 (giá trị khởi tạo cho vòng lặp while lồng bên trong)
 *           -> Khai báo biến $multiply = 1 (giá trị của giai thừa) 
 *           . Vòng lặp với $i lặp theo điều kiện ($j <= $i)
 *           --> nhân dồn $multiply với $j
 *           -> Cộng dồn $total với $multiply
 */

$n = 4;
$total = 0;
$i = 1;
$j = 1;
$multiply = 1;
while ($i <= $n) {
    
    while($j <= $i) {
        $multiply *= $j;
        $total += $multiply;
        $j++;
    }
    $i++;
}
echo 'Tổng giai thừa khi n = ' . $n . ' là ' . $total;



// while ($i <= $n){
//     // nhập giá trị n
//     $n = (int)readline('N = 4');
//     // tính giai thừa
//     $i = 1;
//     $factorial = 1;
//     while ($j <= $i) {
//         $factorial *= $i;
//         $i += 1;
//     }
//     // in ra kết quả
//     echo "$n! = $factorial\n";
// }
?>