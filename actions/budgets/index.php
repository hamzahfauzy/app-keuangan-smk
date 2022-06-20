<?php

$conn = conn();
$db   = new Database($conn);
$success_msg = get_flash_msg('success');

if(request() == 'POST')
{
    foreach($_POST['budgets'] as $activity => $sources)
    {
        // check budget
        $budget = $db->single('budgets',[
            'year_id' => $_GET['id'],
            'activity_id' => $activity
        ]);
        if(empty($budget))
        {
            $budget = $db->insert('budgets',[
                'year_id' => $_GET['id'],
                'activity_id' => $activity
            ]);
        }
        foreach($sources as $source => $amount)
        {
            $budget_source = $db->single('budget_sources',[
                'budget_id' => $budget->id,
                'source_id' => $source
            ]);
            if($budget_source)
            {
                $db->update('budget_sources',[
                    'amount' => $amount==""?0:$amount,
                ],[
                    'budget_id' => $budget->id,
                    'source_id' => $source
                ]);
            }
            else
            {
                $db->insert('budget_sources',[
                    'budget_id' => $budget->id,
                    'source_id' => $source,
                    'amount' => $amount==""?0:$amount,
                ]);
            }
        }
    }

    set_flash_msg(['success'=>'Anggaran berhasil disimpan']);
    header('location:index.php?r=budgets/index&id='.$_GET['id']);
    die();
}

$activities = $db->all('activities');
$activities = json_decode(json_encode($activities),1);

$activities = array_map(function($d){
    $d['id'] = (int) $d['id'];
    $d['parent'] = (int) $d['parent_id'];
    return $d;
}, $activities);

$tree = new BlueM\Tree($activities);

$sources = $db->all('sources',[],['priority'=>'ASC']);

return compact('tree','sources','success_msg');