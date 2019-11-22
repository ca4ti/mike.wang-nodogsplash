<?php

class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open('index.db');
    }
}

$db = new MyDB();
if(!$db){
    echo $db->lastErrorMsg();
}

$results = $db->query('SELECT * FROM video_file limit 5');

?>


<?php
$clientip = $_GET['clientip'];
$gatewayname = $_GET['gatewayname'];
$redir = $_GET['redir'];

$token = exec("ndsctl json $clientip | grep token | cut -c 10- | cut -c -8");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BZY Wifi</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <script>
        function load() {
			location.href='weixin://';
        }
    </script>

    <style>
        .btn {
            width: 300px;
            min-height: 20px;
            padding: 9px 14px;
            font-size: 20px;
            background-color: #1890ff;
            color: #fff;
            border-color: #1890ff;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div style="position: absolute; top: 40%; left:50%; margin: -150px 0 0 -150px; width: 300px; height: 300px;">
        <h2><?php echo $gatewayname; ?></h2>
        <form method="GET" action="/nodog/auth.php">
            <input type="hidden" name="clientip" value="<?php echo $clientip; ?>"/>
            <input type="hidden" name="tok" value="<?php echo $token; ?>"/>

            <button class='btn' type="submit">login</button>
		</form>
        <button class='btn' style="margin-top:20px;" onclick="load()">download</button>

        <div style='margin-top:30px; margin-bottom:30px;'>
            <?php
                // $json_string = file_get_contents('index.json');
                // // 用参数true把JSON字符串强制转成PHP数组
                // $data = json_decode($json_string, true);
                // $videos = $data['video'];
                while($video = $results->fetchArray()) {
            ?>
                <div style='margin-top:10px;background: beige; padding:10px 0;'>
                    <a href=''  style='text-decoration: none;'> <?php echo $video['filePath']; ?></a>
                </div>
            <?php
                }
            ?>
        </div>
    </div>
</body>
</html>