<?php

namespace Arax\Tools\Forms;

class IntegerField extends Fields
{

    public function __construct(
        int $min = null,
        int $max = null,
        string $label = null,
        array $in = [],
        array $exclude = [],
        $callback = null,
        string $name = null
    ) {
        $this->min = $min;
        $this->max = $max;
        $this->label = $label;
        $this->in = $in;
        $this->exclude = $exclude;
        $this->callback = $callback;
        $this->name = $name;
    }


    private function verify_input(): void{
        $this->valid = false;

    }
}
