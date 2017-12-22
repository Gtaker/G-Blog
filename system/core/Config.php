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
            $file = 'Tracer\application\config\\'.substr($file, 0, -4);
            foreach (new $file() as $key => $value) {
                self::$items[ucfirst($file)][$key] = $value;
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