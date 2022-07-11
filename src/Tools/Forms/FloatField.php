<?php

namespace Arax\Tools\Forms;
use Arax\Exceptions\Forms\ValidatorException;

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

    public function verify_input($var, $input=[]): bool{
        $this->msg_error = "";
        $this->value = null;
        if($this->name == null){
            $this->name = $var;
        }

        if($this->required == true){
            if(!array_key_exists($var, $input)){
                $this->msg_error = "The field ". $this->name . ' is required';
                return false;
            }
            $data = $input[$var];
            if($data == null || $data == ''){
                $this->msg_error = "The field ". $this->name . ' is required';
                return false;
            }
        }else{
            $data = null;
            if(array_key_exists($var, $input)){
                $data = $input[$var];
            }
            if($data === null){
                return true;
            }
        }
        if(!is_numeric($data)){
            $this->msg_error = "The field ". $this->name . ' must be an integer value';
            return false;
        }
        $number = floatval($data);
        if($this->min != null && $this->min > $number){
            $this->msg_error = 'The minimal value that the field '. $this->name . ' can hold is  '. $this->min;
            return false;
        }
        if($this->max != null && $this->max < $number){
            $this->msg_error = 'The maximal value that the field '. $this->name . ' can hold is '. $this->max;
            return false;
        }
        if(sizeof($this->in) > 0 && !in_array($number, $this->in)){
            $this->msg_error = 'The value does not exist';
            return false;
        }
        if(sizeof($this->exclude) > 0 && in_array($number, $this->exclude)){
            $this->msg_error = 'The value is excluded';
            return false;
        }
        if(is_callable($this->callback)){
            $method = $this->callback;
            try{
                $method($number);
            }catch(ValidatorException $e){
                $this->msg_error = $e->getMessage();
                return false;
            }
        }
        $this->value = $number;
        return true;

    }
}
