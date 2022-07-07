<?php load_templates('layouts/top') ?>
    <div class="content">
        <div class="panel-header bg-success-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Transaksi</h2>
                        <h5 class="text-white op-7 mb-2">Memanajemen data transaksi</h5>
                    </div>
                    <div class="ml-md-auto py-2 py-md-0">
                        <a href="index.php?r=transactions/import" class="btn btn-primary btn-round">Import Transaksi</a>
                        <a href="index.php?r=transactions/create" class="btn btn-success btn-round">Buat Transaksi</a>
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
                                            <th>Invoice</th>
                                            <th>Transaksi</th>
                                            <th>Deskripsi</th>
                                            <th>Jumlah</th>
                                            <th>Tanggal</th>
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
                                            <td><?=$data->invoice_code?></td>
                                            <td>
                                                <?=$data->account_name?>
                                                <?php if($data->subject_name): ?>
                                                <br><small><i><?=$data->subject_name?></i></small>
                                                <?php endif ?>
                                            </td>
                                            <td><?=$data->description?></td>
                                            <td><?=number_format($data->amount)?></td>
                                            <td><?=$data->created_at?></td>
                                            <td>
                                                <a href="index.php?r=transactions/edit&id=<?=$data->id?>" class="btn btn-sm btn-warning"><i class="fas fa-pencil-alt"></i> Edit</a>
                                                <a href="index.php?r=transactions/delete&id=<?=$data->id?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Hapus</a>
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