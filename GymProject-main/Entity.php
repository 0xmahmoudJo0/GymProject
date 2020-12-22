<?php

class Entity implements JsonSerializable
    {
        function __construct()
        {
            
        }
      /*   static function getInstance($entity_json)
        {
            $entity_name=get_called_class();
            $methods = get_class_methods($entity_name);
            $entity=new $entity_name();
        $setter_method = "";
        foreach((array)$entity_json as $attr=>$value) {
            $setter_method="set".lcfirst($attr);
        }
        return $setter_method;
           
           
        } */

        public function load_json($entity_json){
            foreach((array)$entity_json as $attr=>$value){
                $method_name="set".lcfirst($attr);
                $this->$method_name($value);
            }
            return $this;
        }

        public function jsonSerialize() {
            $methods = get_class_methods(get_called_class());
            $json =array();
        foreach ($methods as $method) {
            if (substr($method, 0, 3) == "get"&&$method!="getInstance") {
                echo $method;
                // $attributes[strtolower(substr($method,3))]=$entity->$method();
                $field = strtolower(substr($method, 3));
                $json[$field]=$this->$method;
            }
        }
        return $json;
        }
    }
