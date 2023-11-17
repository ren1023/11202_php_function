<?php
// $rows=all();
// $rows = dball('students', ['dept'=>'1'],'order by id desc');
// $rows = dball('students','order by id desc');
$rows=dball('students',['dept'=>'3']);
dd($rows);
// function all()
// {
//     $dsn = "mysql:localhost;charset=utf8;dbname=school";
//     $pdo = new PDO($dsn, 'root', '');
//     $sql = "select * from `students`";
//     $row = $pdo->query($sql)->fetchAll();
   
//     return $row;
// }


function dball($table = null, $where = '',$other=''){
    $sql="select * from `$table` ";
    $dsn = "mysql:localhost;charset=utf8;dbname=school";
    $pdo = new PDO($dsn, 'root', '');
    if (isset($table) && !empty($table)) {
        if (is_array($where)) {
            if (!empty($where)) {
                foreach ($where as $col => $value) {
                    // echo $col . ": " . $value . "<br>";
                    $tmp[] = "`$col`='$value'";
                }
                $sql.=" where ".join(" && ",$tmp);
            }  else {
            $sql .= " $where";
        }

        $sql.=$other;
        // echo $sql;
        // $row = $pdo->query($sql)->fetchAll();
        $rows = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    } else {
        echo "請輸入正確認資料表名稱";
    }
}
}
function dd($array)
{
    echo "<pre>";
    print_r($array);
    echo "<pre>";
}
?>