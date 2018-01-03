<?php

namespace Tracer\system\core;

use function Tracer\system\core\Common\load_class;
use Tracer\application\controller;

class Router
{
    /**
     * Router constructor.
     */
    public function __construct()
    {
        $_url = load_class('url');
        $class = 'Tracer\application\controller\\' . $_url->class;
        $obj = new $class;
        call_user_func_array([$obj,$_url->method],$_url->param);
    }

}