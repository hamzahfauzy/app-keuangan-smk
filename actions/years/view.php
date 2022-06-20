<?php

$conn = conn();
$db   = new Database($conn);

$data = $db->single('years',[
    'id' => $_GET['id']
]);

return compact('data');