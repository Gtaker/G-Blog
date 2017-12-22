<?php

use Tracer\system\core\Config;
use Tracer\system\core\URL;
use Tracer\system\core\Router;
use Tracer\system\core\Controller;
use Tracer\system\core\Exception;
use Tracer\system\core\Common;

/**
 * 1，加载公共函数 Common.php
 * 2，配置环境变量 Env.php
 * 3，注册各种处理函数 Register.php
 * 4，加载配置文件 Config.php
 * 5，初始化各种设置 Init.php
 * 6，加载日志类
 * 7，解析 URL Url.php
 * 8，路由 URL 到对应的控制器 Route.php
 */


/*********************
 * 加载公共函数
 *********************/
require SYSTEM_CORE . '/Common.php';

/*********************
 * 注册各种处理函数
 *********************/
//set_error_handler('errorHandler');              // 注册错误处理函数
//set_exception_handler('ecpHandler');       // 注册异常处理函数
//register_shutdown_function('sdHandler');            // 注册终止处理函数

/*********************
 * 配置环境变量
 *********************/
require SYSTEM_CORE . '/Env.php';

/*********************
 * 加载配置文件
 *********************/
$_config = &Common\load_class('config');
$_config->loadSysConfig();

/*********************
 * 初始化各种设置
 *********************/
$_init = &Common\load_class('init');

/*********************
 * 初始化日志类
 *********************/
$_log = &Common\load_class('log');

/*********************
 * 解析 URL
 *********************/
$_url = &Common\load_class('url');

/*********************
 * 路由 URL 到对应的控制器
 *********************/
$_route = &Common\load_class('router');