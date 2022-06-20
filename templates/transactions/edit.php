<?php load_templates('layouts/top') ?>
<?php load_templates('transactions/modal') ?>
    <div class="content">
        <div class="panel-header bg-success-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Edit Transaksi : <?=$data->description?></h2>
                        <h5 class="text-white op-7 mb-2">Memanajemen data transaksi</h5>
                    </div>
                    <div class="ml-md-auto py-2 py-md-0">
                        <a href="index.php?r=transactions/index" class="btn btn-warning btn-round">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            <div class="row row-card-no-pd">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="">Akun</label>
                                    <input type="text" class="form-control" readonly value="<?=$data->account->code.' - '.$data->account->name?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Subjek</label>
                                    <input type="text" class="form-control" name="transactions[subject]" readonly value="<?=$data->subject->special_id.' - '.$data->subject->name?>" data-toggle="modal" data-target="#exampleModal">
                                </div>
                                <!-- <div class="form-group">
                                    <label for="">Tagihan</label>
                                    <input type="text" class="form-control" readonly value="<?=$data->bill_id?>">
                                </div> -->
                                <div class="form-group">
                                    <label for="">Jumlah</label>
                                    <input type="number" name="transactions[amount]" class="form-control" required value="<?=$data->amount?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Deskripsi</label>
                                    <textarea name="transactions[description]" class="form-control" required><?=$data->description?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Tanggal</label>
                                    <input type="date" name="transactions[created_at]" class="form-control" value="<?=date('Y-m-d',strtotime($data->created_at))?>" required>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php load_templates('layouts/bottom') ?>