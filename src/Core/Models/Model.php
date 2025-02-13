<?php

namespace Arax\Core\Models;

use Arax\Core\Sql\Column;
use Arax\Core\Sql\Table;

class Model extends Table
{

    public Column $name;
    public Column $age;

    protected function setMeta()
    {
        $this->tableName = 'users';
        $this->description = 'This table is used to store users';
    }

    protected function migrations()
    {
        $this->name = Column::charField('name', 'Name of the user', false, 255, null, false, 'The name of the user');
        $this->age = Column::integerField('age', 'Age of the user', false, 3, null, false, 'The age of the user');
    }
}
