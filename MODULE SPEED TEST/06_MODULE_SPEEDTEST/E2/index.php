<?php
$factor = intval($_GET['factor']);
$arr = [];

for ($i=1; $i < 41; $i++) {
    array_push($arr, $i);
}

echo 'Original Array <br>';
print_r($arr);

for ($i=1; $i < 41; $i++) {
    if ($i % $factor == 0) {
        $arr[$i-1] =  $i . ' is a multiple of ' . $factor . '**';
    }
}

echo '<br>Modified Array <br>';
print_r($arr);
?>