<?php

namespace Arax\Core\Sql;

use Arax\Core\Helpers\Config;

class Table extends Database
{
    protected string $tableName = '';
    protected string $description = '';



    protected function setMeta() {}
    protected function  migrations() {}
    public function processDDL()
    {
        $this->setMeta();
        $this->migrations();
        if (empty($this->connection)) {
            $this->connection = Config::$defaultConnection;
        } else {
        }
    }
}
