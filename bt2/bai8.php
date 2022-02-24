<?php
/**
 *  8. Vẽ tam giác cân
 *  Input :  
 *         + Khai báo width, height 
 *  Output:
 *         + Vẽ tam giác cân
 *  
 *  Algorithm :
 *           . Khai báo width , height 
 *           . Sử dụng hai vòng lặp while lồng nhau   
 *           . Vòng lặp while với điều kiện $i <= $height    
 */

        /**   0001
         *    00111                   h = 4  đáy = 7   
         *    011111
         *    1111111
         */
$width = 7;
$height = 4;
$i = 1;
while ($i <= $height){
    $j = $i;
    while ($j < $width){
        echo '0';
        $j++;
    }
    $j = 1;
    while ($j <= (2 * $i - 1)){
        echo '1';
        $j++;
    }
    $i++;
    echo '<br />';
}

?>