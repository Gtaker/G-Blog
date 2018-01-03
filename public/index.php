<?php

namespace Tracer\bus\index;

define('SYSTEM_CORE', '../system/core');                    // 系统核心代码目录
define('SYSTEM_LIB', '../system/libraries');                // 系统扩展库目录
define('APP_HOME', '../application');                       // 应用目录
define('APP_CONFIG', '../application/config');              // 应用配置文件目录
define('PROJECT_PATH', '../application/project');           // 项目目录
define('SYSTEM_PUBLIC', '../application/public');           // 公共目录
define('LOG_PATH', '../Log');                               // 公共目录
define('ERROR_PATH', '../application/error');               // 错误处理页面目录
define('CONTROLLER_PATH', '../application/controller');     // 控制器目录
define('MODEL_PATH', '../application/model');               // 模型目录
define('VIEW_PATH', '../application/views');                 // 视图目录

require SYSTEM_CORE . '/Autoload.php';
require SYSTEM_CORE . '/Tracer.php';