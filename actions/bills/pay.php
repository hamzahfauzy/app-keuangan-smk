<?php

$conn = conn();
$db   = new Database($conn);

$db->query = "SELECT 
                bills.*, subjects.name as subject_name, subjects.whatsapp,
                (SELECT sum(transactions.amount) FROM transactions WHERE transactions.bill_id = bills.id) as total_bayar
              FROM 
                bills 
              JOIN subjects ON subjects.id = bills.subject_id 
              WHERE bills.id = $_GET[id]";
$data = $db->exec('single');

$max_jumlah = $data->total_bayar ? $data->amount-$data->total_bayar : $data->amount;
$data->max_jumlah = $max_jumlah;

if(request() == 'POST')
{
    $db->insert('transactions',[
        'account_id' => $data->account_id,
        'subject_id' => $data->subject_id,
        'bill_id'    => $data->id,
        'user_id'    => auth()->user->id,
        'user_name'  => auth()->user->username,
        'description'=> 'Pembayaran tagihan '.$data->name,
        'amount'     => $_POST['amount'],
    ]);

    $message = 
'Hai '.$data->subject_name.',
Pembayaran tagihan '.$data->name.' sebesar Rp. '.(number_format($_POST['amount'])).' telah diterima.

Terima Kasih.';

    Whatsapp::send($data->whatsapp,$message);

    set_flash_msg(['success'=>'Tagihan berhasil dibayar']);
    header('location:index.php?r=bills/index');
}

return [
    'data' => $data
];