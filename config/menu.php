<?php

return [
    'dashboard' => 'default/index',
    'master'    => [
        'sumber dana' => 'sources/index',
        'kegiatan'    => 'activities/index',
        'akun'        => 'accounts/index',
        'subjek'      => 'subjects/index'
    ],
    'anggaran'  => 'years/index',
    'tagihan'   => 'bills/index',
    'transaksi' => 'transactions/index',
    'laporan'   => [
        'laporan transaksi'=>'reports/index',
        'laporan anggaran'=>'reports/budget',
        'laporan piutang'=>'reports/piutang'
    ],
    'roles'     => 'roles/index',
];