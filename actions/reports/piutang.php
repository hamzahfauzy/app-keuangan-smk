<?php

$datas = [];
$conn = conn();
$db   = new Database($conn);

if(
    isset($_GET['from']) && !empty($_GET['from']) &&
    isset($_GET['to']) && !empty($_GET['to'])
)
{

    $db->query = "SELECT 
                    bills.*, 
                    subjects.name as subject_name, 
                    subjects.subject_group as subject_group, 
                    subjects.special_id, 
                    accounts.name as account_name,
                    (SELECT sum(transactions.amount) FROM transactions WHERE transactions.bill_id = bills.id) as total_bayar
                FROM 
                    bills 
                JOIN subjects ON subjects.id = bills.subject_id 
                JOIN accounts ON accounts.id = bills.account_id
                WHERE subjects.subject_group = '$_GET[group]'
                AND bills.created_at BETWEEN
                '$_GET[from] 00:00:00' AND '$_GET[to] 23:59:59'
                ";
    $datas = $db->exec('all');
}

$db->query = "SELECT subject_group FROM subjects GROUP BY subject_group";
$groups = $db->exec('all');

return compact('datas','groups');