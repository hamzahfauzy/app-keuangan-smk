<?php

$conn = conn();
$db   = new Database($conn);

$db->delete('transactions',[
    'id' => $_GET['id']
]);

set_flash_msg(['success'=>'Transaksi berhasil dihapus']);
header('location:index.php?r=transactions/index');
die();