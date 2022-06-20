<?php load_templates('layouts/top') ?>
    <div class="content">
        <div class="panel-header bg-success-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Pembayaran Tagihan : <?=$data->name?></h2>
                        <h5 class="text-white op-7 mb-2">Memanajemen data tagihan</h5>
                    </div>
                    <div class="ml-md-auto py-2 py-md-0">
                        <a href="index.php?r=bills/index" class="btn btn-warning btn-round">Kembali</a>
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
                                    <label for="">Subjek</label>
                                    <input type="text" class="form-control" readonly value="<?=$data->subject_name?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Tagihan</label>
                                    <input type="text" class="form-control" readonly value="<?=$data->name?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Jumlah</label>
                                    <input type="number" max="<?=$data->max_jumlah?>" name="amount" class="form-control" required value="<?=$data->max_jumlah?>">
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