
<?php
use Core\Database;
$config = require base_path('config.php');
$db = new Database($config['database']);
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