<?php

$conn = conn();
$db   = new Database($conn);
$success_msg = get_flash_msg('success');

$data = $db->all('activities');
$data = array_map(function($d) use ($db){
    if($d->parent_id)
    {
        $d->parent = $db->single('activities',[
            'id' => $d->parent_id
        ]);
    }
    return $d;
}, $data);

return [
    'datas' => $data,
    'success_msg' => $success_msg
];