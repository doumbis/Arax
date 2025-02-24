<?php

namespace Arax\Core\Sql;

class Column
{
    protected $name;
    protected $type;
    protected $length;
    protected $default;
    protected $nullable;
    protected $unique;
    protected $value;
    protected $min;
    protected $max;
    protected $precision;


    public static int $BOOLEAN_TYPE = 0; // column in type boolean
    public static int $VARCHAR_TYPE = 2; // column in type varchar
    public static int $TEXT_TYPE = 3; // column in type text
    public static int $INTEGER_TYPE = 4; // column in type integer
    public static int $BIGINT_TYPE = 5; // column in type bigint
    public static int $FLOAT_TYPE = 6; // column in type float
    public static int $DOUBLE_TYPE = 7; // column in type double



    public function get()
    {
        return $this->value;
    }

    private function  initBooleanField(string $name = '', bool $nullable = true, bool $defaultValue = null)
    {
        $this->name = $name;
        $this->type = self::$BOOLEAN_TYPE;
        $this->nullable = $nullable;
        $this->default = $defaultValue;
    }

    private function  initVarCharField(string $name = '', int $length = 255, bool $nullable = true, string $defaultValue = null, bool $unique = false)
    {
        $this->name = $name;
        $this->type = self::$VARCHAR_TYPE;
        $this->length = $length;
        $this->nullable = $nullable;
        $this->default = $defaultValue;
    }

    public static function BooleanField(string $name = '', bool $nullable = true, bool $defaultValue = null): Column
    {
        $booleanField = new Column();
        $booleanField->initBooleanField($name, $nullable, $defaultValue);
        return $booleanField;
    }

    public static function VarCharField(string $name = '', int $length = 255, bool $nullable = true, string $defaultValue = null, bool $unique = false): Column
    {
        $varCharField = new Column();
        $varCharField->initVarCharField($name, $length, $nullable, $defaultValue, $unique);
        return $varCharField;
    }

    public static function TextField(): void {}

    public static function IntegerField(): void {}

    public static function BigIntField(): void {}

    public static function FloatField(): void {}

    public static function DoubleField(): void {}
}
