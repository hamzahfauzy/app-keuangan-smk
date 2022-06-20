<?php

$conn = conn();
$db   = new Database($conn);

if(request() == 'POST')
{
    $jenis = $_POST['jenis'];

    $keyword = $_POST['keyword'];
    if($keyword)
    {
        if($jenis == 'mahasiswa')
            $keyword = '?NIM='.$keyword;
        else if($jenis == 'dosen')
            $keyword = '?NIDN='.$keyword;
        else $keyword = '';
    }

    $request = simple_curl('https://api.stikes-assyifa.ac.id/site/get-'.$jenis.$keyword);
    $response = json_decode($request['content'])->data;

    foreach($response as $data)
    {
        // check if data exists
        $checker = $db->single('subjects',[
            'special_id' => $jenis == 'mahasiswa' ? $data->NIM : $data->NIDN
        ]);
        if($checker) continue;

        $db->insert('subjects',[
            'special_id' => $jenis == 'mahasiswa' ? $data->NIM : $data->NIDN,
            'name'       => $data->nama,
            'description'  => $jenis == 'mahasiswa' ? 'Prodi : ' . $data->prodi->nama . '\n' . 'Kelas : ' . $data->kelas->nama : $jenis,
            'subject_type' => $jenis,
        ]);  
    }

    set_flash_msg(['success'=>'Subjek berhasil di import']);
    // header('location:index.php?r=subjects/index');
    // die();
}

// set_flash_msg(['success'=>'Subjek berhasil di import']);
header('location:index.php?r=subjects/index');
die();