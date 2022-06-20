<?php

$tree = [];
$sources = [];
$year = "";

if(
    isset($_GET['from']) && !empty($_GET['from']) &&
    isset($_GET['to']) && !empty($_GET['to'])
)
{
    $conn = conn();
    $db   = new Database($conn);
    
    $year = $_GET['year'];
    $year = $db->single('years',['name'=>$year]);
    $activities = $db->all('activities');
    $activities = json_decode(json_encode($activities),1);

    $activities = array_map(function($d){
        $d['id'] = (int) $d['id'];
        $d['parent'] = (int) $d['parent_id'];
        return $d;
    }, $activities);

    $tree = new BlueM\Tree($activities);

    $sources = $db->all('sources',[],['priority'=>'ASC']);

    
}

return compact('tree','sources','year');
