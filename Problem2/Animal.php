<?php
class Animal {
    private $age;
    private $eat_sound = 'yummy';
    private $sleep_sound = 'zzzzzz';

    public function __construct($age){
        $this->age = $age;
    }

    public function Eat(){
        return $this->eat_sound;
    }

    public function Sleep(){
        return $this->sleep_sound;
    }

    public function getAge(){
        return $this->age;
    }
}
