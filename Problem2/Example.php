<?php
require_once "Animal.php";
require_once "Animal/traits/Fly.php";
require_once "Animal/Bee.php";
require_once "Animal/Dolphin.php";
require_once "Animal/Eagle.php";
require_once "Animal/Lion.php";

echo "<br />Dolphin <br />";
$obj = new Dolphin(12);
echo "age -> ".$obj->getAge()."<br />";
echo "sleep -> ".$obj->Sleep()."<br />";
echo "swim -> ".$obj->Swim()."<br />";
echo "eat -> ".$obj->Eat()."<br />";

echo "<br />Lion <br />";
$obj = new Lion(6);
echo "age -> ".$obj->getAge()."<br />";
echo "sleep -> ".$obj->Sleep()."<br />";
echo "roar -> ".$obj->Roar()."<br />";
echo "eat -> ".$obj->Eat()."<br />";

echo "<br />Eagle <br />";
$obj = new Eagle(8);
echo "age -> ".$obj->getAge()."<br />";
echo "sleep -> ".$obj->Sleep()."<br />";
echo "fly -> ".$obj->Fly()."<br />";
echo "eat -> ".$obj->Eat()."<br />";

echo "<br />Bee <br />";
$obj = new Bee(2);
echo "age -> ".$obj->getAge()."<br />";
echo "sleep -> ".$obj->Sleep()."<br />";
echo "fly -> ".$obj->Fly()."<br />";
echo "eat -> ".$obj->Eat()."<br />";