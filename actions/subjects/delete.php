<?php

$conn = conn();
$db   = new Database($conn);

$db->delete('subjects',[
    'id' => $_GET['id']
]);

set_flash_msg(['success'=>'Subjek berhasil dihapus']);
header('location:index.php?r=subjects/index');
die();