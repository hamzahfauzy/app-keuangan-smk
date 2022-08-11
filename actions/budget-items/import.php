<?php
$conn = conn();
$db   = new Database($conn);

if(request() == 'POST')
{

    $handle  = fopen($_FILES['file']['tmp_name'], "r");

    // skip header
    $headers = fgetcsv($handle, 1000, ",");

    $user = auth();

    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) 
    {
        $db->insert('budget_items',[
            'budget_id' => $_GET['budget_id'],
            'name' => $data[1], 
            'description' => $data[2],
            'amount' => $data[3],
        ]);
    }
    fclose($handle);

    set_flash_msg(['success'=>'Import Rincian berhasil']);
    header('location:index.php?r=budget-items/index&budget_id='.$_GET['budget_id']);
}

$accounts = $db->all('accounts',['transaction_type'=>'Db']);

return compact('accounts');