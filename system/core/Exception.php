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
     * @param int    $errno
     * @param string $errstr
     * @param string $errfile
     * @param int    $errline
     */
    public function showError(int $errno, string $errstr, string $errfile, int $errline): void
    {

        //记录错误信息
        $_log =& load_class('log');
        $_log->error(
            "ERROR LEVEL {$errstr}\r\n{$errstr}\r\nin:{$errfile}\r\non line:{$errline}\r\n"
        );

        $title = 'ERROR LEVEL ' . $errno;
        $message = "<b>message</b>:$errstr <br/>
                    <b>in:</b> $errfile <br/>
                    <b>on line: </b> $errline <br/>";

        //显示错误页面
        require ERROR_PATH . '/error.php';
        ($errno == E_NOTICE) || exit($errno);
    }

    /**
     * 显示异常处理界面
     * @param \Throwable $throwable
     */
    public function showException(\Throwable $throwable): void
    {
        //记录错误信息
        $_log =& load_class('log');
        $_log->error(
            "Exception Code: {$throwable->getCode()}\r\n{$throwable->getMessage()}\r\nin: {$throwable->getFile()}\r\non line: {$throwable->getLine()}\r\n"
        );

        $title = $throwable->getMessage();
        $message = "<b>error code: </b>{$throwable->getCode()}<br/>
                    <b>in: </b>{$throwable->getFile()}<br/>
                    <b>on line: </b>{$throwable->getLine()}<br/>";

        require ERROR_PATH . '/exception.php';
        exit($throwable->getCode());
    }
}