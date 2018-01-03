<?php

namespace Tracer\system\core;


use function Tracer\system\core\Common\load_class;

class T_Model
{
    protected $connect;

    /**
     * T_Model constructor.
     */
    public function __construct()
    {
        $_db =& load_class('Config');
        try {
            $this->connect = new \PDO(
                $_db->getItem('dsn'),
                $_db->getItem('db_username'), $_db->getItem('db_psd'),
                [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, \PDO::ATTR_TIMEOUT => 3]);
        } catch (\PDOException $exception) {
            throw new \Exception(
                iconv('gbk', 'utf-8', $exception->getMessage()),
                $exception->getCode());
        }
    }

    public function getConnect(): \PDO
    {
        return $this->connect;
    }
}