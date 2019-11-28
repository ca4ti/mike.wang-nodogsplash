<?php

require_once 'core.php';

$type = $_GET['type'];
$page = $_GET['page'] ?? 1;
$limit = $_GET['limit'] ?? 20;
$offset = ($page - 1) * $limit;
if ($offset < 0) {
    $offset = 0;
}

$db = new SQLite();
if(!$db){
    echo $db->lastErrorMsg();
    exit(1);
}


$response = [];

if (empty($type)) {
    $stmt = $db->prepare('SELECT * FROM image_file limit :limit offset :offset');
    $stmt->bindValue(':offset', $offset, SQLITE3_INTEGER);
    $stmt->bindValue(':limit', $limit, SQLITE3_INTEGER);
    $result = $stmt->execute();

    while($image = $result->fetchArray(SQLITE3_ASSOC)) {
        $response[] = $image;
    }
} else if ($type === 'folder') {
    // 计算文件夹
    $stmt = $db->prepare("SELECT folderName, count(*) total FROM image_file group by folderName");
    $result = $stmt->execute();
    while($image = $result->fetchArray(SQLITE3_ASSOC)) {
        $response[] = $image;
    }
} else if ($type === 'count') {
    $stmt = $db->prepare("SELECT count(*) total FROM image_file");
    $result = $stmt->execute();
    while($image = $result->fetchArray(SQLITE3_ASSOC)) {
        $response[] = $image;
    }
}

header("Content-Type:application/json");
echo json_encode($response);
?>