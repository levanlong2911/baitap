<?php
/**
 *  2. Tính tổng : S = 1 + 1*2 + 1*2*3 + 1*2*3*4 + ... + 1*2*3*4*...*n  
 *  Input :  
 *         + Khai báo n 
 *  Output:
 *         + Kết quả của biểu thức S 
 * 
 *  Algorithm :
 *           . Khai báo biến $n 
 *           . Khai báo biến $total    = 0
 *           . Sử dụng vòng lặp for lồng 
 *           . Với i số lần lặp bằng $n 
 *           . Khai báo biến $multiply = 1  (phép nhân với 1 = chính nó với 0 = 0)
 *           . Với j số lần lặp bằng $i 
 *           . Nhân dồn biến $multiply với $j qua mỗi bước lặp $j   
 *           . Cộng dồn biến $total với $multiply qua mỗi bước lặp $i   
 */

$n = 3;
$total = 0;
for($i = 1; $i <= $n; $i++){
    $multiply = 1;
    for($j = 1; $j <= $i; $j++){
        $multiply *= $j;
    }
    $total += $multiply;
}
echo 'Tổng là: ' . $total;
?>