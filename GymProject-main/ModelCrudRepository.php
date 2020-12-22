
<?php
class ModelCrudRepository
{
    private  $servername = "localhost";
    private  $username = "root";
    private $password = "";
    private $entity_name;
    private $conn;
    private $stmt;

    public function __construct($conn, $entity_name)
    {
        try {
            $this->conn = $conn;
            $this->entity_name = $entity_name;
        } catch (PDOException $e) {
            echo "connection failed" . $e->getMessage();
        }
    }

    public function  findOne($fields)
    {
        $table_name = strtolower($this->entity_name);

        $query = "select * from $table_name " . $this->generateFindQuery($fields);
        $this->stmt = $this->conn->prepare($query);
        $this->bindStmtParams($fields);
        $this->stmt->execute();
        $this->stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $this->stmt->fetchAll();
        $Entity = $this->convertResultIntoEntities($result)[0];
        return $Entity;
    }

    public  function find($fields)
    {
        $table_name = strtolower($this->entity_name);

        $query = "select * from $table_name " . $this->generateFindQuery($fields);
        $this->stmt = $this->conn->prepare($query);
        /*    $name="sharaf";
            $id=1;
            $this->stmt->bindParam(":name",$name);
            $this->stmt->bindParam(":id",$id); */
        $this->bindStmtParams($fields);
        $this->execute();
        $this->stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $this->stmt->fetchAll();
        $Entities = $this->convertResultIntoEntities($result);
        return $Entities;
    }

    public function save($entity)
    { 
        $id=$entity->getId();
        $entity->setId(null);
        $params = $this->extractEntityAttributes($entity);
        $query=$id?$this->generateUpdateQuery($entity,$id):$this->generateSaveQuery($entity);
        $this->stmt = $this->conn->prepare($query);
        $this->bindStmtParams($params);
        $this->execute();
    
        

    }
    private function execute(){
        if($this->stmt->execute())
        {

        }
        else
            throw new Exception($this->stmt->errorInfo()[2]);
        
        
       
    }

    private function extractEntityAttributes($entity)
    {
        $methods = get_class_methods($this->entity_name);
        $attributes = new stdClass();
        foreach ($methods as $method) {
            if (substr($method, 0, 3) == "get") {
                // $attributes[strtolower(substr($method,3))]=$entity->$method();
                $field = strtolower(substr($method, 3));
                if (null!==$entity->$method())
                {
                    $attributes->$field = $entity->$method();
                }
                }
        }
        return $attributes;
    }
    private function generateSaveQuery($entity)
    {
        $attributes = (array)$this->extractEntityAttributes($entity);
        $col_names = implode(",", array_keys($attributes));
        $query = "insert into " . strtolower($this->entity_name) . " ($col_names) values (";
        foreach ($attributes as $attribute => $value) {
            $query .= ":$attribute,";
        }
        $query = substr($query, 0, strlen($query) - 1);
        $query = $query . ")";
        return $query;
    }
    
    private function generateUpdateQuery($entity,$identifier){
        $attributes = (array)$this->extractEntityAttributes($entity);
        $query="update ".$this->entity_name." SET ";
        foreach($attributes as $attr=>$value){
            $query.=$attr."= :".$attr." ,";
        }
        $query=substr($query,0,strlen($query)-1);
        $query.=" WHERE ".$this->entity_name.".id = ".$identifier;
        return $query;
    }

    private function generateFindQuery($fields)
    {
        $query = "where ";

        foreach ($fields as $field => $value) {
            $query = $query . "$field= :$field and ";
        }

        return $query = substr($query, 0, strlen($query) - 4);
    }

    private function bindStmtParams($params)
    {
        foreach ($params as $param => $value) {
            $this->stmt->bindParam(":" . $param, $params->$param);
        }
    }

    private  function convertResultIntoEntities($rslt_set)
    {
        $entities = array();
        foreach ($rslt_set as $rslt) {
            array_push($entities, $this->convertResultToEntity($rslt));
        }
        return $entities;
    }
    private  function convertResultToEntity($rslt)
    {
        $class_name = get_class($this);
        $entity = new $this->entity_name;
        foreach ($rslt as $attr => $value) {
            $setter_method = $this->convertAttributeIntoSetter($attr);
            
            $entity->$setter_method($value);
        }
        return $entity;
    }

    private function convertAttributeIntoSetter($attr)
    {
        $methods = get_class_methods($this->entity_name);
        $setter_method = "";
        for ($i = 0; $i < count($methods); $i++) {
            if (strtolower($methods[$i]) == "set" . strtolower($attr)) {
                $setter_method = $methods[$i];
            }
        }
        return $setter_method;
    }
}
