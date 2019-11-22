<?php
    $clientip = $_GET['clientip'];
    $token = $_GET['tok'];

    $state = exec("ndsctl json $clientip | grep state | cut -c 10-");
    $state = substr($state, 0,-2);

    if ($state === 'Authenticated') {
        $msg = '已经授权成功， 可以登录啦';
    } else {
        $result = exec("ndsctl auth $clientip", $output, $exit);
        if ($exit == 0) {
            $msg = '授权成功， 可以登录啦';
        } else {
            $msg = '授权失败， 无法联网';
        }
    }
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
            background-color: #4cae4c;
            color: #fff;
            border-color: #4cae4c;
            border-radius: 4px;
        }
    </style>
</head>
<body style="background:aliceblue;">
    <div style="position: absolute; top: 40%; left:50%; margin: -150px 0 0 -150px; width: 300px; height: 300px;">
        <button class='btn' style="margin-top:20px;" onclick="load()"><?php echo $msg;?></button>
    </div>
</body>
</html>