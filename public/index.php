<?php

namespace Tracer\bus\index;

define('SYSTEM_CORE', '../system/core');                   // 系统核心代码目录
define('SYSTEM_LIB', '../system/libraries');               // 系统扩展库目录
define('APP_HOME', '../application');                      // 应用目录
define('APP_CONFIG', '../application/config');             // 应用配置文件目录
define('PROJECT_PATH', '../application/project');          // 项目目录
define('SYSTEM_PUBLIC', '../application/public');          // 公共目录
define('LOG_PATH', '../Log');                       // 公共目录

require SYSTEM_CORE . '../Autoload.php';
require SYSTEM_CORE . '../Tracer.php';