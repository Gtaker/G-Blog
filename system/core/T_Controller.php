<?php

namespace Tracer\system\core;

class T_Controller
{
    /**
     * T_Controller constructor.
     */
    public function __construct()
    {
    }

    /**
     * 调用视图文件
     * @param string $view
     * @param array  $data
     */
    public function view(string $view, array &$data = []): void
    {
        ob_clean();
        extract($data);

        require VIEW_PATH . DIRECTORY_SEPARATOR ."$view.php";
        exit(0);
    }


}