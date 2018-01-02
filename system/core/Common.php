<?php

namespace Tracer\system\core\Common;

/**
 * 以单例的形式调用类
 * @param string $class
 * @param array  ...$param
 * @return mixed
 */
function &load_class(string $class, ... $param)
{
    static $class_list = [];

    $class = ucfirst($class);

    if (isset($class_list[0][$class])) {
        return $class_list[0][$class];
    } else {
        $class = 'Tracer\system\core\\' . $class;
        $class_list[0][$class] = empty($param) ? new $class() : new $class($param);
        return $class_list[0][$class];
    }

}

/**
 * 显示404界面
 */
function show404(): void
{
    $error_handler = &load_class('Exception');
    $error_handler->show404();
    exit(4);
}

/**
 * 错误处理函数
 * @param $errno
 * @param $errstr
 * @param $errfile
 * @param $errline
 */
function errorHandler($errno, $errstr, $errfile, $errline): void
{
    $title = 'ERROR LEVEL ' . $errno;
    $message = "<b>message</b>: $errstr <br/><b>in:</b> $errfile <br/><b>on line: </b> $errline <br/>";
    $error_handler = &load_class('Exception');
    $error_handler->showError($title, $message, $errno);
}

/**
 * 异常处理函数
 * @param \Throwable $throwable
 */
function exceptionHandler(\Throwable $throwable): void
{
    $title = $throwable->getMessage();
    $message = "the code: {$throwable->getCode()}<br/>
                    on: {$throwable->getFile()}<br/>
                    on line: {$throwable->getLine()}<br/>";

    $error_handler = &load_class('Exception');
    $error_handler->showException($title, $message);
}

/**
 * shutdown 处理函数
 */
function sdHandler(): void
{

}