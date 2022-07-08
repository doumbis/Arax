<?php

namespace Arax\Tools\Forms;

class CharField extends Fields
{

    public function __construct(
        int $min_length = null,
        int $max_length = null,
        string $label = null,
        array $in = [],
        array $exclude = [],
        $callback = null,
        string $name = null
    ) {
        $this->min_length = $min_length;
        $this->max_length = $max_length;
        $this->label = $label;
        $this->in = $in;
        $this->exclude = $exclude;
        $this->callback = $callback;
        $this->name = $name;
    }


    public function verify_input($input=[]): void{
        $this->valid = false;


    }
}
