<?php

$conn = conn();
$db   = new Database($conn);

$data = $db->single('subjects',[
    'id' => $_GET['id']
]);

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
            WHERE bills.subject_id = $_GET[id]
            ";
$bills = $db->exec('all');

$db->query = "SELECT sum(amount) as total FROM bills WHERE subject_id = $_GET[id]";
$total_tagihan = $db->exec('single');

$db->query = "SELECT 
                bills.*, 
                (SELECT sum(transactions.amount) FROM transactions WHERE transactions.bill_id = bills.id) as total_bayar
            FROM 
                bills 
            WHERE bills.subject_id = $_GET[id]
            ";

$pembayaran = $db->exec('all');
$total_pembayaran = 0;
foreach($pembayaran as $row)
    $total_pembayaran += $row->total_bayar;

return [
    'data' => $data,
    'bills' => $bills,
    'total_tagihan' => $total_tagihan->total - $total_pembayaran
];