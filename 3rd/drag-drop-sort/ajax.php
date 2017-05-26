<?php
/**
 * AJAX 更新排序
 */

if (isset($_REQUEST['data'])) {
    // PDO 連結
    include_once 'pdo-conn.php';

    $sql = 'UPDATE drag_drop
            SET sort = :sort
            WHERE ID = :ID';

    $stmt = $dbConn->prepare($sql);

    // 更新所有資料排序
    foreach ($_REQUEST['data'] as $key => $value) {
        $stmt->execute(array(
            'sort'  => $key,
            'ID'    => $value
        ));
    }
}
