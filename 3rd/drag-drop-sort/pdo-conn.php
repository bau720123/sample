<?php
/**
 * PDO 資料庫連結設置
 */

try {
    $dbConn = new PDO(
        "mysql:host=localhost;dbname=test",
        'root',
        '720123bau',
        array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES UTF8")
    );
}
catch (PDOException $e) {
    echo "PDO 連線失敗，請確認設定！";
}

