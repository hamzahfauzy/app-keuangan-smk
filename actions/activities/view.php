<?php

$conn = conn();
$db   = new Database($conn);

$data = $db->all('activities');
$data = json_decode(json_encode($data),1);

$data = array_map(function($d){
    $d['id'] = (int) $d['id'];
    $d['parent'] = (int) $d['parent_id'];
    // $d['title']  = $d['name'];
    return $d;
}, $data);

// echo json_encode($data);
// die();

$tree = new BlueM\Tree($data);

echo json_encode($tree->getRootNodes());
die();
return compact('data');