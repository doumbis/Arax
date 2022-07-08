<?php
namespace Arax\Tools\Forms;

class Form{
    /**
     * @var array VALUES
     */
    private $post_value;
    
    /**
     * @var array variable name
     */
    private $variables;
    private $errors;

    public function __construct(array $post=[])
    {
        $this->post_value = $post;
        $this->variables = [];
        $this->errors = [];
    }


    public function is_valid(){
        $this->variables = self::get_variable($this);
        $this->errors = [];
        if(sizeof($this->variables) == 0){
            return false;
        }
        $invalid = 0;
        foreach ($this->variables as $name) {
            $obj = $this->{$name};
            $valid = $obj->verify_input($name, $this->post_value);
            if($valid == false){
                $invalid++;
                $this->errors[] = $obj->get_error();
            }
        }
        return $invalid == 0 ? true: false;
    }


    public function errors_msg(): array{
        return $this->errors;
    }


    public static function get_variable($object): array{
        $vars = [];
        $properties = get_object_vars($object);
        foreach ($properties as $name => $instance) {
            if(self::is_belong_to_arax_field($instance)){
                $vars[] = $name;
            }
        }
        return $vars;
    }

    public static function is_belong_to_arax_field($field): bool{
        $result = $field instanceof CharField || $field instanceof FloatField || $field instanceof IntegerField;
        return $result;
    }

}

?>