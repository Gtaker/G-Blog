<?php

namespace Tracer\bus\index;

define('SYSTEM_CORE', '..'.DIRECTORY_SEPARATOR.'system'.DIRECTORY_SEPARATOR.'core');                    // 系统核心代码目录
define('SYSTEM_LIB', '..'.DIRECTORY_SEPARATOR.'system'.DIRECTORY_SEPARATOR.'libraries');                // 系统扩展库目录
define('APP_HOME', '..'.DIRECTORY_SEPARATOR.'application');                                             // 应用目录
define('APP_CONFIG', '..'.DIRECTORY_SEPARATOR.'application'.DIRECTORY_SEPARATOR.'config');              // 应用配置文件目录
define('PROJECT_PATH', '..'.DIRECTORY_SEPARATOR.'application'.DIRECTORY_SEPARATOR.'project');           // 项目目录
define('SYSTEM_PUBLIC', '..'.DIRECTORY_SEPARATOR.'application'.DIRECTORY_SEPARATOR.'public');           // 公共目录
define('LOG_PATH', '..'.DIRECTORY_SEPARATOR.'Log');                                                     // 日志目录
define('ERROR_PATH', '..'.DIRECTORY_SEPARATOR.'application'.DIRECTORY_SEPARATOR.'error');               // 错误处理页面目录
define('CONTROLLER_PATH', '..'.DIRECTORY_SEPARATOR.'application'.DIRECTORY_SEPARATOR.'controller');     // 控制器目录
define('MODEL_PATH', '..'.DIRECTORY_SEPARATOR.'application'.DIRECTORY_SEPARATOR.'model');               // 模型目录
define('VIEW_PATH', '..'.DIRECTORY_SEPARATOR.'application'.DIRECTORY_SEPARATOR.'views');                // 视图目录

require SYSTEM_CORE .DIRECTORY_SEPARATOR.'Autoload.php';
require SYSTEM_CORE .DIRECTORY_SEPARATOR.'Tracer.php';