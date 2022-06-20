<?php

$conn = conn();
$db   = new Database($conn);

$data = $db->single('sources',[
    'id' => $_GET['id']
]);

return compact('data');