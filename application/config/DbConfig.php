<?php

namespace Tracer\application\config;

class DbConfig
{
    public $db_type = 'mysql';
    public $host = 'localhost';
    public $dbname = 'test';
    public $port = '3306';
    public $username = 'root';
    public $passwd = 'root';
//    public $socket = '';

    public function __construct()
    {
        $this->dsn =
            $this->db_type . ':' .
            'host=' . $this->host . ';' .
            'dbname=' . $this->dbname . ';' .
            'port=' . $this->port;
    }
}