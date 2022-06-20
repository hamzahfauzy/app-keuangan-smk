<?php

$conn = conn();
$db   = new Database($conn);
$success_msg = get_flash_msg('success');

$budget_id = $_GET['budget_id'];
$budget = $db->single('budgets',[
    'id' => $budget_id
]);

$activity = $db->single('activities',[
    'id' => $budget->activity_id
]);

$data = $db->all('budget_items',['budget_id'=>$budget_id]);

return [
    'datas' => $data,
    'budget' => $budget,
    'activity' => $activity,
    'success_msg' => $success_msg
];