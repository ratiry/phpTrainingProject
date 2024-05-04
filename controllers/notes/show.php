<?php
use Core\App;
$db=App::resolve("Core\Database");

$currentUserId = 1;

$note = $db->query('select * from notes where id = :id', [
    'id' => $_GET['id']
])->findOrFail();
authorize(($note["user_id"]+1)!==($currentUserId+1));

view("notes/show.view.php", [
    'heading' => 'Note',
    'note' => $note
]);