<?php
    require_once "core.php";

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
        .btn-info {
            color: #fff;
            background-color: #4cae4c;
            border-color: #4cae4c;
        }
    </style>
</head>
<body style="background:aliceblue;">
    <div style="position: absolute; top: 40%; left:50%; margin: -150px 0 0 -150px; width: 300px; height: 300px;">
        <h2>FastFree<?php //echo $gatewayname; ?></h2>
        <form method="GET" action="/nodog/auth.php">
            <input type="hidden" name="clientip" value="<?php echo $clientip; ?>"/>
            <input type="hidden" name="tok" value="<?php echo $token; ?>"/>

            <button class='btn' type="submit">login</button>
		</form>
        <button class='btn' style="margin-top:20px;" onclick="load()">download</button>

        <div style='margin-top:30px; margin-bottom:30px;'>
            <?php
                exit(1);

                $db = new SQLite();
                if(!$db){
                    echo $db->lastErrorMsg();
                    exit(1);
                }

                $results = $db->query('SELECT * FROM image_file limit 5');
                while($video = $results->fetchArray()) {
            ?>
                <div style='margin-top:10px;'>
                    <button class='btn btn-info'> <?php echo $video['fileName'] . $video['fileExtension']; ?></button>
                </div>
            <?php
                }
            ?>
        </div>
    </div>
</body>
</html>