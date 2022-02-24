<?php
/**
 *  1. Bài tập tính tổng : S = 1 + 2 + 3 + 4 + ... + n  
 *  Input :  
 *         + Khai báo n 
 *  Output:
 *         + Kết quả của biểu thức S 
 *  
 *  Algorithm :
 *           . Khai báo biến $n 
 *           . Khai báo biến $total = 0
 *           . Sử dụng vòng lặp for 
 *           . Cộng dồn biến $total qua mỗi bước lặp   
 */

$n = 10;
$total = 0;
for($i = 1; $i <= $n; $i++){
    $total += $i;

}
echo 'Tổng là: ' . $total;
?>