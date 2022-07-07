<?php

$conn = conn();
$db   = new Database($conn);
$success_msg = get_flash_msg('success');


$db->query = "SELECT * FROM subjects WHERE subject_type='$_GET[jenis]'";
if(isset($_GET['keyword']))
{
    $db->query .= " AND (name LIKE '%$_GET[keyword]%' OR special_id LIKE '%$_GET[keyword]%')";
}
$db->query .= " ORDER BY id DESC";
$data = $db->exec('all');

echo json_encode($data);
die();