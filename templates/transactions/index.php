<?php if(!isset($_GET['cetak'])): ?>
<?php load_templates('layouts/top') ?>
    <div class="content">
        <div class="<?=config('theme')['panel_color']?>">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Transaksi</h2>
                        <h5 class="text-white op-7 mb-2">Memanajemen data transaksi</h5>
                    </div>
                    <div class="ml-md-auto py-2 py-md-0">
                        <?php if(isset($_GET['invoice_code'])): ?>
                            <a href="index.php?r=transactions/index" class="btn btn-warning btn-round">Kembali</a>
                            <a href="index.php?r=transactions/index&invoice_code=<?=$_GET['invoice_code']?>&cetak" target="_blank" class="btn btn-warning btn-round">Cetak</a>
                        <?php endif ?>
                        <a href="index.php?r=transactions/import" class="btn btn-primary btn-round">Import Transaksi</a>
                        <a href="index.php?r=transactions/create&invoice_code=<?=isset($_GET['invoice_code'])?$_GET['invoice_code']:''?>" class="<?=config('theme')['button_main_color']?> btn-round">Buat Transaksi</a>
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
                            <?php else: ?>
                            <script>window.print()</script>
                            <h2 align="center">Kwitansi Pembayaran</h2>
                            <table border="1" cellpadding="5" cellspacing="0" width="100%">
                            <?php endif ?>
                                    <thead>
                                        <tr>
                                            <th width="20px">#</th>
                                            <th>Invoice</th>
                                            <th>Transaksi</th>
                                            <th>Deskripsi</th>
                                            <th>Jumlah</th>
                                            <th>Tanggal</th>
                                            <?php if(!isset($_GET['cetak'])): ?>
                                            <th class="text-right">
                                            </th>
                                            <?php endif ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $total = 0; foreach($datas as $index => $data): $total += $data->amount; ?>
                                        <tr>
                                            <td>
                                                <?=$index+1?>
                                            </td>
                                            <td><a href="index.php?r=transactions/index&invoice_code=<?=$data->invoice_code?>"><?=$data->invoice_code?></a></td>
                                            <td>
                                                <?=$data->account_name?>
                                                <?php if($data->subject_name): ?>
                                                <br><small><i><?=$data->subject_name?></i></small>
                                                <?php endif ?>
                                            </td>
                                            <td><?=$data->description?></td>
                                            <td><?=number_format($data->amount)?></td>
                                            <td><?=date('Y-m-d',strtotime($data->created_at))?></td>
                                            <?php if(!isset($_GET['cetak'])): ?>
                                            <td>
                                                <a href="index.php?r=transactions/edit&id=<?=$data->id?>" class="btn btn-sm btn-warning"><i class="fas fa-pencil-alt"></i> Edit</a>
                                                <a href="index.php?r=transactions/delete&id=<?=$data->id?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Hapus</a>
                                            </td>
                                            <?php endif ?>
                                        </tr>
                                        <?php endforeach ?>
                                        <?php if(isset($_GET['invoice_code'])): ?>
                                        <tr>
                                            <td colspan="<?=isset($_GET['cetak']) ? 6 : 7?>"><b>TOTAL : </b><?=number_format($total)?></td>
                                        </tr>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                                <?php if(!isset($_GET['cetak'])): ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php load_templates('layouts/bottom') ?>
<?php endif ?>