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
        // check nim
        $checker = $db->single('subjects',[
            'special_id' => $data[1]
        ]);

        // skip if subject not exists
        if(!$checker || empty($checker)) continue;
        $invoice_code = 'INV-'.strtoupper(strtotime('now').rand(0,100));
        $db->insert('transactions',[
            'subject_id' => $checker->id,
            'account_id' => $_POST['account_id'],
            'description' => $data[3], 
            'amount' => $data[4],
            'user_id' => $user->user->id,
            'user_name' => $user->user->username,
            'invoice_code' => $invoice_code,
            'created_at' => $data[5],
        ]);
    }
    fclose($handle);

    set_flash_msg(['success'=>'Import Transaksi berhasil']);
    header('location:index.php?r=transactions/index');
}

$accounts = $db->all('accounts',['transaction_type'=>'Cr']);

return compact('accounts');