<?php

namespace Tracer\system\core;

class Log
{
    const EMERGENCY = 'emergency';
    const ALERT = 'alert';
    const CRITICAL = 'critical';
    const ERROR = 'error';
    const WARNING = 'warning';
    const NOTICE = 'notice';
    const INFO = 'info';
    const DEBUG = 'debug';

    private $log_path = LOG_PATH;
    private $star_time = '';
    private $today = '';

    /**
     * Log constructor.
     */
    public function __construct()
    {
        $this->today = date('Y-m-d');
        $date = $this->log_path . DIRECTORY_SEPARATOR . $this->today;
        $this->star_time = date('Y-m-d H:i:s');

        is_dir(LOG_PATH) || mkdir(LOG_PATH);
    }

    /**
     * 系统不可用
     *
     * @param string $message
     * @param array  $context
     * @return void
     */
    public function emergency($message, array $context = array()): void
    {
        $file_path = $this->log_path .
            DIRECTORY_SEPARATOR . $this->today . '.txt';
        $flag = file_exists($file_path);
        $fs = fopen($file_path, 'a');
        $message =
            "----- EMERGENCY -----\r\n" .
            '----- frame start at:' . $this->star_time . "-----\r\n" .
            '----- and write this log at:' . date('Y-m-d H:i:s') . "-----\r\n" .
            "----- message: $message -----" . "\r\n\r\n\r\n";
        fwrite($fs, $message);
    }

    /**
     *  **必须** 立刻采取行动
     *
     * 例如：在整个网站都垮掉了、数据库不可用了或者其他的情况下， **应该** 发送一条警报短信把你叫醒。
     *
     * @param string $message
     * @param array  $context
     * @return void
     */
    public function alert($message, array $context = array()): void
    {
        $file_path = $this->log_path .
            DIRECTORY_SEPARATOR . $this->today . '.txt';
        $flag = file_exists($file_path);
        $fs = fopen($file_path, 'a');
        $message =
            "----- ALERT -----\r\n" .
            '----- frame start at:' . $this->star_time . "-----\r\n" .
            '----- and write this log at:' . date('Y-m-d H:i:s') . "-----\r\n" .
            "----- message: $message -----" . "\r\n\r\n\r\n";
        fwrite($fs, $message);
    }

    /**
     * 紧急情况
     *
     * 例如：程序组件不可用或者出现非预期的异常。
     *
     * @param string $message
     * @param array  $context
     * @return void
     */
    public function critical($message, array $context = array()): void
    {
        $file_path = $this->log_path .
            DIRECTORY_SEPARATOR . $this->today . '.txt';
        $flag = file_exists($file_path);
        $fs = fopen($file_path, 'a');
        $message =
            "----- CRITICAL -----\r\n" .
            '----- frame start at:' . $this->star_time . "-----\r\n" .
            '----- and write this log at:' . date('Y-m-d H:i:s') . "-----\r\n" .
            "----- message: $message -----" . "\r\n\r\n\r\n";
        fwrite($fs, $message);
    }

    /**
     * 运行时出现的错误，不需要立刻采取行动，但必须记录下来以备检测。
     *
     * @param string $message
     * @param array  $context
     * @return void
     */
    public function error($message, array $context = array()): void
    {
        $file_path = $this->log_path .
            DIRECTORY_SEPARATOR . $this->today . '.txt';
        $flag = file_exists($file_path);
        $fs = fopen($file_path, 'a');
        $message =
            "----- ERROR -----\r\n" .
            '----- frame start at:' . $this->star_time . "-----\r\n" .
            '----- and write this log at:' . date('Y-m-d H:i:s') . "-----\r\n" .
            "----- message: $message -----" . "\r\n\r\n\r\n";
        fwrite($fs, $message);
    }

    /**
     * 出现非错误性的异常。
     *
     * 例如：使用了被弃用的API、错误地使用了API或者非预想的不必要错误。
     *
     * @param string $message
     * @param array  $context
     * @return void
     */
    public function warning($message, array $context = array()): void
    {
        $file_path = $this->log_path .
            DIRECTORY_SEPARATOR . $this->today .
            DIRECTORY_SEPARATOR . date('H-i-s') . '.txt';
        $flag = file_exists($file_path);
        $fs = fopen($file_path, 'a');
        $message =
            "----- WARNING -----\r\n" .
            '----- frame start at:' . $this->star_time . "-----\r\n" .
            '----- and write this log at:' . date('Y-m-d H:i:s') . "-----\r\n" .
            "----- message: $message -----" . "\r\n\r\n\r\n";
        fwrite($fs, $message);

    }

    /**
     * 一般性重要的事件。
     *
     * @param string $message
     * @param array  $context
     * @return void
     */
    public function notice(string $message, array $context = array()): void
    {
        $file_path = $this->log_path .
            DIRECTORY_SEPARATOR . $this->today .
            DIRECTORY_SEPARATOR . date('H-i-s') . '.txt';
        $flag = file_exists($file_path);
        $fs = fopen($file_path, 'a');
        $message =
            "----- NOTICE -----\r\n" .
            '----- frame start at:' . $this->star_time . "-----\r\n" .
            '----- and write this log at:' . date('Y-m-d H:i:s') . "-----\r\n" .
            "----- message: $message -----" . "\r\n\r\n\r\n";
        fwrite($fs, $message);
    }

    /**
     * 重要事件
     *
     * 例如：用户登录和SQL记录。
     *
     * @param string $message
     * @param array  $context
     * @return void
     */
    public function info(string $message, array $context = array()): void
    {
        $file_path = $this->log_path .
            DIRECTORY_SEPARATOR . $this->today .
            DIRECTORY_SEPARATOR . date('H-i-s') . '.txt';
        $flag = file_exists($file_path);
        $fs = fopen($file_path, 'a');
        $message =
            "----- INFO -----\r\n" .
            '----- frame start at:' . $this->star_time . "-----\r\n" .
            '----- and write this log at:' . date('Y-m-d H:i:s') . "-----\r\n" .
            "----- message: $message -----" . "\r\n\r\n\r\n";
        fwrite($fs, $message);
    }

    /**
     * debug 详情
     *
     * @param string $message
     * @param array  $context
     * @return void
     */
    public function debug($message, array $context = array()): void
    {
        $file_path = $this->log_path .
            DIRECTORY_SEPARATOR . $this->today .
            DIRECTORY_SEPARATOR . date('H-i-s') . '.txt';
        $flag = file_exists($file_path);
        $fs = fopen($file_path, 'a');
        $message =
            "----- DEBUG -----\r\n" .
            '----- frame start at:' . $this->star_time . "-----\r\n" .
            '----- and write this log at:' . date('Y-m-d H:i:s') . "-----\r\n" .
            "----- message: $message -----" . "\r\n\r\n\r\n";
        fwrite($fs, $message);
    }

    /**
     * 任意等级的日志记录
     *
     * @param mixed  $level
     * @param string $message
     * @param array  $context
     * @return void
     */
    public function log($level, $message, array $context = array()): void
    {
        $file_path = $this->log_path .
            DIRECTORY_SEPARATOR . $this->today .
            DIRECTORY_SEPARATOR . date('H-i-s') . '.txt';
        $flag = file_exists($file_path);
        $fs = fopen($file_path, 'a');
        $message =
            "----- LOG -----\r\n" .
            '----- frame start at:' . $this->star_time . "-----\r\n" .
            '----- and write this log at:' . date('Y-m-d H:i:s') . "-----\r\n" .
            "----- message: $message -----" . "\r\n\r\n\r\n";
        fwrite($fs, $message);
    }

}