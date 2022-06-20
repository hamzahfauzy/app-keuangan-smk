<?php

$conn = conn();
$db   = new Database($conn);

if(request() == 'POST')
{

    $subject = '';
    $bill    = '';

    if(!empty($_POST['transactions']['subject']))
    {
        // check subject is exists
        // get subject special id
        // subject format {special_id} - {subject_name} ({subject_type})
        $_subject   = explode(' - ', $_POST['transactions']['subject']);
        $special_id = $_subject[0];

        $subject_checker = $db->single('subjects',[
            'special_id' => $special_id
        ]);

        if($subject_checker)
        {
            $_POST['transactions']['subject_id'] = $subject_checker->id;

            if(!empty($_POST['transactions']['bill']))
            {
        
                // check bill is exists
                // get bill id
                // bill format {bill_id} - {bill_name} ({bill_amount})
                $_bill   = explode(' - ', $_POST['transactions']['bill']);
                $bill_id = $_bill[0];
        
                $bill_checker = $db->single('bills',[
                    'id' => $bill_id,
                    'subject_id' => $subject_checker->id,
                    'account_id' => $_POST['transactions']['account_id'],
                ]);
        
                if($bill_checker) $_POST['transactions']['bill_id'] = $bill_id;
        
            }
        }
    }

    unset($_POST['transactions']['subject']);
    unset($_POST['transactions']['bill']);

    $db->insert('transactions',$_POST['transactions']);

    set_flash_msg(['success'=>'Transaksi berhasil ditambahkan']);
    header('location:index.php?r=transactions/index');
}

$accounts = $db->all('accounts');

return compact('accounts');