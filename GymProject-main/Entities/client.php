<?php
require __DIR__."/../Entity.php";
class Client extends Entity   {
    private $national_id;
    private $phone_number;
    private $email;
    private $id;
    private $gender;
    private $inbody;
    private $name;
    private $date_of_sub;
    private $date_of_birth;
    private $date_of_register;
    private $password;
    private $active;
    function __construct()
    {

    }

    static function withJson($entity_json){
        $client=new client();
        $client=parent::getInstance($entity_json);
        return $client;
    }

    function setActive($active){
        $this->active=$active;
    }

    function getActive(){
        return $this->active;
    }

    function setPassword($password){
        $this->password=$password;
    }

    function getPassword(){
        return $this->password;
    }

    function setNational_id($national_id){
        $this->national_id=$national_id;
    }

    function getNational_id(){
        return $this->national_id;
    }

    
    function setPhone_number($phone_number){
        $this->phone_number=$phone_number;
    }

    function getPhone_number(){
        return $this->phone_number;
    }

    function setEmail($email){
        $this->email=$email;
    }

    function getEmail(){
        return $this->email;
    }

    function setId($id){
        $this->id=$id;
    }

    function getId(){
        return $this->id;
    }

    function setGender($gender){
        $this->gender=$gender;
    }

    function getGender(){
        return $this->gender;
    }

    function setInbody($inbody){
        $this->inbody=$inbody;
    }
    
    function getInbody(){
        return $this->inbody;
    }

    function setName($name){
        $this->name=$name;
    }

    function getName(){
        return $this->name;
    }
    function setDate_of_sub($date_of_sub){
        $this->date_of_sub=$date_of_sub;
    }

    function getDate_of_sub(){
        return $this->date_of_sub;
    }

    function setDate_of_birth($date_of_birth){
        $this->date_of_sub=$date_of_birth;
    }

    function getDate_of_birth(){
        return $this->date_of_birth;
    }

    function setDate_of_register($date_of_register){
        $this->date_of_register=$date_of_register;
    }

    function getDate_of_register(){
        return $this->date_of_register;
    }



}


?>