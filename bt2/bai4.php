<?php
/**
 *  4. Tính tổng số nguyên chẵn tử 1 -> n     
 *  Input :  
 *         + Khai báo n 
 *  Output:
 *         + Kết quả của biểu thức S 
 *  
 *  Algorithm :
 *           . Khai báo biến $n 
 *           . Khai báo biến $total = 0
 *           . Sử dụng vòng lặp for 
 *           . ở biểu thức 3 của vòng lặp for gán $i = $i + 2 
 *           . Cộng dồn biến $total với $i    
 */

$n = 10;
$total = 0;
for($i = 0; $i <= $n; $i = $i + 2) {
    
    $total += $i;
    
}
echo $total;
?>