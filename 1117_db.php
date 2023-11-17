<?php
// $rows=all();
$rows = dball('students', ['dept'=>'1']);
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
function dball($table = null, $where = ''){
    $sql="select * from `$table` ";
    $dsn = "mysql:localhost;charset=utf8;dbname=school";
    $pdo = new PDO($dsn, 'root', '');
    if (isset($table) && !empty($table)) {
        if (is_array($where)) {
            if (!empty($where)) {
                foreach ($where as $col => $value) {
                    echo $col . ": " . $value . "<br>";
                    $tmp[] = "`$col`='$value'";
                }
                $sql.=" where ".join(" && ",$tmp);
            }  else {
            $sql .= " $where";
        }
        // echo $sql;
        // $row = $pdo->query($sql)->fetchAll();
        $row = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    } else {
        echo "請輸入正確認資料表名稱";
    }
}
}
