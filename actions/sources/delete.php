<?php

$conn = conn();
$db   = new Database($conn);

$db->delete('sources',[
    'id' => $_GET['id']
]);

set_flash_msg(['success'=>'Sumber dana berhasil dihapus']);
header('location:index.php?r=sources/index');
die();