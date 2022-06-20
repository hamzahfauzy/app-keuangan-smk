<?php load_templates('layouts/top') ?>
    <div class="content">
        <div class="panel-header bg-success-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Detail Subjek : <?=$data->name?> (Total Tagihan : Rp. <?=number_format($total_tagihan)?>)</h2>
                        <h5 class="text-white op-7 mb-2">Memanajemen data subjek transaksi</h5>
                    </div>
                    <div class="ml-md-auto py-2 py-md-0">
                        <a href="index.php?r=subjects/index" class="btn btn-warning btn-round">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            <div class="row row-card-no-pd">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive table-hover table-sales">
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th width="20px">#</th>
                                            <th>Tagihan</th>
                                            <th>Jumlah</th>
                                            <th class="text-right">
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($bills as $index => $bill): ?>
                                        <tr>
                                            <td>
                                                <?=$index+1?>
                                            </td>
                                            <td>
                                                <?=$bill->name?><br>
                                                <small><i>Akun : <?=$bill->account_name?></i></small>
                                            </td>
                                            <td>
                                                <?=number_format($bill->amount)?><br>
                                                <?php if($bill->total_bayar): ?>
                                                <small><i>(<?=$bill->amount<=$bill->total_bayar==0?'Lunas':number_format($bill->amount-$bill->total_bayar)?>)</i></small>
                                                <?php endif ?>
                                            </td>
                                            <td>
                                                <?php if($bill->amount > $bill->total_bayar): ?>
                                                <a href="index.php?r=bills/pay&id=<?=$bill->id?>" class="btn btn-sm btn-success"><i class="fas fa-money-bill"></i> Bayar</a>
                                                <a href="index.php?r=bills/delete&id=<?=$bill->id?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Hapus</a>
                                                <?php endif ?>
                                            </td>
                                        </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php load_templates('layouts/bottom') ?>