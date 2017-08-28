<?php

namespace AppBundle;

class ServerInfo {
    public static function getCpuCount() {
        $cmd = "cat /proc/cpuinfo | grep processor | wc -l";
        return intval(trim(shell_exec($cmd)));
    }

    public static function getMemoryAmount() {
        $info = file_get_contents('/proc/meminfo');
        $ret = preg_match('/^MemTotal:\s+(\d+) kB$/m', $info, $matches);
        if ($ret !== 1) return 'unknown';
        return (int)($matches[1] / 1024);
        exit;
    }

    public static function getStorageAmount() {
        return (int)(disk_free_space('/') / 1024 / 1024);
    }
}