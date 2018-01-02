<?php
namespace Tracer\system\core;

use function Tracer\system\core\Common\load_class;

/**
 * 1，配置环境变量 Env.php
 * 2，加载公共函数 Common.php
 * 3，注册各种处理函数 Register.php
 * 4，加载配置文件 Config.php
 * 5，初始化各种设置 Init.php
 * 6，加载日志类
 * 7，解析 URL Url.php
 * 8，路由 URL 到对应的控制器 Route.php
 */

/*********************
 * 配置环境变量
 *********************/
require SYSTEM_CORE . '/Env.php';

/*********************
 * 加载公共函数
 *********************/
require SYSTEM_CORE . '/Common.php';

/*********************
 * 注册各种处理函数
 *********************/
set_error_handler('Tracer\system\core\Common\errorHandler');              // 注册错误处理函数
set_exception_handler('Tracer\system\core\Common\exceptionHandler');       // 注册异常处理函数
register_shutdown_function('Tracer\system\core\Common\sdHandler');            // 注册终止处理函数

/*********************
 * 加载配置文件
 *********************/
$_config =& load_class('config');
$_config->loadSysConfig();

/*********************
 * 初始化各种设置
 *********************/
load_class('init');

/*********************
 * 初始化日志类
 *********************/
load_class('log');

/*********************
 * 解析 URL
 *********************/
load_class('url');

/*********************
 * 路由 URL 到对应的控制器
 *********************/
load_class('router');