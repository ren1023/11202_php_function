<?php

/**
 * 從指定資料表中檢索符合條件的資料。
 *
 * @param string $table 資料表名稱
 * @param mixed $where 條件，可以是字串或關聯陣列
 * @param string $other 額外的 SQL 條件或排序
 * @return array 檢索到的資料陣列
 */
function dball($table = null, $where = '', $other = '')
{
    // SQL 查詢的初始語句
    $sql = "SELECT * FROM `$table` ";
    
    // 建立與資料庫的連線
    $dsn = "mysql:localhost;charset=utf8;dbname=school";
    $pdo = new PDO($dsn, 'root', '');

    // 檢查是否提供了資料表名稱
    if (isset($table) && !empty($table)) {
        // 如果 $where 是陣列，則處理為 WHERE 條件
        if (is_array($where)) {
            if (!empty($where)) {
                foreach ($where as $col => $value) {
                    $tmp[] = "`$col`='$value'";
                }
                // 使用 AND 來結合 WHERE 條件
                $sql .= " WHERE " . join(" AND ", $tmp);
            } else {
                // 如果 $where 陣列為空，則不添加 WHERE 條件
                $sql .= " $where";
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
$rows = dball('students', ['dept' => '3']);

// 輸出查詢結果，用於除錯
dd($rows);



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