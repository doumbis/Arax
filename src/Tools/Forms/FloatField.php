<?php

namespace Arax\Tools\Forms;

class FloatField extends Fields
{
    public function __construct(
        bool $required = true,
        int $min = null,
        int $max = null,
        array $in = [],
        array $exclude = [],
        $callback = null,
        string $name = null
        
    ) {
        $this->min = $min;
        $this->max = $max;
        $this->in = $in;
        $this->exclude = $exclude;
        $this->callback = $callback;
        $this->name = $name;
        $this->required = $required;
    }
}
