<?php
/**
 *  3. Tính tổng số nguyên lẻ tử 1 -> n     
 *  Input :  
 *         + Khai báo n 
 *  Output:
 *         + Kết quả của biểu thức S 
 *  
 *  Algorithm :
 *           . Khai báo biến $n 
 *           . Khai báo biến $total = 0
 *           . Sử dụng vòng lặp for 
 *           . Kiểm tra điều kiện nếu $i là số lẻ ( $i % 2 == 1)
 *           -> Cộng dồn biến $total với $i    
 */

$n = 10;
$total = 0;
for($i = 1; $i <= $n; $i++){
    if($i % 2 == 1){
        $total += $i;
    }
    
}
echo $total;
?>