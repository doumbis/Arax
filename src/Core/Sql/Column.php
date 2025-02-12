<?php

namespace Arax\Core\Sql;

class Column
{
    protected $name;
    protected $type;
    protected $length;
    protected $default;
    protected $nullable;
    protected $autoIncrement;
    protected $primaryKey;
    protected $unique;
    protected $index;
    protected $foreign;
    protected $comment;
    protected $after;
    protected $first;
    protected $before;
    protected $onUpdate;
    protected $onDelete;
    protected $references;
    protected $table;
    protected $database;
    protected $engine;
}
