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
    protected $before;
    protected $onUpdate;
    protected $onDelete;
    protected $references;
    protected $table;
    protected $database;
    protected $engine;
    protected $value;
    protected $min;
    protected $max;


    protected static int $BOOLEAN_TYPE = 0; // column in type boolean
    protected static int $CHAR_TYPE = 1; // column in type char
    protected static int $VARCHAR_TYPE = 2; // column in type varchar
    protected static int $TEXT_TYPE = 3; // column in type text
    protected static int $INTEGER_TYPE = 4; // column in type integer
    protected static int $BIGINT_TYPE = 5; // column in type bigint
    protected static int $FLOAT_TYPE = 6; // column in type float
    protected static int $DOUBLE_TYPE = 7; // column in type double
}
