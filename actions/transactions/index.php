<?php

$conn = conn();
$db   = new Database($conn);
$success_msg = get_flash_msg('success');

$query = "SELECT 
            transactions.*, accounts.name as account_name,
            (SELECT CONCAT(subjects.name,' - ',subjects.special_id) FROM subjects WHERE subjects.id = transactions.subject_id) as subject_name
          FROM 
            transactions 
          JOIN accounts ON accounts.id = transactions.account_id";
$db->query = $query;
$data = $db->exec('all');

return [
    'datas' => $data,
    'success_msg' => $success_msg
];