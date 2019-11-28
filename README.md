# Nodogsplash

> <https://nodogsplashdocs.readthedocs.io/en/stable/>

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

### uhttpd

`/etc/config/uhttpd`

```shell
list listen_http        0.0.0.0:2080
list interpreter        ".php=/usr/bin/php-cgi"
```

重启: `/etc/init.d/uhttpd restart`

### nodogsplash

`/etc/config/nodogsplash`

```shell
option fasport '2080'
option faspath '/nodog/fas.php'
```

需要在 `/www/` 目录下面创建 `nodog` 目录，将 `fas.php`, `auth.php` 放在该目录下面。

重启： `service nodogsplash restart`

**注意:**  `fas.php` 中需要打开 `sqlite db` 文件, `line: 6`, 默认是当前路径下面的 `index.db`

## API

### 获取路由器信息

`http://192.168.10.1/nodog/config.php`

### 获取设备文件

`http://192.168.10.1/nodog/content.php`

支持参数：

- `type`  文件类型  (app | music | image | raw | short_video | video)
- `page` 当前数据页，默认 1
- `limit` 每页条数， 默认 20

### 获取图片数量

`http://192.168.10.1/nodog/image.php?type=count`

### 获取图片列表

`http://192.168.10.1/nodog/image.php`

支持参数：

- `folder` 获取某个文件夹下面的图片， 默认无
- `page` 当前数据页，默认 1
- `limit` 每页条数， 默认 20

### 获取图片文件夹

`http://192.168.10.1/nodog/image.php?type=folder`