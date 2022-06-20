<?php

if(request() == 'POST')
{
    $conn = conn();
    $db   = new Database($conn);

    $db->insert('bills',$_POST['bills']);

    set_flash_msg(['success'=>'Tagihan berhasil ditambahkan']);
    header('location:index.php?r=bills/index');
}