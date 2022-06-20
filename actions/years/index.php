<?php

$conn = conn();
$db   = new Database($conn);
$success_msg = get_flash_msg('success');

$data = $db->all('years');

$activities = $db->all('activities');
$activities = json_decode(json_encode($activities),1);

$activities = array_map(function($d){
    $d['id'] = (int) $d['id'];
    $d['parent'] = (int) $d['parent_id'];
    return $d;
}, $activities);

$tree = new BlueM\Tree($activities);

return [
    'tree'  => $tree,
    'datas' => $data,
    'success_msg' => $success_msg
];