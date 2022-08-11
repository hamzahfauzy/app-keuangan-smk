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
        if(!empty($checker)) continue;
        $db->insert('subjects',[
            'special_id' => $data[1],
            'name' => $data[2],
            'description' => 'Subjek '.$data[2], 
            'subject_type' => $data[3],
            'subject_group' => $data[4],
            'whatsapp' => $data[5]
        ]);
    }
    fclose($handle);

    set_flash_msg(['success'=>'Import Subjek berhasil']);
    header('location:index.php?r=subjects/index');
    die();
}