<?php

namespace Arax\Core\Sql;

class Table extends Database
{
    protected $tableName;
    protected $description;



    protected function setMeta() {}
    protected function  migrations() {}
    public function processDDL()
    {
        $this->setMeta();
        echo $this->tableName;
        echo "\n";
    }
}
