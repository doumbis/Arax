<?php

namespace Arax\Core\Models;

use Arax\Core\Sql\Column;
use Arax\Core\Sql\Table;

class Model extends Table
{

    public Column $name;
    public Column $male;

    protected function setMeta()
    {
        $this->tableName = 'users';
        $this->connection = null; // it uses the default connection in your database.json
        $this->description = 'This table is used to store users';
    }

    // This method is used to define the columns of the table
    // you can use this method to handle all ddl changes
    protected function migrations()
    {
        $this->name = Column::VarCharField('name', 255, false, null, false);
        $this->male = Column::BooleanField('male', false, true);
    }
}
