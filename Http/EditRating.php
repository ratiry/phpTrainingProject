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
        if($this->attributes["newOpinion"]==$this->attributes["oldOpinion"]){
            $this->cancelOpinion();
        }
    }
    private function forTheFirstTime(){
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
    private function cancelOpinion(){
        $this->attributes['db']->query("DELETE FROM $this->ratingActions WHERE user_id=:user_id AND question_id=:question_id",[
            "user_id"=>$this->attributes["user_id"],
            "question_id"=>$this->attributes["question_id"],
        ]);
        switch($this->attributes["newOpinion"]){
            case "plus":
                $newRating=$this->attributes["oldRating"]-1;
                $this->attributes['db']->query("UPDATE $this->itemsTable SET `rating` = :new_rating WHERE $this->itemsTable.`id` = :id",[
                    "new_rating"=>$newRating,
                    "id"=>$this->attributes["question_id"]
                ]);
                break;
            case "minus":
                $newRating=$this->attributes["oldRating"]+1;
                $this->attributes['db']->query("UPDATE $this->itemsTable SET `rating` = :new_rating WHERE $this->itemsTable.`id` = :id",[
                    "new_rating"=>$newRating,
                    "id"=>$this->attributes["question_id"]
                ]);
        }
        redirect("/question?id=".$this->attributes['question_id']);
    }
    private function ChangeOpinion(){
        switch($this->attributes["newOpinion"]){
            case "plus":
                $this->attributes["db"]->query("UPDATE $this->ratingActions SET `opinion` = 'plus' WHERE $this->ratingActions.`user_id` = :user_id AND $this->ratingActions.`question_id` =:question_id",[
                    "user_id"=>$this->attributes["user_id"],
                    "question_id"=>$this->attributes["question_id"],
                ]);
                $this->attributes["db"]->query("UPDATE $this->itemsTable SET `rating` = :new_rating WHERE $this->itemsTable.`id` = :id",[
                    "new_rating"=>($this->attributes["oldRating"]+2),
                    "id"=>$this->attributes["question_id"]
                ]);
                break;
            case "minus":
                $this->attributes["db"]->query("UPDATE $this->ratingActions SET `opinion` = 'minus' WHERE $this->ratingActions.`user_id` = :user_id AND $this->ratingActions.`question_id` =:question_id",[
                    "user_id"=>$this->attributes["user_id"],
                    "question_id"=>$this->attributes["question_id"],
                ]);
                $this->attributes["db"]->query("UPDATE $this->itemsTable SET `rating` = :new_rating WHERE $this->itemsTable.`id` = :id",[
                    "new_rating"=>($this->attributes["oldRating"]-2),
                    "id"=>$this->attributes["question_id"]
                ]);
        }
        redirect("/question?id=".$this->attributes['question_id']);
    }
}
