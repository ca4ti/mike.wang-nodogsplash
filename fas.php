<?php
    $clientip = $_GET['clientip'];
    $gatewayname = $_GET['gatewayname'];
    $redir = $_GET['redir'];
    $token = exec("ndsctl json $clientip | grep token | cut -c 10- | cut -c -8");
    // 301 Moved Permanently
    // header("Location: ${$authUrl}", TRUE, 301);
    // exit;
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset=UTF-8>
        <title>FastFree</title>
        <meta name=viewport content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0">
        <link rel="shortcut icon" href=./favicon.ico>
        <link rel=stylesheet type=text/css href=./static/css/auth.css>
    </head>
    <body>
        <div id=main class=main>
            <div class=content-header>
                <img src = "./static/img/icon.png">
                <span class=''>FastFree</span>
            </div>

            <div class=content-body>
                <div class=btn-container>
                    <form method="GET" action="http://192.168.10.1:2050/nodogsplash_auth/" id = "authClient">
                        <input type="hidden" name="clientip" value="<?php echo $clientip; ?>"/>
                        <input type="hidden" name="tok" value="<?php echo $token; ?>"/>
                        <input type="hidden" name="redir" value="http://192.168.10.1:2080/nodog/auth.php"/>

                        <button class='button Android margin-t' type="submit">
                            <span>正在联网...</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </body>

    <<script>
        var form = document.getElementById('authClient');

        form.submit();
    </script>


</html>
