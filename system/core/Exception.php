<?php

namespace Tracer\system\core;

use function Tracer\system\core\Common\load_class;

class Exception
{
    /**
     * Exception constructor.
     */
    public function __construct()
    {
        ob_clean();
    }

    /**
     * 显示404界面
     */
    public function show404(): void
    {
        //记录错误信息
        $_log =& load_class('log');
        $_log->log(1, '试图请求一个不存在的页面');

        require ERROR_PATH . '/404.php';
        exit;
    }

    /**
     * 显示error界面
     * @param string $title
     * @param string $message
     * @param int    $erron
     */
    public function showError(string $title, string $message, int $erron): void
    {
        //记录错误信息
        $_log =& load_class('log');
        $_log->error(
            substr(
                str_replace('</b>', '',
                    str_replace('<b>', '',
                        str_replace('<br/>', "\r\n", $message))), 9));

        //显示错误页面
        require ERROR_PATH . '/error.php';
        ($erron == E_NOTICE) || exit($erron);
    }

    /**
     * 显示异常处理界面
     * @param string $title
     * @param string $message
     */
    public function showException(string $title, string $message): void
    {
        //记录错误信息
        $_log =& load_class('log');
        $_log->error($message);

        require ERROR_PATH . '/exception.php';
        exit;
    }
}