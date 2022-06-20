<?php if(!isset($_GET['cetak'])): ?>
<?php load_templates('layouts/top') ?>
    <div class="content">
        <div class="panel-header bg-success-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Laporan Piutang</h2>
                        <h5 class="text-white op-7 mb-2">Laporan piutang</h5>
                    </div>
                    <div class="ml-md-auto py-2 py-md-0">
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="">
                            <input type="hidden" name="r" value="reports/index">
                            <div class="form-group">
                                <label for="">Filter</label>
                                <div class="d-flex">
                                    <input type="date" name="from" class="form-control" value="<?=@$_GET['from']?>">
                                    &nbsp;
                                    <input type="date" name="to" class="form-control" value="<?=@$_GET['to']?>">
                                    &nbsp;
                                    <button name="tampil" class="btn btn-success">Tampilkan</button>
                                    &nbsp;
                                    <button name="cetak" class="btn btn-primary">Cetak</button>
                                </div>
                            </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table">
                                <?php else: ?>
                                <script>window.print()</script>
                                <h1 align="center" style="margin:0;padding:0">LAPORAN KEUANGAN</h1>
                                <p align="center"><?=$_GET['from']?> - <?=$_GET['to']?></p>
                                <table border="1" cellpadding="5" cellspacing="0" width="100%">
                                <?php endif ?>
                                <thead>
                                        <tr>
                                            <th width="20px">#</th>
                                            <th>Subjek</th>
                                            <th>Tagihan</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1; foreach($datas as $index => $data): if($data->total_bayar) continue; ?>
                                        <tr>
                                            <td>
                                                <?=$no++?>
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
                                                <?=number_format($data->amount)?>
                                            </td>
                                        </tr>
                                        <?php endforeach ?>
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