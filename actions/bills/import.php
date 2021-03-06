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

        $db->insert('bills',[
            'subject_id' => $checker->id,
            'account_id' => $_POST['account_id'],
            'name' => $data[3], 
            'amount' => $data[4],
            'user_id' => $user->user->id,
            'user_name' => $user->user->username,
        ]);
        $message = 
'Hai '.$checker->name.',
Telah terbit tagihan '.$data[3].' sebesar Rp. ' . number_format($data[4]) .'
Harap segera dibayar ke resepsionis.

Terima kasih.
';
        Whatsapp::send($checker->whatsapp,$message);
    }
    fclose($handle);

    set_flash_msg(['success'=>'Import Tagihan berhasil']);
    header('location:index.php?r=bills/index');
}

$accounts = $db->all('accounts',['transaction_type'=>'Db']);

return compact('accounts');