<?php

$conn = conn();
$db   = new Database($conn);

$db->query = "SELECT subject_type FROM subjects GROUP BY subject_type";
$data = $db->exec('all');

echo json_encode($data);
die();