<?php

$conn = conn();
$db   = new Database($conn);

$data = $db->single('transactions',[
    'id' => $_GET['id']
]);

$data->account = $db->single('accounts',[
    'id' => $data->account_id
]);

$data->subject = $db->single('subjects',[
    'id' => $data->subject_id
]);

if(request() == 'POST')
{
    $_subject   = explode(' - ', $_POST['transactions']['subject']);
    $special_id = $_subject[0];

    $subject_checker = $db->single('subjects',[
        'special_id' => $special_id
    ]);

    if($subject_checker)
    {
        $_POST['transactions']['subject_id'] = $subject_checker->id;
    }

    unset($_POST['transactions']['subject']);
    
    $db->update('transactions',$_POST['transactions'],[
        'id' => $_GET['id']
    ]);

    set_flash_msg(['success'=>'Transaksi berhasil diupdate']);
    header('location:index.php?r=transactions/index');
}

return [
    'data' => $data
];