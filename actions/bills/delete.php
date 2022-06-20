<?php

$conn = conn();
$db   = new Database($conn);

$db->delete('bills',[
    'id' => $_GET['id']
]);

set_flash_msg(['success'=>'Tagihan berhasil dihapus']);
header('location:index.php?r=bills/index');
die();