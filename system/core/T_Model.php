<?php

namespace Tracer\system\core;


use function Tracer\system\core\Common\load_class;

class T_Model
{
    protected $connect;
    protected $conditions = '';
    protected $join_table = '';

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

    /**
     * 执行 SQL 操作
     */
    protected function execute()
    {

    }

    /**
     * SELECT 语句
     *
     * @param array $column
     *
     * @return T_Model
     */
    protected function &select(array $column): T_Model
    {
        $this->moment = MOMENT_SELECT;
        $this->column = implode(',', $column);

        return $this;
    }

    /**
     * UPDATE 语句
     *
     * @param string $table
     * @param array  $set
     *
     * @return T_Model
     */
    protected function &update(string $table, array $set): T_Model
    {
        $this->moment = MOMENT_UPDATE;
        $this->table  = $table;
        $sql          = '';
        foreach (array_keys($set) as $column) {
            $sql .= "$column=:$column,";
        }
        $this->update_prepare = substr($sql, 0, -1);
        $this->values         = $set;

        return $this;
    }

    /**
     * DELETE 语句
     *
     * @param string $table
     *
     * @return T_Model
     */
    protected function &delete(string $table): T_Model
    {
        $this->moment = MOMENT_DELETE;
        $this->table  = $table;

        return $this;
    }

    /**
     * INSERT 语句
     *
     * @param string $table
     * @param array  $columns
     * @param array  $values
     *
     * @return T_Model
     * @throws \Exception
     */
    protected function &insert(string $table, array $columns, array $values): T_Model
    {
        $this->moment = MOMENT_INSERT;
        $this->table  = $table;
        if (count($columns) !== count($values)) {
            throw new \Exception('the number of columns must equal to values\'s number', COUCHBASE_QUERY_ERROR);
        }
        $this->column = implode(',', $columns);
        $this->values = $values;

        return $this;
    }

    /**
     * 设定要操作的数据表
     *
     * @param string $table
     *
     * @return T_Model
     */
    protected function &from(string $table): T_Model
    {
        $this->table = $table;

        return $this;
    }

    /**
     * WHERE子句
     * [['name','=','mike'],['age','>',18]]
     *
     * @param array $conditions
     *
     * @return T_Model
     */
    protected function &where(array $conditions): T_Model
    {
        $sql = empty($this->conditions) ? 'WHERE ' : 'AND ';
        foreach ($conditions as $condition) {
            $sql                  .= "{$condition[0]} {$condition[1]} :? AND ";
            $this->where_values[] = $condition[2];
        }
        $this->conditions .= substr($sql, 0, -4);

        return $this;
    }

    /**
     * JOIN 子句
     *
     * @param string $table
     * @param array  $conditions ['a.id','b.id']
     * @param string $type
     *
     * @return T_Model
     * @throws \Exception
     */
    protected function &join(string $table, array $conditions, string $type = 'INNER'): T_Model
    {
        if (empty($this->table)) {
            throw new \Exception('You must assign a table first.');
        }
        $this->join_table .= "$type JOIN $table ON {$conditions[0]} = {$conditions[1]}";

        return $this;
    }

    /**
     * GROUP BY 子句
     *
     * @param array $column
     * @param array $having
     *
     * @return T_Model
     */
    protected function &group(array $column, array $having = []): T_Model
    {
        $this->group  = implode(',', $column);
        $this->having = 'HAVING ';
        foreach ($having as $condition) {
            $this->having          .= "$condition[0] $condition[1] ? AND ";
            $this->having_values[] = $condition[3];
        }
        $this->having = substr($this->having, 0, -4);

        return $this;
    }

    /**
     * ORDER BY 子句
     *
     * @param array $conditions ['a'=>'asc','b'=>'desc']
     *
     * @return T_Model
     */
    protected function &order(array $conditions): T_Model
    {
        $this->order = 'ORDER BY ';
        foreach ($conditions as $column => $rule) {
            $this->order .= "$column $rule,";
        }
        $this->order = substr($this->order, 0, -1);

        return $this;
    }

}
