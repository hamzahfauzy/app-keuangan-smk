<?php

if(request() == 'POST')
{
    $conn = conn();
    $db   = new Database($conn);

    $db->insert('subjects',$_POST['subjects']);

    set_flash_msg(['success'=>'Subjek berhasil ditambahkan']);
    header('location:index.php?r=subjects/index');
}