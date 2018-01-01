<?php

namespace Tracer\system\core;

use Tracer\system\core;

class Config
{
    public static $items;

    /**
     * 载入系统配置
     */
    public function loadSysConfig(): void
    {
        foreach (scandir(APP_CONFIG) as $file) {
            if ($file == '.' || $file == '..') {
                continue;
            }
            $file = substr($file, 0, -4);
            $class = 'Tracer\application\config\\'.$file;
            foreach (new $class() as $key => $value) {
                self::$items[$file][$key] = $value;
            }
        }
    }

    /**
     * 获取配置项的值
     * @param string $item
     * @param string $type
     * @return string
     */
    public function &getItem(string $type, string $item): string
    {
        return self::$items[ucfirst($type)][$item];
    }

}