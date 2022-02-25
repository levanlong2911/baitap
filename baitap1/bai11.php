<?php
$array = array('Hoang'=>'31','Nam'=>'41','Minh'=>'39','Hoa'=>'40');
asort($array);
foreach($array as $key => $value){
    echo 'Tên ' . $key . ' và tuổi là: ' . $value . '<br/>';
};
foreach($array as $key => $value){
    $gtln = max($array);
    $gtnn = min($array);
    if($value == $gtln){
        echo 'Tuổi lớn nhất là: ' . $value . ' và tên là: ' . $key . '<br/>';
    }
    echo '<br/>';
    if($value == $gtnn){
        echo 'Tuổi nhỏ nhất là: ' . $value . ' và tên là: ' . $key;
    }
}

?>