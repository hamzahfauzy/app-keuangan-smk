<?php

$conn = conn();
$db   = new Database($conn);
$success_msg = get_flash_msg('success');

$where = [
    'subject_type' => $_GET['jenis']
];

if(isset($_GET['keyword']))
{
    $where['name'] = [
        'LIKE',
        '%'.$_GET['keyword'].'%\' OR special_id LIKE \'%'.$_GET['keyword'].'%'
    ];
};

$data = $db->all('subjects',$where,[
    'id' => 'DESC'
]);

echo json_encode($data);
die();