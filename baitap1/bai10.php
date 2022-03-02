<?php
$array = array('0', '1', '2', '3', '4');
echo 'Độ dài của mảng là: ' . count($array) . '<br />';
print_r($array);
echo '<br/>';
array_shift($array);
print_r($array);
unset($array[3]);
print_r($array);
echo '<br />';
$array[] = '3';
print_r($array);


?>