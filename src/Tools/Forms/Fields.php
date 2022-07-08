<?php

namespace Arax\Tools\Forms;

class Fields
{
    protected $min;
    protected $max;
    protected $min_length;
    protected $max_length;
    protected $value;
    protected $label;
    protected $in;
    protected $exclude;
    protected $callback;
    protected $error;
    protected $name;
    protected $required;
    /**
     * @var bool
     */
    protected $valid;
    protected $msg_error;


    public function get_error(): string{
        return $this->msg_error;
    }




    

    
}
