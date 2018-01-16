<?php

namespace Models;

use DB;

class Model
{
    protected $table = '';
    protected $fillables = [];

    function __construct()
    {

    }

    public function find($id)
    {
        $query = DB::getInstance()->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $query->execute([
            'id' => $id,
        ]);

        $model = $query->fetch(\PDO::FETCH_OBJ);
        if (!$model) {
            return NULL;
        } else {
            $this->id = $model->id;
            foreach ($this->fillables as $prop) {
                if (isset($model->{$prop})) {
                    $this->{$prop} = $model->{$prop};
                }
            }
            return $this;
        }
    }

    public function save()
    {
        if (isset($this->id) && !is_null($this->id)) {
            // update
            return DB::getInstance()->exec($this->formatUpdateQuery());
        } else {
            // insert
            return DB::getInstance()->exec($this->formatInsertQuery());
        }
    }

    protected function formatUpdateQuery()
    {
        $sql = "UPDATE {$this->table} SET ";
        $first = true;
        foreach ($this->fillables as $value) {
            if ($value !== 'id' && isset($this->{$value})) {
                if ($first === false) {
                    $sql .= ', ';
                }
                $sql .= "{$value} = \"{$this->{$value}}\"";
                $first = false;
            }
        }
        $sql .= " WHERE id = {$this->id}";
        return $sql;
    }

    protected function formatInsertQuery()
    {
        $sql = "INSERT INTO {$this->table} ";
        $values = '(';
        $data = '("';
        $first = true;
        foreach ($this->fillables as $value) {
            if ($value !== 'id' && isset($this->{$value})) {
                if ($first === false) {
                    $values .= ', ';
                    $data .= '", "';
                }
                $values .= $value;
                $data .= $this->{$value};
                $first = false;
            }
        }
        $values .= ')';
        $data .= '")';
        $sql .= "$values VALUES $data";
        return $sql;
    }

    public function getFillables()
    {
        return $this->fillables;
    }
}
