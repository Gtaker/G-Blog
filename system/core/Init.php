<?php

namespace Tracer\system\core;
use Tracer\system\core\Common;

class Init
{
    public function initTime()
    {
        $config = &Common\get_class('config');
        date_default_timezone_set($config->getItem('config','timezone'));
    }
}