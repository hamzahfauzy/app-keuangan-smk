<?php

$conn = conn();
$db   = new Database($conn);

$db->delete('years',[
    'id' => $_GET['id']
]);

set_flash_msg(['success'=>'Tahun anggaran berhasil dihapus']);
header('location:index.php?r=years/index');
die();