<?php

class plane   {
    
    private $plan_id;
    private $sport_num;
    private $price;
    private $duration;

    function __construct()
    {
    }

    function setPlan_id($plan_id){
        $this->plan_id=$plan_id;
    }

    function getPlane_id(){
        return $this->plan_id;
    }

    function setSport_num($sport_num){
        $this->sport_num=$sport_num;
    }

    function getSport_num(){
        return $this->$sport_num;
    }

    function setPrice($price){
        $this->price=$price;
    }

    function getPrice(){
        return $this->$price;
    }

    function setDuration($duration){
        $this->$duration=$duration;
    }

    function getDuration(){
        return $this->$duration;
    }


}

?>
