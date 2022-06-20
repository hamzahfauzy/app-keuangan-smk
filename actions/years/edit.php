<?php

$conn = conn();
$db   = new Database($conn);

$data = $db->single('years',[
    'id' => $_GET['id']
]);

if(request() == 'POST')
{
    $db->update('years',$_POST['years'],[
        'id' => $_GET['id']
    ]);

    set_flash_msg(['success'=>'Tahun anggaran berhasil diupdate']);
    header('location:index.php?r=years/index');
}

return [
    'data' => $data
];