<?php
/**
 *  9. Bài tập in bảng cửu chương bằng vòng lặp for
 * 
 */
for($i = 1; $i < 10; $i++) {
    for($j = 1; $j <= 10; $j++) {
        echo $i . ' x ' . $j . ' = ' . $i*$j . '<br/>';
    }
    echo '<br />';
}
?>