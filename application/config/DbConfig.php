<?php

namespace Tracer\application\config;

class DbConfig
{
    public $db_type = 'mysql';
    public $host = 'localhost';
    public $db_name = 'test';
    public $port = '3306';
    public $db_username = 'root';
    public $db_psd = 'root';
    public $socket = '';
    public $dsn = '';

    public function __construct()
    {
        $this->dsn =
            "{$this->db_type}:host={$this->host};dbname={$this->db_name};port={$this->port}";
    }
}