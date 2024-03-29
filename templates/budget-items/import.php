<?php load_templates('layouts/top') ?>
    <div class="content">
        <div class="<?=config('theme')['panel_color']?>">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Import Rincian Kegiatan</h2>
                        <h5 class="text-white op-7 mb-2">Memanajemen data rincian kegiatan</h5>
                    </div>
                    <div class="ml-md-auto py-2 py-md-0">
                        <a href="format/format-import-rincian.csv" class="<?=config('theme')['button_main_color']?> btn-round">Download Format Import</a>
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
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="">File Import</label>
                                    <input type="file" name="file" class="form-control" required>
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