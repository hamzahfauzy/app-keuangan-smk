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
    if(empty($year))
    {
        $response = [
            'status' => 'fail',
            'message' => 'Tahun tidak ditemukan',
            'data' => []
        ];
    }
    $activities = $db->all('activities');
    if(empty($activities))
    {
        $response = [
            'status' => 'fail',
            'message' => 'Kegiatan tidak ditemukan',
            'data' => []
        ];
    }

    else
    {
        $activities = json_decode(json_encode($activities),1);
    
        $activities = array_map(function($d){
            $d['id'] = (int) $d['id'];
            $d['parent'] = (int) $d['parent_id'];
            return $d;
        }, $activities);
    
        $tree = new BlueM\Tree($activities);
    
        $sources = $db->all('sources',[],['priority'=>'ASC']);
    
        $table_head = '<thead>
        <tr>
            <th class="text-center" rowspan="2">Kode</th>
            <th class="text-center" rowspan="2">Kegiatan/Sub Kegiatan</th>
            <th class="text-center" colspan="'.count($sources).'">Anggaran</th>
            <th class="text-center" rowspan="2">Total</th>
            <th class="text-center" rowspan="2">Penggunaan</th>
            <th class="text-center" rowspan="2">Sisa</th>
        </tr>
        <tr>';
            foreach($sources as $source):
            $table_head .= '<th class="text-center">'.$source->name.'</th>';
            endforeach;
        $table_head .= '</tr>
    </thead>';
    
        $rows = render_tree_on_row_detail($tree, $sources, $year->id, true);
    
        $response = [
            'status' => 'success',
            'message' => 'report retrieved',
            'data' => [
                'head' => $table_head,
                'rows' => $rows
            ]
        ];
    }

    echo json_encode($response);
    die();
    
}

return compact('tree','sources','year');
