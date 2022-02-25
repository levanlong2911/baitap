<?php
$S1 = 'thân';
$S2 = 'Bạn thân thời còn đi học';
if(strpos($S1, $S2) !== false){
    echo 'Chuổi S2 có chứa chuổi S1 "thân"';
}else{
    echo 'Chuổi S2 không chứa chuổi S1 "thân"';
}
?>