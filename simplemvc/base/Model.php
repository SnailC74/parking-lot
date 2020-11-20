<?php
namespace simplemvc\base;

use simplemvc\db\Sql;

class Model extends Sql
{
    protected $model;

    public function __construct()
    {
        // get the table name
        if (!$this->table) {

            // get the model name
            $this->model = get_class($this);

            // delete the last 'model' in model name
            $this->model = substr($this->model, 0, -5);

            // set the model name to table name
            $this->table = strtolower($this->model);

            $this->primary = strtolower($this->model) . 'ID';
        }
    }
}