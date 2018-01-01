<?php

namespace Tracer\application\controller;

use Tracer\system\core\T_Controller;

class Welcome extends T_Controller
{
    public function hello()
    {
        echo '<h1>my second frame</h1>';
    }
}