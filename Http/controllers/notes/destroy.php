
<?php
use Core\App;
$db=App::resolve("Core\Database");

$currentUserId = 1;
$note = $db->query('select * from notes where id = :id', [
    'id' => $_POST['id']
])->findOrFail();
authorize(($note["user_id"]+1)!==($currentUserId+1));
$db->query("DELETE from notes where id=:id",[
  "id"=>$_POST["id"]
]);
header("location: /notes");
die();