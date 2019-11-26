<?php

    $hostname = exec('uname -n');
    $system = exec("cat /proc/cpuinfo | grep 'system type' | cut -f2 -d:");
    $machine = exec("cat /proc/cpuinfo | grep 'machine' | cut -f2 -d:");
    $cpu = exec("cat /proc/cpuinfo | grep 'cpu model' | cut -f2 -d:");
    $revison = exec("cat /etc/openwrt_release  | grep 'REVISION' | cut -f2 -d=");
    $target = exec("cat /etc/openwrt_release  | grep 'TARGET' | cut -f2 -d=");
    $arch = exec("cat /etc/openwrt_release  | grep 'ARCH' | cut -f2 -d=");
    $description = exec("cat /etc/openwrt_release  | grep 'DESCRIPTION' | cut -f2 -d=");

    $result = [
        'hostname' => $hostname,
        'system' => $system,
        'machine' => $machine,
        'cpu' => $cpu,
        'revison' => trim($revison, "'"),
        'target' => trim($target, "'"),
        'arch' => trim($arch, "'"),
        'description' => trim($description, "'"),
    ];

    header("Content-Type:application/json");

    echo json_encode($result);
?>