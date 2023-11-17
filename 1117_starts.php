<style>
* {
    font-family: 'Courier New', Courier, monospace;
    /* line-height: 10px; */
}
</style>

<h2> 正三角形 </h2>

<h2>function 整合 </h2>
<?php
stars (' 正三角形 ',7);
stars (' 矩形 ',7);
stars (' 菱形 ',7);

function stars($shape,$size){
    switch($shape){
       
        case ' 正三角形 ':
            equilateral_triangle($size);
        break;
        case ' 矩形 ':
            rectangle($size);
        break;
        case ' 菱形 ':
            diamond($size);
        break;

            
    }
}

?>
<hr>
<hr>
<?php
$amount=7;
for($i=0;$i<$amount;$i++){
for($j=0;$j<($amount-1-$i);$j++){
    echo "&nbsp;";
}
for($k=0;$k<($i*2+1);$k++){
    echo "*";
}
echo "<br>";
}
?>
<hr>
<?php
equilateral_triangle(5);
equilateral_triangle(9);
equilateral_triangle(11);
equilateral_triangle(13);
equilateral_triangle(15);
// 列印正三角形的星星
function equilateral_triangle ($size){
for($i=0;$i<$size;$i++){
    for($j=0;$j<($size-1-$i);$j++){
        echo "&nbsp;";
    }
    for($k=0;$k<($i*2+1);$k++){
        echo "*";
    }
    echo "<br>";
    }
}
?>

<hr>

<h2> 矩形 </h2>
<?php

for($i=0;$i<$amount;$i++){

    for($j=0;$j<$amount;$j++){
        if($i==0 || $i==($amount-1)){
            echo "*";
        }else if($j==0 || $j==($amount-1)){
            echo "*";
        }else{
            echo "&nbsp;";
        }

    }
    echo "<br>";
}
?>

<?php

rectangle(8);
rectangle(10);


function rectangle($size1){
    for($i=0;$i<$size1;$i++){

        for($j=0;$j<$size1;$j++){
            if($i==0 || $i==($size1-1)){
                echo "*";
            }else if($j==0 || $j==($size1-1)){
                echo "*";
            }else{
                echo "&nbsp;";
            }
    
        }
        echo "<br>";
    }
}


?>

<hr>

<h2> 菱形 </h2>
<?php

$mid=floor(($amount*2 -1)/2);
for($i=0;$i<($amount * 2 -1);$i++){

    if($i<=$mid){
        $tmp=$i;
    }else{
        $tmp--;
    }

    for($j=0;$j<($mid-$tmp);$j++){
        echo "&nbsp;";
    }
    for($k=0;$k<($tmp*2+1);$k++){
        echo "*";
    }
    echo "<br>";
}
?>

<?php

diamond(10);
diamond(20);

function diamond($size2){
    $mid=floor(($size2*2 -1)/2);
    $tmp=0;
    for($i=0;$i<($size2 * 2 -1);$i++){
    
        if($i<=$mid){
            $tmp=$i;
        }else{
            $tmp--;
        }
    
        for($j=0;$j<($mid-$tmp);$j++){
            echo "&nbsp;";
        }
        for($k=0;$k<($tmp*2+1);$k++){
            echo "*";
        }
        echo "<br>";
    }
    
}

?>

