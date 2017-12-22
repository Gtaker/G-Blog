<?php

namespace Tracer\system\core\Common;

/**
 * 以单例的形式调用类
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
function show404()
{
    $error_handler = &load_class('Exception');
    $error_handler->show404();
    exit(4);
}

/**
 * 错误处理函数
 */
function errorHandler()
{

}

/**
 * 异常处理函数
 */
function ecpHandler()
{

}

/**
 * shutdown 处理函数
 */
function sdHandler()
{

}