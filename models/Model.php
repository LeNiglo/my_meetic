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
            $sql = "UPDATE {$this->table} SET ";
            foreach ($this->fillables as $key => $prop) {
                if ($key > 0) {
                    $sql .= ", ";
                }
                $sql .= "$prop = \"{$this->{$prop}}\"";
            }
        } else {
            // insert
            $sql = "INSERT INTO {$this->table} ({$this->formatFillables(false)}) VALUES ({$this->formatFillables(true)})";
        }
        return DB::getInstance()->exec($sql);
    }

    public function getFillables()
    {
        return $this->fillables;
    }

    private function formatFillables($_v = false)
    {
        if ($_v === true) {
            $values = [];
            foreach ($this->fillables as $prop) {
                $values[] = isset($this->{$prop}) ? $this->{$prop} : NULL;
            }
            return '"' . implode('", "', $values) . '"';
        } else {
            return implode(', ', $this->fillables);
        }
    }
}
