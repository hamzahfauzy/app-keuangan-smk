<?php

$conn = conn();
$db   = new Database($conn);
$success_msg = get_flash_msg('success');
$fail_msg = get_flash_msg('fail');

$data = $db->all('accounts');

return [
    'datas' => $data,
    'success_msg' => $success_msg,
    'fail_msg' => $fail_msg,
];