<?php load_templates('layouts/top') ?>
    <div class="content">
        <div class="<?=config('theme')['panel_color']?>">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Tagihan</h2>
                        <h5 class="text-white op-7 mb-2">Memanajemen data tagihan mahasiswa</h5>
                    </div>
                    <div class="ml-md-auto py-2 py-md-0">
                        <a href="index.php?r=bills/import" class="btn btn-primary btn-round">Import Tagihan</a>
                        <!-- <a href="index.php?r=bills/create" class="<?=config('theme')['button_main_color']?> btn-round">Buat Tagihan</a> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            <div class="row row-card-no-pd">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <?php if($success_msg): ?>
                            <div class="alert alert-success"><?=$success_msg?></div>
                            <?php endif ?>
                            <div class="table-responsive table-hover table-sales">
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th width="20px">#</th>
                                            <th>Subjek</th>
                                            <th>Tagihan</th>
                                            <th>Jumlah</th>
                                            <th class="text-right">
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($datas as $index => $data): ?>
                                        <tr>
                                            <td>
                                                <?=$index+1?>
                                            </td>
                                            <td>
                                                <?=$data->subject_name?><br>
                                                <small><i>NIM : <?=$data->special_id?></i></small>
                                            </td>
                                            <td>
                                                <?=$data->name?><br>
                                                <small><i>Akun : <?=$data->account_name?></i></small>
                                            </td>
                                            <td>
                                                <?=number_format($data->amount)?><br>
                                                <?php if($data->total_bayar): ?>
                                                <small><i>(<?=$data->amount-$data->total_bayar==0?'Lunas':number_format($data->amount-$data->total_bayar)?>)</i></small>
                                                <?php endif ?>
                                            </td>
                                            <td>
                                                <?php if($data->amount > $data->total_bayar): ?>
                                                <a href="index.php?r=bills/pay&id=<?=$data->id?>" class="btn btn-sm btn-success"><i class="fas fa-money-bill"></i> Bayar</a>
                                                <a href="index.php?r=bills/delete&id=<?=$data->id?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Hapus</a>
                                                <?php endif ?>
                                                <!-- <a href="index.php?r=bills/edit&id=<?=$data->id?>" class="btn btn-sm btn-warning"><i class="fas fa-pencil-alt"></i> Edit</a> -->
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