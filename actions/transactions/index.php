<?php

$conn = conn();
$db   = new Database($conn);
$success_msg = get_flash_msg('success');
$where = "";
if(isset($_GET['invoice_code']) && !empty($_GET['invoice_code']))
  $where = " WHERE transactions.invoice_code = '$_GET[invoice_code]' ";
$query = "SELECT 
            transactions.*, accounts.name as account_name,
            (SELECT CONCAT(subjects.name,' - ',subjects.special_id) FROM subjects WHERE subjects.id = transactions.subject_id) as subject_name
          FROM 
            transactions 
          JOIN accounts ON accounts.id = transactions.account_id
          $where
          ORDER BY transactions.invoice_code DESC";
$db->query = $query;
$data = $db->exec('all');

return [
    'datas' => $data,
    'success_msg' => $success_msg
];