<?php
date_default_timezone_get();
$dsn = "mysql:localhost;charset=utf8;dbname=$db";
$pdo = new PDO($dsn, 'root', '');


$up=dball('students',['dept'=>'3']);

//$rows=all('students',['dept'=>'3']);
//$row=find('students',10);
//$row=find('students',['dept'=>'1','graduate_at'=>'23']);
//$rows=all('students',['dept'=>'1','graduate_at'=>'23']);
//echo "<h3> 相同條件使用 find ()</h3>";
//dd($row);
//echo "<hr>";;
//echo "<h3> 相同條件使用 all ()</h3>";
//dd($rows);
// $up = update ("students", '3', ['dept' => '16', 'name' => ' 張明珠 ']);
//insert ('dept',['code'=>'101','name'=>' 織品科 ']);
del('dept',11);
// dd($up); //
?>


<?php
// 連線至資料庫的 function
function connect($db){
    $dsn = "mysql:localhost;charset=utf8;dbname=$db";
    $pdo = new PDO($dsn, 'root', '');
    return $pdo;
}
?>
<?php
/**
 * 從指定資料表中檢索符合條件的資料。
 *
 * @param string $table 資料表名稱
 * @param mixed $where 條件，可以是字串或關聯陣列
 * @param string $other 額外的 SQL 條件或排序
 * @return array 檢索到的資料陣列
 */
function dball ($table = null, $where = '', $other = '')// 當 $other 預設為空值時，在使用函數時，可以不給定值。
{
    // SQL 查詢的初始語句
    $sql = "SELECT * FROM `$table` ";
    // 將資料庫連線的程式寫在外面，透過使用 global，呼叫變數。
    global $pdo;
    // 檢查是否提供了資料表名稱
    if (isset($table) && !empty($table)) {
        // 如果 $where 是陣列，則處理為 WHERE 條件
        if (is_array($where)) {
            if (!empty($where)) {
                foreach ($where as $col => $value) {
                    $tmp[] = "`$col`='$value'";
                }
                // 使用 AND 來結合 WHERE 條件
                $sql .= " where " . join(" && ", $tmp); 
            } else {
                // 如果 $where 陣列為空，則不添加 WHERE 條件
                $sql .= " $where ";
            }
        }
        // 添加額外的 SQL 條件或排序
        $sql .= $other;
        // 執行 SQL 查詢，並將結果以關聯陣列形式存儲在 $rows 變數中
        $rows = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        // 返回檢索到的資料陣列
        return $rows;
    } else {
        // 如果未提供資料表名稱，輸出錯誤訊息
        echo "請輸入正確的資料表名稱";
    }
}
// 使用 dball 函數查詢資料表'students' 中 'dept' 為 '3' 的資料
// $rows = dball('students', ['dept' => '3']);
?>
<hr>
<h2>find ()- 會回傳資料表指定 id 的資料 </h2>
<?php
function find($table, $id)
{
    // 建立與資料庫的連線
    global $pdo;
    $sql = "select * from `$table` where `id`='$id'";
    if (is_array($id)) {
        foreach ($id as $col => $value) {
            $tmp[] = "`$col`='$value'";
        }
        $sql .= " where " . join(" && ", $tmp);
    } elseif (is_numeric($id)) {
        $sql .= " where `id`='$id'";
    } else {
        echo "錯誤：參數的資料型態必須是數字或陣列"; // 修正此行的引號和結束字串
    }
    $row = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    return $row;
}
?>
<hr>
<h2>update ()- 給定資料表的條件後，會去更新相應的資料。</h2>
<?php
function update($table, $id, $cols)
{
    $pdo=connect('school');
    $sql = "update `$table` set ";
    if (!empty($cols)) {
        foreach ($cols as $col => $value) {
            $tmp[] = "`$col`='$value'";
        }
    } else {
        echo "錯誤：缺少要編輯的欄位陣列";
    }
    $sql .= join(",", $tmp);
    $tmp=[];
    if (is_array($id)) {
        foreach ($id as $col => $value) {
            $tmp[] = "`$col`='$value'";
        }
        $sql .= " where " . join(" && ", $tmp);
    } else if (is_numeric($id)) {
        $sql .= " where `id`='$id'";
    } else {
        echo "錯誤：參數的資料型態比須是數字或陣列";
    }
    echo $sql;
    return $pdo->exec ($sql); // 執行結果是回傳數字，表示影響的資料筆數。
}
?>
<hr>
<h2>insert ()- 給定資料內容後，會去新增資料到資料表 </h2>
<?php
function insert ($table,$values){
    $pdo=connect('school');
    $sql = "insert into  `$table` ";
    // $cols ="(``,``,``,``,``)";
    $cols="(`".join("`,`",array_keys($values))."`)";
    // $vals="('','','','','')";
    $vals="('".join("','",array_values($values))."')";
    $sql=$sql.$cols." values ".$vals;
    return $pdo->exec($sql);
}
?>
<hr>
<h2>del ()- 給定條件後，會去刪除指定的資料 </h2>
<?php
function del($table,$id){
    include "pdo.php";
    $sql = "delete from `$table` where ";
    if (is_array($id)){
        foreach ($id as $col => $value) {// 轉成 sql 條件式所需要的字串 
            $tmp[] = "`$col`='$value'";
        }
        $sql .=  join(" && ", $tmp);
    } else if (is_numeric($id)) {
        $sql .= " `id`='$id'";
    } else {
        echo "錯誤：參數的資料型態比須是數字或陣列";
    }
    echo $sql;
    return $pdo->exec ($sql); // 
}
?>
<?php
function my_foreach($id){
    foreach ($id as $col => $value) {// 轉成 sql 條件式所需要的字串 
        $tmp[] = "`$col`='$value'";
    }
}
?>
<?php
/**
 * 輸出陣列的內容，用於除錯目的。
 *
 * @param array $array 要輸出的陣列
 */
function dd($array)
{
    // 在網頁上顯示一個格式化的陣列
    echo "<pre>";
    print_r($array);
    echo "<pre>";
}
?>