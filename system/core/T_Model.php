<?php

namespace Tracer\system\core;


use function Tracer\system\core\Common\load_class;

class T_Model
{
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

    /**
     * 执行 SQL 操作
     */
    protected function execute()
    {
        switch ($this->moment) {
            case MOMENT_INSERT:
                return $this->excInsert();
            case MOMENT_DELETE:
                return $this->excDelete();
            case MOMENT_UPDATE:
                return $this->excUpdate();
            case MOMENT_SELECT:
                return $this->excSelect();
            default:
                throw new \Exception('You must assign a type of DML or DQL', 5);
        }
    }

    /**
     * SELECT 语句
     *
     * @param array  $column
     * @param string $table
     *
     * @return T_Model
     */
    protected function &select(array $column, string $table): T_Model
    {
        $this->moment = MOMENT_SELECT;
        $this->table  = $table;
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
            $sql .= "$column = :$column,";
        }
        $this->update        = substr($sql, 0, -1);
        $this->update_values = $set;

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
        $this->column        = '(' . implode(',', $columns) . ')';
        $this->insert_values = $values;

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
     * 使用 AND 连接的WHERE子句
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
            $sql                  .= "{$condition[0]} {$condition[1]} ? AND ";
            $this->where_values[] = $condition[2];
        }
        $this->conditions .= substr($sql, 0, -4);

        return $this;
    }

    /**
     * 使用 OR 连接的WHERE 子句
     *
     * @param array $conditions
     *
     * @return T_Model
     */
    protected function &orWhere(array $conditions): T_Model
    {
        $sql = empty($this->conditions) ? 'WHERE ' : 'OR ';
        foreach ($conditions as $condition) {
            $sql                  .= "{$condition[0]} {$condition[1]} ? OR ";
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
        $this->group = 'GROUP BY ' . implode(',', $column);
        if ( ! empty($having)) {
            $this->having = 'HAVING ';
            foreach ($having as $condition) {
                $this->having          .= "$condition[0] $condition[1] ? AND ";
                $this->having_values[] = $condition[3];
            }
            $this->having = substr($this->having, 0, -4);
        } else {
            $this->having = '';
        }

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

    /**
     * 执行 INSERT 语句
     * @return bool
     */
    protected function excInsert(): bool
    {
        $placeholder = '';
        foreach ($this->insert_values as $value) {
            $placeholder .= '?,';
        }
        $placeholder = '(' . substr($placeholder, 0, -1) . ')';
        $sql         =
            "INSERT INTO $this->table $this->column VALUES $placeholder";

        $stmt = $this->connect->prepare($sql);

        return $stmt->execute($this->insert_values);
    }

    /**
     * 执行 DELETE 语句
     * @return bool
     */
    protected function excDelete(): bool
    {
        $sql  = "DELETE FROM {$this->table} {$this->conditions}";
        $stmt = $this->connect->prepare($sql);

        return $stmt->execute($this->where_values);
    }

    /**
     * 执行 DELETE 语句
     * @return bool
     */
    protected function excUpdate(): bool
    {
        $sql  = "UPDATE {$this->table} SET {$this->update} {$this->conditions}";
        $stmt = $this->connect->prepare($sql);

        return $stmt->execute($this->update_values);
    }

    /**
     * 执行 SELECT 语句
     * @return bool|\PDOStatement
     */
    protected function excSelect()
    {
        $sql  = "SELECT {$this->column} FROM 
                {$this->table} {$this->join_table} 
                {$this->conditions} {$this->group} {$this->having} {$this->order}";
        $stmt = $this->connect->prepare($sql);
        if ( ! $stmt->execute(array_merge($this->where_values, $this->having_values))) {
            return false;
        } else {
            return $stmt;
        }
    }
}
