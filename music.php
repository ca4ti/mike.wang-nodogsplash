<?php

require_once 'core.php';

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

$stmt = $db->prepare('SELECT * FROM music_file limit :limit offset :offset');
$stmt->bindValue(':offset', $offset, SQLITE3_INTEGER);
$stmt->bindValue(':limit', $limit, SQLITE3_INTEGER);
$result = $stmt->execute();

$response = [];

while($video = $result->fetchArray(SQLITE3_ASSOC)) {
    $response[] = $video;
}


header("Content-Type:application/json");
echo json_encode($response);
?>