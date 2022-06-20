<?php

$conn = conn();
$db   = new Database($conn);
$success_msg = get_flash_msg('success');

$db->query = "SELECT 
                bills.*, 
                subjects.name as subject_name, 
                subjects.special_id, 
                accounts.name as account_name,
                (SELECT sum(transactions.amount) FROM transactions WHERE transactions.bill_id = bills.id) as total_bayar
            FROM 
                bills 
            JOIN subjects ON subjects.id = bills.subject_id 
            JOIN accounts ON accounts.id = bills.account_id
            ";
$data = $db->exec('all');

return [
    'datas' => $data,
    'success_msg' => $success_msg
];