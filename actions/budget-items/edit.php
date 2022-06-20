<?php

$conn = conn();
$db   = new Database($conn);

$data = $db->single('budget_items',[
    'id' => $_GET['id']
]);

if(request() == 'POST')
{
    $db->update('budget_items',$_POST['budget_items'],[
        'id' => $_GET['id']
    ]);

    set_flash_msg(['success'=>'Kegiatan berhasil diupdate']);
    header('location:index.php?r=budget-items/index&budget_id='.$data->budget_id);
}

return [
    'data' => $data
];