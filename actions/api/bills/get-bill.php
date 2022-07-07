<?php

$conn = conn();
$db   = new Database($conn);
$success_msg = get_flash_msg('success');

$_subject   = explode(' - ', $_GET['subject']);
$special_id = $_subject[0];

$db->query = "SELECT 
                bills.*, 
                subjects.name as subject_name, 
                subjects.special_id, 
                accounts.name as account_name,
                accounts.code as account_code,
                (SELECT sum(transactions.amount) FROM transactions WHERE transactions.bill_id = bills.id) as total_bayar
            FROM 
                bills 
            JOIN subjects ON subjects.id = bills.subject_id 
            JOIN accounts ON accounts.id = bills.account_id
            WHERE subjects.special_id = '$special_id' AND ((SELECT sum(transactions.amount) FROM transactions WHERE transactions.bill_id = bills.id) < bills.amount OR (SELECT sum(transactions.amount) FROM transactions WHERE transactions.bill_id = bills.id) is NULL)
            ";
$data = $db->exec('all');

$data = array_map(function($d){
    $d->amount_format = number_format($d->amount);
    return $d;
}, $data);

echo json_encode($data);
die();