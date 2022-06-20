<?php

$conn = conn();
$db   = new Database($conn);

$parents = $db->all('activities');

$data = $db->single('activities',[
    'id' => $_GET['id']
]);

if(request() == 'POST')
{
    if(empty($_POST['activities']['parent_id'])) $_POST['activities']['parent_id'] = 0;
    $db->update('activities',$_POST['activities'],[
        'id' => $_GET['id']
    ]);

    set_flash_msg(['success'=>'Kegiatan berhasil diupdate']);
    header('location:index.php?r=activities/index');
}

return [
    'data' => $data,
    'parents' => $parents
];