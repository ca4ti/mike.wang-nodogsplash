# Nodogsplash

> https://nodogsplashdocs.readthedocs.io/en/stable/

## 安装依赖

```shell
make menuconfig

Network ->  Captive Portals -> nodogsplash
Language -> PHP
                -> php7
                -> php7-cgi
                -> php7-cli
                -> php7-mod-mbstring
                -> php7-mod-sqlite3
```

## 修改配置

`/etc/config/uhttpd`

```shell
list listen_http        0.0.0.0:2080
list interpreter        ".php=/usr/bin/php-cgi"
```

重启: `/etc/init.d/uhttpd restart`

`/etc/config/nodogsplash`


```shell
option fasport '2080'
option faspath '/nodog/fas.php'
```

需要在 `/www/` 目录下面创建 `nodog` 目录，将 `fas.php`, `auth.php` 放在该目录下面。

重启： `service nodogsplash restart`
