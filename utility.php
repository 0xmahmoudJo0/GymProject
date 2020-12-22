<?php

    class Utils{
        static public function find_endpoint_from_path ($path){
            $paths=explode('/',$path);
            $end_point="";
            for($i=4;$i<count($paths);$i++)
                $end_point.="/".$paths[$i];
            return $end_point;
        }
        
        static public function convert_json_to_Entity(){
            
        }
    }

?>

