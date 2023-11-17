<?php
// $rows=all();
$rows = dball('dept');
dd($rows);
function all()
{
    $dsn = "mysql:localhost;charset=utf8;dbname=school";
    $pdo = new PDO($dsn, 'root', '');
    $sql = "select * from `students`";
    $row = $pdo->query($sql)->fetchAll();
    return $row;
}
function dd($array)
{
    echo "<pre>";
    print_r($array);
    echo "<pre>";
}
function dball($tname = null)
{
    $dsn = "mysql:localhost;charset=utf8;dbname=school";
    $pdo = new PDO($dsn, 'root', '');
    if (isset($tname) && !empty($tname)) {
        $sql = "select * from `$tname`";
        $row = $pdo->query($sql)->fetchAll();
        return $row;
    } else {
        echo "請輸入正確認資料表名稱";
    }
}
