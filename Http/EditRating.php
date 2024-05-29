<?php
namespace Http;
class EditRating{
    public $attributes=[];
    public $itemsTable="";
    public $ratingActions="";
    public  function __construct($attributes){
        $this->attributes=$attributes;
        $this->itemsTable=$attributes["itemsTable"];
        $this->ratingActions=$attributes["ratingActions"];
    }
    public function edit(){
        if($this->attributes["oldOpinion"]==NULL){
            $this->forTheFirstTime();
        }
    }
    public function forTheFirstTime(){
        switch($this->attributes["newOpinion"]){
            case "plus":
                $newRating=$this->attributes["oldRating"]+1;
                $this->attributes['db']->query("UPDATE $this->itemsTable SET `rating` = :new_rating WHERE $this->itemsTable.`id` = :id",[
                    "new_rating"=>$newRating,
                    "id"=>$this->attributes["question_id"]
                ]);
                break;
            case "minus":
                $newRating=$this->attributes["oldRating"]-1;
                $this->attributes['db']->query("UPDATE $this->itemsTable SET `rating` = :new_rating WHERE $this->itemsTable.`id` = :id",[
                    "new_rating"=>$newRating,
                    "id"=>$this->attributes["question_id"]
                ]);
        }
        $this->attributes['db']->query("INSERT INTO $this->ratingActions (`id`, `user_id`, `question_id`, `opinion`) VALUES (NULL, :user_id, :question_id, :opinion)",[
        "user_id"=>$this->attributes["user_id"],
        "question_id"=>$this->attributes["question_id"],
        "opinion"=>$_POST["opinion"]
        ]);
        redirect("/question?id=".$this->attributes['question_id']);
    }
}
