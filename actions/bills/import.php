<?php

if(request() == 'POST')
{
    $conn = conn();
    $db   = new Database($conn);

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

        $db->insert('bills',[
            'subject_id' => $checker->id,
            'account_id' => 1, // uang kuliah
            'name' => $data[3], 
            'amount' => $data[4],
            'user_id' => $user->id,
            'user_name' => $user->username,
        ]);
    }
    fclose($handle);

    set_flash_msg(['success'=>'Import Tagihan berhasil']);
    header('location:index.php?r=bills/index');
}