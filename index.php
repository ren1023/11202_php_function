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
<p>&nbsp;</p>
<hr>

<h2> 不定參數的法用 </h2>
<?php
function sum2(...$arg){
    $sum=0;
    foreach($arg as $num){
        if(is_numeric($num)){
            $sum+=$num;
        }
    }
    return $sum;
}
echo "給定 2 個參數".sum2 (1,2);
echo "<br>";
echo "給定 3 個參數".sum2 (1,2,5);
echo "<br>";
echo "給定 4 個參數".sum2 (1,2,5,7);
echo "<br>";
?>
<p>&nbsp;</p>

<hr>
<h2> 自訂函式預設值 </h2>

<?php

function sum3($a,$b,$c=3){
    $sum=($a+$b)*$c;

    echo "$a.$b, 倍數 $c <br>";
    return $sum;
}

echo "總和是". sum3 (10,15);
echo "<br>";
echo "總和是". sum3 (10,15,10);
?>


