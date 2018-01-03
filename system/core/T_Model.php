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
        $this->connect = new \PDO($_db->getItem('dsn'), $_db->getItem('db_username'), $_db->getItem('db_psd'));
    }

    public function getConnect(): \PDO
    {
        return $this->connect;
    }
}