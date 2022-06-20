<?php

if(request() == 'POST')
{
    $conn = conn();
    $db   = new Database($conn);

    $db->insert('sources',$_POST['sources']);

    set_flash_msg(['success'=>'Sumber dana berhasil ditambahkan']);
    header('location:index.php?r=sources/index');
}