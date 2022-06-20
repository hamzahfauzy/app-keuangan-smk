<?php

$conn = conn();
$db   = new Database($conn);

if(in_array($_GET['id'],[1,2]))
{
    set_flash_msg(['fail'=>'Akun ini tidak boleh dihapus']);
    header('location:index.php?r=accounts/index');
    die();
}

$db->delete('accounts',[
    'id' => $_GET['id']
]);

set_flash_msg(['success'=>'Akun berhasil dihapus']);
header('location:index.php?r=accounts/index');
die();