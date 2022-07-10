<?php

namespace Arax\Tools\Forms;
use Arax\Exceptions\Forms\ValidatorException;

class CharField extends Fields
{

    public function __construct(
        bool $required = true,
        int $min_length = null,
        int $max_length = null,
        array $in = [],
        array $exclude = [],
        $callback = null,
        string $name = null
    ) {
        $this->min_length = $min_length;
        $this->max_length = $max_length;
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
        if(!is_string($data)){
            $this->msg_error = "The field ". $this->name . ' must be a string';
            return false;
        }
        if($data == ''){
            $this->msg_error = "The field ". $this->name . ' is empty';
            return false;
        }

        $len_data = strlen($data);
        if($this->min_length != null && $this->min_length > $len_data){
            $this->msg_error = 'The length of the field '. $this->name . ' must be greater or equal to '. $this->min_length;
            return false;
        }
        if($this->max_length != null && $this->max_length < $len_data){
            $this->msg_error = 'The length of the field '. $this->name . ' must be lower or equal to '. $this->max_length;
            return false;
        }
        if(sizeof($this->in) > 0 && !in_array($data, $this->in)){
            $this->msg_error = 'The value does not exist';
            return false;
        }
        if(sizeof($this->exclude) > 0 && in_array($data, $this->exclude)){
            $this->msg_error = 'The value is excluded';
            return false;
        }
        if(is_callable($this->callback)){
            $method = $this->callback;
            try{
                $method($data);
            }catch(ValidatorException $e){
                $this->msg_error = $e->getMessage();
                return false;
            }
        }
        $this->value = $data;
        return true;
    }


    
}
