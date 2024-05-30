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
        $this->item_id=$attributes["item_id"];
    }                                                          
    public function edit(){
        if($this->attributes["oldOpinion"]==NULL){
            $this->forTheFirstTime();
        }else{
            if($this->attributes["newOpinion"]==$this->attributes["oldOpinion"]){
                $this->cancelOpinion();
            }else{
                $this->ChangeOpinion();

            }
        }
    }
    private function forTheFirstTime(){
        switch($this->attributes["newOpinion"]){
            case "plus":
                $newRating=$this->attributes["oldRating"]+1;
                $this->attributes['db']->query("UPDATE $this->itemsTable SET `rating` = :new_rating WHERE $this->itemsTable.`id` = :id",[
                    "new_rating"=>$newRating,
                    "id"=>$this->attributes["$this->item_id"]
                ]);
                break;
            case "minus":
                $newRating=$this->attributes["oldRating"]-1;
                $this->attributes['db']->query("UPDATE $this->itemsTable SET `rating` = :new_rating WHERE $this->itemsTable.`id` = :id",[
                    "new_rating"=>$newRating,
                    "id"=>$this->attributes["$this->item_id"]
                ]);
        }
        $this->attributes['db']->query("INSERT INTO $this->ratingActions (`id`, `user_id`, `$this->item_id`, `opinion`) VALUES (NULL, :user_id, :$this->item_id, :opinion)",[
            "user_id"=>$this->attributes["user_id"],
            "$this->item_id"=>$this->attributes["$this->item_id"],
            "opinion"=>$_POST["opinion"]
        ]);
    }
    private function cancelOpinion(){
        $this->attributes['db']->query("DELETE FROM $this->ratingActions WHERE user_id=:user_id AND $this->item_id=:$this->item_id",[
            "user_id"=>$this->attributes["user_id"],
            "$this->item_id"=>$this->attributes["$this->item_id"],
        ]);
        switch($this->attributes["newOpinion"]){
            case "plus":
                $newRating=$this->attributes["oldRating"]-1;
                $this->attributes['db']->query("UPDATE $this->itemsTable SET `rating` = :new_rating WHERE $this->itemsTable.`id` = :id",[
                    "new_rating"=>$newRating,
                    "id"=>$this->attributes["$this->item_id"]
                ]);
                break;
            case "minus":
                $newRating=$this->attributes["oldRating"]+1;
                $this->attributes['db']->query("UPDATE $this->itemsTable SET `rating` = :new_rating WHERE $this->itemsTable.`id` = :id",[
                    "new_rating"=>$newRating,
                    "id"=>$this->attributes["$this->item_id"]
                ]);
        }
    }
    private function ChangeOpinion(){
        switch($this->attributes["newOpinion"]){
            case "plus":
                $this->attributes["db"]->query("UPDATE $this->ratingActions SET `opinion` = 'plus' WHERE $this->ratingActions.`user_id` = :user_id AND $this->ratingActions.`$this->item_id` =:$this->item_id",[
                    "user_id"=>$this->attributes["user_id"],
                    "$this->item_id"=>$this->attributes["$this->item_id"],
                ]);
                $this->attributes["db"]->query("UPDATE $this->itemsTable SET `rating` = :new_rating WHERE $this->itemsTable.`id` = :id",[
                    "new_rating"=>($this->attributes["oldRating"]+2),
                    "id"=>$this->attributes["$this->item_id"]
                ]);
                break;
            case "minus":
                $this->attributes["db"]->query("UPDATE $this->ratingActions SET `opinion` = 'minus' WHERE $this->ratingActions.`user_id` = :user_id AND $this->ratingActions.`$this->item_id` =:$this->item_id",[
                    "user_id"=>$this->attributes["user_id"],
                    "$this->item_id"=>$this->attributes["$this->item_id"],
                ]);
                $this->attributes["db"]->query("UPDATE $this->itemsTable SET `rating` = :new_rating WHERE $this->itemsTable.`id` = :id",[
                    "new_rating"=>($this->attributes["oldRating"]-2),
                    "id"=>$this->attributes["$this->item_id"]
                ]);
        }
    }
}
