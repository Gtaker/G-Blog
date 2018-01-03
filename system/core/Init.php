<?php

namespace Tracer\system\core;
use function Tracer\system\core\Common\load_class;

class Init
{
    /**
     * Init constructor.
     */
    public function __construct()
    {
        $this->initTime();
        $this->initSession();
    }

    /**
     * 初始化时区
     */
    private function initTime(): void
    {
        $config =& load_class('config');
        date_default_timezone_set($config->getItem('timezone'));
    }

    /**
     * 初始化session
     */
    private function initSession(): void
    {
        session_start();
    }
}