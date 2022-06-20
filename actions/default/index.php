<?php

$conn = conn();
$db   = new Database($conn);


// get lates 10 transactions
$db->query = "SELECT transactions.*, accounts.name as account_name FROM transactions JOIN accounts ON accounts.id = transactions.account_id ORDER BY created_at DESC LIMIT 0, 10";
$transactions = $db->exec('all');

$kas = 0;
$accounts = $db->all('accounts');
foreach($accounts as $account)
{
    $db->query = "SELECT SUM(transactions.amount) as total FROM transactions WHERE account_id = $account->id";
    $transaction = $db->exec('single');
    if($account->transaction_type == 'Db')
        $kas += $transaction->total;

    if($account->transaction_type == 'Cr')
        $kas -= $transaction->total;
}

return compact('transactions','kas');