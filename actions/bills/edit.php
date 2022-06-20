<?php

$conn = conn();
$db   = new Database($conn);

$data = $db->single('bills',[
    'id' => $_GET['id']
]);

if(request() == 'POST')
{
    $db->update('bills',$_POST['bills'],[
        'id' => $_GET['id']
    ]);

    set_flash_msg(['success'=>'Tagihan berhasil diupdate']);
    header('location:index.php?r=bills/index');
}

return [
    'data' => $data
];