<?php

namespace Tracer\system\core;

class Url
{
    private $path_info = '';
    public $class = '';
    public $method = '';
    public $param = [];

    /**
     * Url constructor.
     */
    public function __construct()
    {
        $this->path_info = trim($_SERVER['PATH_INFO'],'/');
        $this->parse_url();
    }

    /**
     * 解析url
     */
    private function parse_url(): void
    {
        if (empty($this->path_info)) {
            $this->class = 'index';
            $this->method = 'index';
            return;
        }
        foreach (explode('/', $this->path_info) as $v) {
                $segment[] = $v;
        }
        $this->class = ucfirst(array_shift($segment));
        $this->method = ucfirst(array_shift($segment));
        $this->param = $segment;
        empty($this->method) && $this->method = 'index';
    }

}