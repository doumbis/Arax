<?php

namespace Arax\Tools\Forms;

class FloatField extends Fields
{
    public function __construct(
        int $min = null,
        int $max = null,
        string $label = null,
        array $in = [],
        array $exclude = [],
        $callback = null
    ) {
        $this->min = $min;
        $this->max = $max;
        $this->label = $label;
        $this->in = $in;
        $this->exclude = $exclude;
        $this->callback = $callback;
    }
}
