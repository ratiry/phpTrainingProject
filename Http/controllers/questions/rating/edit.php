<?php
use Core\App;
use Core\Session;
$db=App::resolve("Core\Database");
$auth= Session::get("user")["id"];
$question_id=$_POST["question_id"];

if($auth==NULL){
    redirect("/question?id=$question_id");
}
$opinion=$db->query("SELECT * FROM `ratingActions` WHERE `user_id` = :user_id AND `question_id` = :question_id",[
    "user_id"=>Session::get("user")["id"],
    "question_id"=>$question_id
])->find()["opinion"];
$oldRating=$db->query("SELECT * FROM `questions` WHERE `id` = :id",[
    "id"=>$question_id
])->find()["rating"];
if($opinion==NULL){
   switch($_POST["opinion"]){
        case "plus":
            $newRating=$oldRating+1;
            $db->query("UPDATE `questions` SET `rating` = :new_rating WHERE `questions`.`id` = :id",[
                "new_rating"=>$newRating,
                "id"=>$question_id
            ]);
            break;
        case "minus":
            $db->query("UPDATE `questions` SET `rating` = :new_rating WHERE `questions`.`id` = :id",[
                "new_rating"=>$oldRating-1,
                "id"=>$question_id
            ]);
   } 
   $db->query("INSERT INTO `ratingActions` (`id`, `user_id`, `question_id`, `opinion`) VALUES (NULL, :user_id, :question_id, :opinion)",[
    "user_id"=>Session::get("user")["id"],
    "question_id"=>$question_id,
    "opinion"=>$_POST["opinion"]
   ]);
   redirect("/question?id=$question_id");
}

if($_POST["opinion"]==$opinion){
    $db->query("DELETE FROM `ratingActions` WHERE user_id=:user_id AND question_id=:question_id",[
        "user_id"=>Session::get("user")["id"],
        "question_id"=>$question_id        
    ]);
    switch($_POST["opinion"]){
        case "plus":
            $db->query("UPDATE `questions` SET `rating` = :new_rating WHERE `questions`.`id` = :id",[
                "new_rating"=>$oldRating-1,
                "id"=>$question_id
            ]);
            break;
        case "minus":
            $db->query("UPDATE `questions` SET `rating` = :new_rating WHERE `questions`.`id` = :id",[
                "new_rating"=>$oldRating+1,
                "id"=>$question_id
            ]);
    }
    redirect("/question?id=$question_id");
}

switch($_POST["opinion"]){
    case "plus":
        //UPDATE `ratingActions` SET `opinion` = 'minus' WHERE `ratingActions`.`id` = 3;
        $db->query("UPDATE `ratingActions` SET `opinion` = 'plus' WHERE `ratingActions`.`user_id` = :user_id AND `ratingActions`.`question_id` =:question_id",[
            "user_id"=>$auth,
            "question_id"=>$question_id
        ]);
        $db->query("UPDATE `questions` SET `rating` = :new_rating WHERE `questions`.`id` = :id",[
            "new_rating"=>($oldRating+2),
            "id"=>$question_id
        ]);
        break;
    case "minus":
        $db->query("UPDATE `ratingActions` SET `opinion` = 'minus' WHERE `ratingActions`.`user_id` = :user_id AND `ratingActions`.`question_id` =:question_id",[
            "user_id"=>$auth,
            "question_id"=>$question_id
        ]);
        $db->query("UPDATE `questions` SET `rating` = :new_rating WHERE `questions`.`id` = :id",[
            "new_rating"=>($oldRating-2),
            "id"=>$question_id
        ]);
}    

redirect("/question?id=$question_id");