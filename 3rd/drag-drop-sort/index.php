<?php
/**
 * 資料庫設置
 */

// PDO 連結
include_once 'pdo-conn.php';

// 產生 Table、Data
$sql = "
CREATE TABLE drag_drop (
    ID INT UNSIGNED NOT NULL AUTO_INCREMENT,
    sort TINYINT UNSIGNED NOT NULL,
    name CHAR(5) NOT NULL,
    height TINYINT UNSIGNED NOT NULL,
    weight TINYINT UNSIGNED NOT NULL,
    PRIMARY KEY  (ID)
)
ENGINE = InnoDB
CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

INSERT INTO drag_drop (sort, name, height, weight)
VALUES (0, 'Jacky', 172, 54),
        (1, 'Kevin', 175, 60),
        (2, 'Mary', 164, 45),
        (3, 'Carrie', 160, 52),
        (4, 'Kay', 167, 48);";

$dbConn->exec($sql);

// 查詢資料
$stmt = $dbConn->query('SELECT *
                        FROM drag_drop
                        ORDER BY sort');
?>

<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>JavaScript 表格拖放排序 AJAX 資料庫 for PHP</title>

    <!-- Google jQuery 引用 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

    <style>
    #draggable {
        background-color: #222222;
        border: 1px solid #cccccc;
        border-collapse: collapse;
        color: #ffffff;
        text-align: center;
        width: 100%;
    }
    #draggable th {
        background-color: #ff5722;
        border: 1px solid #cccccc;
        color: #ffffff;
        padding: 5px;
    }
    #draggable td {
        border: 1px solid #cccccc;
        cursor: move;
        padding: 5px;
    }
    </style>
</head>
<body>

<h1>JavaScript 表格拖放排序 AJAX 資料庫 for PHP</h1>

<table id="draggable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Sort</th>
            <th>Name</th>
            <th>Height</th>
            <th>Weight</th>
        </tr>
    </thead>
    <tbody>

        <?php
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '
        <tr class="data" draggable="true">
            <td class="id">' . $row['ID'] . '</td>
            <td class="sort">' . $row['sort'] . '</td>
            <td>' . $row['name'] . '</td>
            <td>' . $row['height'] . '</td>
            <td>' . $row['weight'] . '</td>
        </tr>';
        }
        ?>

    </tbody>
</table>

<script type="text/javascript">
/*
 * HTML Drag and Drop API（拖、放操作 API）
 */
var dragged;  // 保存拖動元素的引用（ref.），就是拖動元素本身

// 當開始拖動一個元素或一個選擇文本的時候 dragstart 事件就會觸發（設定拖動資料和拖動用的影像，且當從 OS 拖動檔案進入瀏覽器時不會觸發）
document.addEventListener('dragstart', function(event) {
    dragged = event.target;
    event.target.style.backgroundColor = 'rgba(240, 240, 240, 0.5)';
    event.target.style.color = 'rgba(255, 255, 255, 0.5)';
}, false);

// 不論結果如何，拖動作業結束當下，被拖動元素都會收到一個 dragend 事件（當從 OS 拖動檔案進入瀏覽器時不會觸發）
document.addEventListener('dragend', function(event) {
    // 重置樣式
    event.target.style.backgroundColor = '#222222';
    event.target.style.color = '#ffffff';
}, false);

// 當一個元素或者文本被拖動到有效放置目標 dragover 事件就會一直觸發（每隔幾百毫秒）
// 絕大多數的元素預設事件都不准丟放資料，所以想要丟放資料到元素上，就必須取消預設事件行為
// 取消預設事件行為能夠藉由呼叫 event.preventDefault 方法
document.addEventListener('dragover', function(event) {
    // 阻止預設事件行為
    event.preventDefault();
}, false);

// 當拖動的元素或者文本進入一個有效的放置目標 dragenter 事件就會觸發
document.addEventListener('dragenter', function(event) {
    // 當拖動的元素進入可放置的目標（自訂符合條件），變更背景顏色
    // 自訂條件：class 名稱 && 不是本身的元素
    if (event.target.parentNode.className == 'data' &&
        dragged !== event.target.parentNode) {
        dragged.style.background = 'purple';

        // 判斷向下或向上拖動，來決定在元素前或後插入元素
        if (dragged.rowIndex < event.target.parentNode.rowIndex) {
            event.target.parentNode.parentNode.insertBefore(dragged, event.target.parentNode.nextSibling);
        }
        else {
            event.target.parentNode.parentNode.insertBefore(dragged, event.target.parentNode);
        }
    }
}, false);

// 當拖動的元素或者文本離開有效的放置目標 dragleave 事件就會觸發
document.addEventListener('dragleave', function(event) {
    // 當拖動元素離開可放置目標節點，重置背景
    // 自訂條件：class 名稱 && 不是本身的元素
    if (event.target.parentNode.className == 'data' &&
        dragged !== event.target.parentNode) {
        // 當拖動元素離開可放置目標節點，重置背景
        event.target.parentNode.style.background = '';
    }
}, false);

// 當丟放拖動元素到拖拉目標區時 drop 事件就會觸發；此時事件處理器可能會需要取出拖拉資料並處理之
// 這個事件只有在被允許下才會觸發，如果在使用者取消拖拉操作時，如按 ESC 鍵或滑鼠不是在拖拉目標元素上，此事件不會觸發
document.addEventListener('drop', function(event) {
    /*
     * AJAX Update DB
     */
    var id = document.querySelectorAll('.id');
    var data = [];  // 儲存所有 ID
    
    for (var i = 0, len = id.length; i < len; i++) {
        // 取得所有 ID 並存為 array
        data.push(id[i].innerHTML);
        // 重新排序表格 Sort 數值
        id[i].parentNode.querySelector('.sort').innerHTML = i;
    }

    // jQuery AJAX
    $.get('ajax.php', {"data": data});
}, false);
</script>

</body>
</html>