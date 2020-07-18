<?php


namespace App;


abstract class Model
{

    public const TABLE = '';
    public $id;


    public static function findAll()
    {
        $db = new Db();
        $sql = 'SELECT * FROM ' . static::TABLE;
        return $db->query(
            $sql,
            [],
            static::class
        );
    }

    public static function findById($id)
    {
        $db = new Db();
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE id = :id;';
        return $db->query(
            $sql,
            [':id' => $id],
            static::class
        )['0'];

    }

    public static function lastNumber($number)
    {
        $db = new Db();
        $sql = 'SELECT * FROM ' . static::TABLE . ' ORDER BY id DESC LIMIT ' . $number;
        return $db->query($sql,[],static::class);
    }

    public function insert()
    {
        $fields = get_object_vars($this);

        $collums = [];
        $data = [];

        foreach ($fields as $name => $value) {
            if ('id' == $name) {
                continue;
            }
            $collums [] = $name;
            $data[':' . $name] = $value;
        }

        $sql = 'INSERT INTO ' . static::TABLE . ' 
        (' . implode(',', $collums) .') 
        VALUES 
        (' . implode(',', array_keys($data)) .')
        ';

        $db = new Db();
        $db->execute($sql, $data);

        $this->id = $db->getLastId();

    }

    public function update()
    {
        $fields = get_object_vars($this);

        $columns = [];
        $data = [];

        foreach ($fields as $name => $value) {
            if ('id' == $name) {
                continue;
            }
            $columns[] = $name . ' = :' . $name;
            $data[':' . $name] = $value;
        }

       $sql = 'UPDATE ' . static::TABLE .
            ' SET ' . ' 
        ' . implode(',', $columns) .' 
        WHERE id = :id
        ';
        $db = new Db();
        $data ['id'] = $this->id;
        $db->execute($sql, $data);

    }

    public function isNew()
    {
        return empty($this->id);
    }

    public function save()
    {
        if (!$this->isNew())
        {
            $this->update();
        }else{
            $this->insert();
        }
    }

    public function delete()
    {
        echo $sql = 'DELETE FROM ' . static::TABLE . ' WHERE id = :id';
        $db = new Db();
        $data ['id'] = $this->id;
        $db->execute($sql, $data);
    }

}