<?php

$conn = conn();
$db   = new Database($conn);

$db->delete('activities',[
    'id' => $_GET['id']
]);

set_flash_msg(['success'=>'Kegiatan berhasil dihapus']);
header('location:index.php?r=activities/index');
die();