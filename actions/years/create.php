<?php

if(request() == 'POST')
{
    $conn = conn();
    $db   = new Database($conn);

    $db->insert('years',$_POST['years']);

    set_flash_msg(['success'=>'Tahun anggaran berhasil ditambahkan']);
    header('location:index.php?r=years/index');
}