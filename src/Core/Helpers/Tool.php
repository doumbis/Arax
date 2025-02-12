<?php

namespace Arax\Core\Helpers;

class Tool
{

    /**
     * This method is used to convert an array to an object
     *  @param array $data is the array to be converted to object
     *  @param object $object is the object where the array will be converted to
     *  @param array $map is the map of the array keys to the object properties 
     *  @param bool $setter is a flag to indicate if the method should use the setter method to modify
     * values of properties object
     *  @return void
     * 
     */
    public static function convertArrayToObject(array $data, $object, bool $setter = false, array $map = [])
    {
        foreach ($data as $key => $value) {
            if (array_key_exists($key, $map)) {
                $key = $map[$key];
            }
            if (property_exists($object, $key)) {
                if ($setter) {
                    $object->setter($key, $value);
                } else {
                    $object->{$key} = $value;
                }
            }
        }
    }
}
