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

```json
{
    "hostname": "OpenWrt",
    "system": " MediaTek MT7621 ver",
    "machine": " Newifi-D2",
    "cpu": " MIPS 1004Kc V2.15",
    "revison": "r11473-5dc535419f",
    "target": "ramips/mt7621",
    "arch": "mipsel_24kc",
    "description": "OpenWrt SNAPSHOT r11473-5dc535419f"
}
```

### 获取设备文件

`http://192.168.10.1/nodog/content.php?type=video`

支持参数：

- `type`  文件类型  (app | music | image | raw | short_video | video)
- `page` 当前数据页，默认 1
- `limit` 每页条数， 默认 20

```json
[
    {
        "filePath": "AA/Video/1573530285762084.mp4",
        "fileName": "1573530285762084",
        "fileExtension": ".mp4",
        "fileSize": 565140,
        "fileBirthTime": "1573530285798",
        "fileCreateTime": "1574229797821",
        "duration": 138327,
        "width": 540,
        "height": 960,
        "thumbnail": "AA/Video/1573530285762084.png"
    }
]
```

### 获取图片数量

`http://192.168.10.1/nodog/image.php?type=count`

```json
{
    "total": 3
}
```

### 获取图片列表

`http://192.168.10.1/nodog/image.php`

```json
[
    {
        "filePath": "Default/Image/AA/WechatIMG17.jpeg",
        "fileName": "WechatIMG17",
        "fileExtension": ".jpeg",
        "fileSize": 151969,
        "fileBirthTime": "1564478458889",
        "fileCreateTime": "1574764616456",
        "folderPath": "Default/Image/AA",
        "folderName": "AA",
        "width": 1440,
        "height": 1080,
        "mime": "image/jpeg"
    }
]
```

支持参数：

- `folder` 获取某个文件夹下面的图片， 默认无
- `page` 当前数据页，默认 1
- `limit` 每页条数， 默认 20

### 获取图片文件夹

`http://192.168.10.1/nodog/image.php?type=folder`

```json
[
    {
        "folderName": "AA",
        "total": 1
    },
    {
        "folderName": "Image",
        "total": 2
    }
]
```

### 获取 WIFI 列表

`http://192.168.10.1/nodog/wifi.php`

支持参数：

- `page` 当前数据页，默认 1
- `limit` 每页条数， 默认 20

```json
[
    {
        "icon": "AA",
        "name": "热点名称",
        "lat": "33.49800109863281",
        "lon": "-86.8010025024414",
        "beginAt": "9:30",
        "endAt": "21:30"
    }
]
```
