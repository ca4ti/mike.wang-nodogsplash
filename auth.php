<?php
    $clientip = $_GET['clientip'];
    // $token = $_GET['tok'];

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
            echo $msg;
            exit(1);
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset=UTF-8>
        <title>FastFree</title>
        <meta name=viewport content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0">
        <link rel="shortcut icon" href=./favicon.ico>
        <link rel=stylesheet type=text/css href=./static/css/auth.css>

        <script>
            function load() {
                location.href='weixin://';
            }
        </script>
    </head>
    <body>
        <div id=main class=main>
            <div class=content-header>
                <img src = "./static/img/icon.png">
                <span class=''>FastFree</span>
            </div>

            <div class=content-body>
                <div class=content-title>
                    <img id=logo-img src = "./static/img/wifi.png">
                    <span>恭喜，你已成功接入免费网络</span>
                </div>
                <div class=btn-container>
                    <a onclick="load()" class="button Android margin-t">
                        <span>点击进入FastFree</span>
                    </a>
                </div>
                <div class="download-link">
                    <a onclick="load()" class="Android margin-t">
                        <span>免流量下载FastFree App</span>
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>
