<?php

$conn = conn();
$db   = new Database($conn);

$data = $db->single('sources',[
    'id' => $_GET['id']
]);

if(request() == 'POST')
{
    $db->update('sources',$_POST['sources'],[
        'id' => $_GET['id']
    ]);

    set_flash_msg(['success'=>'Sumber dana berhasil diupdate']);
    header('location:index.php?r=sources/index');
}

return [
    'data' => $data
];