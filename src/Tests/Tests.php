<?php

namespace Arax\Tests;

require '../../vendor/autoload.php';

use Arax\Tools\Forms\Fields;
use Arax\Tools\Forms\CharField;
use Arax\Exceptions\Forms\ValidatorException;
use Arax\Tools\Forms\Form;
use Arax\Tools\Forms\IntegerField;

class Tests extends Form
{
    protected $name;
    protected $age;
    protected $tall;
    public function __construct($post)
    {
        parent::__construct($post);
        $check = function ($name){
            if(strlen($name) >= 10){
                throw new ValidatorException("Longeur excessive");
            }
        };
        
        $this->name = new CharField(required: false, min_length:2, exclude: ['haw'] , callback: $check);
        $this->age = new IntegerField(required:false, min:10, max:100);
        
    }

    
}


$data = [
    #'name' => '   ',
    'age' => ' 10 '
];
$test  = new Tests($data);
var_dump($test->is_valid());
var_dump($test->errors_msg());
var_dump($test->clean_data());
//var_dump($test);

//throw new ValidatorException('Error mess');
