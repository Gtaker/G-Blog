<?php

namespace Tracer\system\core;
use Tracer\system\core\Common;

class Init
{
    /**
     * Init constructor.
     */
    public function __construct()
    {
        $this->initTime();
    }

    /**
     * 初始化时区
     */
    private function initTime(): void
    {
        $config = &Common\load_class('config');
        date_default_timezone_set($config->getItem('config','timezone'));
    }

    /**
     * 初始化session
     */
    private function initSession(): void
    {
        session_start();
    }
}