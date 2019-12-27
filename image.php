<?php

require_once 'core.php';

$type = $_GET['type'];
$folder = $_GET['folder'];
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

if (empty($type) || $type === 'image') {
    // 获取图片列表
    $stmt = $db->prepare('SELECT * FROM image_file limit :limit offset :offset');
    if (!empty($folder)) {
        $stmt = $db->prepare('SELECT * FROM image_file where folderName=:folder limit :limit offset :offset');
        $stmt->bindValue(':folder', $folder, SQLITE3_TEXT);
    }
    $stmt->bindValue(':offset', $offset, SQLITE3_INTEGER);
    $stmt->bindValue(':limit', $limit, SQLITE3_INTEGER);
} else if ($type === 'folder') {
    // 计算文件夹
    $stmt = $db->prepare("SELECT folderName, folderPath FROM image_file group by folderPath ORDER BY folderName");
    $result = $stmt->execute();
    while($folder = $result->fetchArray(SQLITE3_ASSOC)) {
        $stmt1 = $db->prepare("SELECT * FROM image_file WHERE folderPath=:folderPath");
        $stmt1->bindValue(':folderPath', $folder["folderPath"], SQLITE3_TEXT);
        $result1 = $stmt1->execute();
        $folderImages = [];
        while($folderImage = $result1->fetchArray(SQLITE3_ASSOC)) {
            $folderImages[] = $folderImage;
        }

        $folder["items"] = $folderImages;
        $folder["imageCount"] = count($folderImages);
        $response[] = $folder;
    }
} else if ($type === 'count') {
    $stmt = $db->prepare("SELECT count(*) total FROM image_file");
} else {
    header('HTTP/1.1 204 No Content');
    exit(0);
}

if (count($response) == 0) {
    $result = $stmt->execute();

    while($image = $result->fetchArray(SQLITE3_ASSOC)) {
        $response[] = $image;
    }
}

header("Content-Type:application/json");
echo json_encode($response);
?>