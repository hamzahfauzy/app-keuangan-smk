<?php

$conn = conn();
$db   = new Database($conn);

$data = $db->single('subjects',[
    'id' => $_GET['id']
]);

if(request() == 'POST')
{
    $db->update('subjects',$_POST['subjects'],[
        'id' => $_GET['id']
    ]);

    set_flash_msg(['success'=>'Subjek berhasil diupdate']);
    header('location:index.php?r=subjects/index');
}

return [
    'data' => $data
];