<?php

$conn = conn();
$db   = new Database($conn);

$data = $db->single('accounts',[
    'id' => $_GET['id']
]);

if(request() == 'POST')
{
    $db->update('accounts',$_POST['accounts'],[
        'id' => $_GET['id']
    ]);

    set_flash_msg(['success'=>'Akun berhasil diupdate']);
    header('location:index.php?r=accounts/index');
}

return [
    'data' => $data
];