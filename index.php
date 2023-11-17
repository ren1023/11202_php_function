<?php
// 自定函式

$c=20;
function sum($a,$b){
    global $c;// 引用 function 外的變數
    $sum=$a+$b;
    echo "輸入:".$a."、".$b;
    echo "<br>";
    
    return $sum;
}

$sum=sum(10,20);
echo "總和：是". $sum;
echo "<hr>";

$sum=sum(17,22);
echo "總和：是". $sum;
echo "<hr>";

$sum=sum(56,77);


?>