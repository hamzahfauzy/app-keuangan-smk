<?php

if(request() == 'POST')
{
    $conn = conn();
    $db   = new Database($conn);

    $db->insert('accounts',$_POST['accounts']);

    set_flash_msg(['success'=>'Akun berhasil ditambahkan']);
    header('location:index.php?r=accounts/index');
}