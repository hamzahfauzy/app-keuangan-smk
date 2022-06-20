<?php
$conn = conn();
$db   = new Database($conn);

$parents = $db->all('budget_items');

if(request() == 'POST')
{

    $_POST['budget_items']['budget_id'] = $_GET['budget_id'];
    $db->insert('budget_items',$_POST['budget_items']);

    set_flash_msg(['success'=>'Item berhasil ditambahkan']);
    header('location:index.php?r=budget-items/index&budget_id='.$_GET['budget_id']);
}

return compact('parents');