<?php

namespace Arax\Tests;

require '../../vendor/autoload.php';

use Arax\Tools\Forms\Fields;
use Arax\Tools\Forms\CharField;
use Arax\Exceptions\Forms\ValidatorException;
use Arax\Tools\Forms\Form;





class Tests extends Form
{
    protected $name;
    public function __construct($post)
    {
        parent::__construct($post);
        $check = function ($name){
            if(strlen($name) >= 10){
                throw new ValidatorException("Longeur excessive");
            }
        };
        
        $this->name = new CharField(required: true, min_length:2, in: ['hac', 'haw'], exclude: ['haw'] , callback: $check);
        
    }

    
}


$test  = new Tests(['name' => 'haw']);
var_dump($test->is_valid());
var_dump($test->errors_msg());
//var_dump($test);

//throw new ValidatorException('Error mess');
