<?php
namespace simplemvc\db;

use \PDOStatement;

class Sql
{
    // tablename
    protected $table;

    // primary key name
    protected $primary = 'id';

    // filter with WHERE and ORDER
    private $filter = '';

    // Pdo bindParam() params
    private $param = array();

    /**
     * WHERE case
     *
     * @param array $where condition
     * @return $this
     */
//    public function where($where = array(), $param = array(), $type = 'and')
    public function where($where = array(), $type = 'and')
    {
        if ($where and !empty($where)) {
            $this->filter .= ' WHERE ';
            $keys = [];
            foreach ($where as $k=> &$w){
                if(is_string($k)){
//                    $w = '`' . $w . '`' . '= :' . $w;
                    array_push($keys, '`' . $k . '`' . '= :' . $k);
                }
            }
//            $this->filter .= implode(' '.$type.' ', $where);
            $this->filter .= implode(' '.$type.' ', $keys);
            $this->param = $where;
        }

        return $this;
    }

    /**
     * ORDER case
     *
     * @param array $order condition
     * @return $this
     */
    public function order($order = array())
    {
        if($order) {
            $this->filter .= ' ORDER BY ';
            $this->filter .= implode(',', $order);
        }

        return $this;
    }

    // find all
    public function fetchAll()
    {
        $sql = sprintf("select * from `%s` %s", $this->table, $this->filter);
        $sth = Db::pdo()->prepare($sql);
        $sth = $this->formatParam($sth, $this->param);
        $sth->execute();

        return $sth->fetchAll();
    }

    // find one
    public function fetch()
    {
        $sql = sprintf("select * from `%s` %s", $this->table, $this->filter);
        $sth = Db::pdo()->prepare($sql);
        $sth = $this->formatParam($sth, $this->param);
        $sth->execute();

        return $sth->fetch();
    }

    // delete by id
    public function delete($id)
    {
        $sql = sprintf("delete from `%s` where `%s` = :%s", $this->table, $this->primary, $this->primary);
        $sth = Db::pdo()->prepare($sql);
        $sth = $this->formatParam($sth, [$this->primary => $id]);
        $sth->execute();

        return $sth->rowCount();
    }

    // insert data
    public function add($data)
    {
        $sql = sprintf("insert into `%s` %s", $this->table, $this->formatInsert($data));
        $sth = Db::pdo()->prepare($sql);
        $sth = $this->formatParam($sth, $data);
        $sth = $this->formatParam($sth, $this->param);
        $sth->execute();

        return $sth->rowCount();
    }

    // update data
    public function update($data)
    {
        $sql = sprintf("update `%s` set %s %s", $this->table, $this->formatUpdate($data), $this->filter);
        $sth = Db::pdo()->prepare($sql);
        $sth = $this->formatParam($sth, $data);
        $sth = $this->formatParam($sth, $this->param);
        $sth->execute();

        return $sth->rowCount();
    }

    // count data
    public function count()
    {
        $sql = sprintf("select count(*) from `%s` %s", $this->table, $this->filter);
        $sth = Db::pdo()->prepare($sql);
        $sth = $this->formatParam($sth, $this->param);
        $sth->execute();

        return $sth->fetchColumn();
    }

    /**
     * Bind params
     * @param PDOStatement $sth
     * @param array $params
     * @return PDOStatement
     */
    public function formatParam(PDOStatement $sth, $params = array())
    {
        foreach ($params as $param => &$value) {
            $param = is_int($param) ? $param + 1 : ':' . ltrim($param, ':');
            $sth->bindParam($param, $value);
        }

        return $sth;
    }

    // tranform array to insert data
    private function formatInsert($data)
    {
        $fields = array();
        $names = array();
        foreach ($data as $key => $value) {
            $fields[] = sprintf("`%s`", $key);
            $names[] = sprintf(":%s", $key);
        }

        $field = implode(',', $fields);
        $name = implode(',', $names);

        return sprintf("(%s) values (%s)", $field, $name);
    }

    // transform array to update data
    private function formatUpdate($data)
    {
        $fields = array();
        foreach ($data as $key => $value) {
            $fields[] = sprintf("`%s` = :%s", $key, $key);
//            $fields[] = sprintf("`%s` = :%s", $key, $key);
        }

        return implode(',', $fields);
    }
}