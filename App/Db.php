<?php


namespace App;


class Db
{

    protected $dbh;

    public function  __construct()
    {
        $config = (include __DIR__ . '/config.php') ['db'];
        $this->dbh = new \PDO(
            'mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'],
            $config['user'],
            $config['password']
        );
    }


    public function execute($sql, $params=[])
    {

        $sth = $this->dbh->prepare($sql);
        return $sth->execute($params);

    }

    public function getLastId()
    {
        return $this->dbh->lastInsertId();
    }


    public function query($sql, $params = [], $class = null)
    {
        $sth = $this->dbh->prepare($sql);
        $sth->execute($params);


        return $sth->fetchAll(\PDO::FETCH_CLASS, $class);


        /*$data = $sth->fetchAll();
        $ret = [];
        foreach ($data as $row) {
            $item = new $class;
            foreach ($row as $key => $val) {
                if (is_numeric($key)) {
                    continue;
                }
                $item->$key = $val;
            }
            $ret[] = $item;
        }

        return $ret;*/
    }



}