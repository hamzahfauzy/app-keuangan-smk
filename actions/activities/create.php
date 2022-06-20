<?php
$conn = conn();
$db   = new Database($conn);

$parents = $db->all('activities');

if(request() == 'POST')
{

    if(empty($_POST['activities']['parent_id'])) unset($_POST['activities']['parent_id']);
    $db->insert('activities',$_POST['activities']);

    set_flash_msg(['success'=>'Kegiatan berhasil ditambahkan']);
    header('location:index.php?r=activities/index');
}

return compact('parents');