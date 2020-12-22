<?php
class sport   {
    private $sport_num;
    private $sport_type;
    private $price;
    private $max_trainees;
    private $available_seats;
    private $trainning_days;

    function __construct()
    {
    }

    function setSport_Num($sport_num){
        $this->sport_num=$sport_num;
    }
    function getSport_Num(){
        return $this->$sport_num;
    }

    function setSport_Type($sport_type){
        $this->sport_type=$sport_type;
    }
    function getSport_Type(){
        return $this->$sport_type;
    }

    function setPrice($price){
        $this->price=$price;
    }
    function getPrice(){
        return $this->$price;
    }

    function setMax_Trainees($max_trainees){
        $this->max_trainees=$max_trainees;
    }
    function getMax_Trainees(){
        return $this->$max_trainees;
    }
    
    function setAvailable_Seats($available_seats){
        $this->available_seats=$available_seats;
    }
    function getAvailable_Seats(){
        return $this->$available_seats;
    }

    function setTrainning_Days($trainning_days){
        $this->trainning_days=$trainning_days;
    }
    function getTrainning_Days(){
        return $this->$trainning_days;
    }
   
}
?>