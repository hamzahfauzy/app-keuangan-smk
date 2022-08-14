<?php

// check if file exists
$parent_path = '';
if (!in_array(php_sapi_name(),["cli","cgi-fcgi"])) {
    $parent_path = 'public/';
}

if(file_exists($parent_path . 'lock.txt'))
{
    die();
}

file_put_contents($parent_path . 'lock.txt', strtotime('now'));

$conn = conn();
$db   = new Database($conn);

$jobs = $db->all('messages',[
    'status' => 'queued'
]);

if(!empty($jobs) && count($jobs))
{
    foreach($jobs as $job)
    {
        $response = Whatsapp::sent($job->message_to,$job->message_content);
        $db->update('messages',[
            'status' => 'executed',
            'message_response' => $response,
        ],[
            'id' => $job->id
        ]);
    }
}

unlink($parent_path . 'lock.txt');