<?php

namespace Tracer\system\core;


use function Tracer\system\core\Common\load_class;
use Tracer\system\libraries\DbChain;

class T_Model
{
    use DbChain;
    protected $connect;
    protected $conditions = '';
    protected $join_table = '';
    protected $having_values = [];

    /**
     * T_Model constructor.
     */
    public function __construct()
    {
        $_db =& load_class('Config');
        try {
            $this->connect = new \PDO(
                $_db->getItem('dsn'),
                $_db->getItem('db_username'), $_db->getItem('db_psd'));
        } catch (\PDOException $exception) {
            throw new \Exception(
                iconv('gbk', 'utf-8', $exception->getMessage()),
                $exception->getCode());
        }
    }

    /**
     * 获得数据库链接
     * @return \PDO
     */
    public function &getConnect(): \PDO
    {
        return $this->connect;
    }

    /**
     * 获取整张表的信息
     *
     * @param string $table
     *
     * @return array
     * @throws \Exception
     */
    protected function getTable(string $table): array
    {
        if (empty($table)) {
            throw new \Exception('table name is empty', COUCHBASE_QUERY_ERROR);
        }
        $stmt = $this->connect->query('SELECT * FROM ' . $table);

        return $stmt->fetchAll();
    }

}
