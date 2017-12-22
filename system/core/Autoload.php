<?php

/**
 * 注册自动加载
 */
spl_autoload_register(function ($class) {
    $prefix = 'Tracer';
    $pre_len = strlen($prefix);
    $address = '..' . substr($class, $pre_len).'.php';

    // 如果文件存在，则 require 该文件，否则抛出一个异常
    if (file_exists($address)) {
        require_once $address;
    }else{
        throw new \Exception('引用的文件不存在！');
    }
});
