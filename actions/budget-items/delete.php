<?php

$conn = conn();
$db   = new Database($conn);

$budget = $db->single('budget_items',[
    'id' => $_GET['id']
]);

$db->delete('budget_items',[
    'id' => $_GET['id']
]);

set_flash_msg(['success'=>'Item berhasil dihapus']);
header('location:index.php?r=budget-items/index&budget_id='.$budget->budget_id);
die();