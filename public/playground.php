<?php
use Illuminate\Support\Collection;
require __DIR__."/../vendor/autoload.php";

$numbers= new Collection([
  1,2,3,4,5
]);
 $numbers=$numbers->filter(function ($number){
  return $number>2;
});
var_dump($numbers);