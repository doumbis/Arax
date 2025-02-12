<?php

namespace Arax\Core\Models;

use Arax\Core\Sql\Table;

class Model extends Table
{

    private $name;

    protected function setMeta()
    {
        $this->tableName = 'users';
        $this->description = 'This table is used to store users';
    }

    protected function migrations() {}
}
