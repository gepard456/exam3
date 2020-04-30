<?php

class QueryBuilder
{
    private static $instance = null;
    private $pdo, $query, $error = false, $results, $count;

    private function __construct($pdo)
    {
        try
        {
            $this->pdo = $pdo;
        }
        catch(PDOException $exception)
        {
            die($exception->getMessage());
        }
    }

    private function __clone(){}

    /**
     * PDO $pdo - экземпляр класса PDO
     * return QueryBuilder - экземпляр данного класса QueryBuilder
     */
    public static function getInstance(PDO $pdo)
    {
        if(!isset(self::$instance))
        {
            self::$instance = new self($pdo);
        }
        return self::$instance;
    }

    private function query($sql, $params = [])
    {
        $this->error = false;
        $this->query = $this->pdo->prepare($sql);

        if( count($params) )
        {
            $i = 1;
            foreach ($params as $param)
            {
                $this->query->bindValue($i, $param);
                $i++;
            }
        }

        if(!$this->query->execute())
        {
            $this->error = true;
        }
        else
        {
            $this->results = $this->query->fetchAll(PDO::FETCH_ASSOC);
            $this->count = $this->query->rowCount();
        }

        return $this;
    }

    private function action($action, $table, $where = [])
    {
        if( count($where) === 3 )
        {
            $operators = ['=', '>', '<', '>=', '<='];

            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];

            if( in_array($operator, $operators) )
            {
                $sql = "$action FROM $table WHERE $field $operator ?";

                if( !$this->query($sql, [$value])->error() )
                {
                    return $this;
                }
            }
        }

        return false;

    }

    /**
     * string $table - название таблицы
     * return QueryBuilder | false - экземпляр данного класса QueryBuilder, false - в случае ошибки
     */
    public function getAll($table)
    {
        $sql = "SELECT * FROM $table";
        if(!$this->query($sql)->error())
            return $this;

        return false;
    }

    /**
     * string $table - название таблицы
     * array $where - условие запроса
     * return QueryBuilder | false - экземпляр данного класса QueryBuilder, false - в случае ошибки
     */
    public function get($table, $where = [])
    {
        return $this->action("SELECT *", $table, $where);
    }

    /**
     * return array - ассоциативный массив результат запроса
     */
    public function results()
    {
        return $this->results;
    }

    /**
     * return array - первая записи из результата запроса
     */
    public function first()
    {
        return $this->results()[0];
    }

    /**
     * return int - кол-во записей в результате запроса
     */
    public function count()
    {
        return $this->count;
    }

    /**
     * string $table - название таблицы
     * array $where - условие запроса
     * return QueryBuilder | false - экземпляр данного класса QueryBuilder, false - в случае ошибки
     */
    public function delete($table, $where = [])
    {
        return $this->action("DELETE", $table, $where);
    }

    /**
     * string $table - название таблицы
     * array $fields - поля записи с соответственными значениями
     * return bool - true в случае успеха, false в случае ошибки
     */
    public function insert($table, $fields = [])
    {
        $values = '';
        foreach ($fields as $field) {
            $values .= '?,';
        }
        $values = rtrim($values, ',');

        $sql = "INSERT INTO $table (" . implode(',', array_keys($fields)) . ") VALUES (" . $values . ")";

        if( !$this->query($sql, $fields)->error() )
        {
            return true;
        }

        return false;
    }

    /**
     * string $table - название таблицы
     * int $id - id записи
     * array $fields - поля записи с соответственными значениями
     * return bool - true в случае успеха, false в случае ошибки
     */
    public function update($table, $id, $fields = [])
    {
        $set = '';
        foreach ($fields as $key => $field) {
            $set .= "$key = ?,";
        }

        $set = rtrim($set, ',');

        $sql = "UPDATE $table SET $set WHERE id = $id";

        //echo $sql; die;

        if( !$this->query($sql, $fields)->error() )
        {
            return true;
        }

        return false;
    }

    /**
     * return bool - true есть ошибка, false нет ошибки
     */
    public function error()
    {
        return $this->error;
    }
}