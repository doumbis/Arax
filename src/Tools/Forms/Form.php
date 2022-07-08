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

    public function __construct(array $post=[])
    {
        $this->post_value = $post;
        $this->variables = [];
    }


    public function is_valid(){
        $this->variables = self::get_variable($this);
        foreach ($this->variables as $name) {
            
        }
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