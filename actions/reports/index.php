<?php

$transactions = [];

if(
    isset($_GET['from']) && !empty($_GET['from']) &&
    isset($_GET['to']) && !empty($_GET['to'])
)
{
    $conn = conn();
    $db   = new Database($conn);
    $db->query = "SELECT transactions.*, accounts.code, accounts.name as account_name, accounts.transaction_type as transaction_type FROM transactions JOIN accounts ON accounts.id = transactions.account_id WHERE created_at BETWEEN '$_GET[from] 00:00:00' AND '$_GET[to] 23:59:59'";
    $transactions = $db->exec('all');
}

return compact('transactions');