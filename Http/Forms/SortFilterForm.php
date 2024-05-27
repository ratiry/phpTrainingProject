<?php
namespace Http\Forms;
class SortFilterForm{
  private $sorted;
  private $filtered;
  private function sort($sort){
    switch($sort){
      case "rating_ascending":
        return "ORDER BY `rating` ASC";
      case "rating_descending":
        return "ORDER BY `rating` DESC";
      case "":
        return "";
    };

  }
  private function filter($filter,$id){
    if($filter=="my_questions"){
       return "WHERE id=$id";
    }else if($filter!=""){
      return "WHERE category LIKE '$filter'";
    }else{
      return "";
    }
  }
  public function __construct($filter,$sort,$id){
    $this->sorted=$this->sort($sort);
    $this->filtered=$this->filter($filter,$id);
  }
  public static function compile($filter,$sort,$id){
    $instance=new static($filter,$sort,$id);
    if($instance->sorted!="" && $instance->filtered==""){
      return $instance->sorted;
    }
    if($instance->sorted!="" && $instance->filtered!=""){
      return $instance->filtered. " ". $instance->sorted;
    }
    if($instance->sorted=="" && $instance->filtered!=""){
      return $instance->filtered;
    }
    if($instance->sorted=="" && $instance->filtered==""){
      return "";
    }    
  }
}