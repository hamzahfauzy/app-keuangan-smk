<?php if(!isset($_GET['cetak'])): ?>
<?php load_templates('layouts/top') ?>
<style>
.text-xs {
    font-size:11px;
}
</style>
    <div class="content">
        <div class="panel-header bg-success-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Laporan Anggaran</h2>
                        <h5 class="text-white op-7 mb-2">Laporan anggaran</h5>
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
                            <input type="hidden" name="r" value="reports/budget">
                            <div class="form-group">
                                <label for="">Filter</label>
                                <div class="d-flex">
                                    <input type="number" placeholder="Tahun" name="year" onchange="updateDate(this.value)" class="form-control" value="<?=@$_GET['year']?>">
                                    &nbsp;
                                    <input type="date" id="from" name="from" class="form-control" value="<?=@$_GET['from']?>">
                                    &nbsp;
                                    <input type="date" id="to" name="to" class="form-control" value="<?=@$_GET['to']?>">
                                    &nbsp;
                                    <button name="tampil" class="btn btn-success">Tampilkan</button>
                                    &nbsp;
                                    <button name="cetak" class="btn btn-primary">Cetak</button>
                                </div>
                            </div>
                            </form>

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <?php else: ?>
                                    <script>window.print()</script>
                                    <h1 align="center" style="margin:0;padding:0">LAPORAN KEUANGAN</h1>
                                    <p align="center"><?=$_GET['from']?> - <?=$_GET['to']?></p>
                                    <table border="1" cellpadding="5" cellspacing="0" width="100%">
                                    <?php endif ?>
                                    <thead>
                                        <tr>
                                            <th class="text-center text-nowrap" rowspan="2">Kode</th>
                                            <th class="text-center text-nowrap" rowspan="2">Kegiatan/Sub Kegiatan</th>
                                            <th class="text-center text-nowrap" colspan="<?=count($sources)?>">Anggaran</th>
                                            <th class="text-center text-nowrap" rowspan="2">Total Anggaran</th>
                                            <th class="text-center text-nowrap" rowspan="2">Terpakai</th>
                                            <th class="text-center text-nowrap" rowspan="2">Sisa</th>
                                        </tr>
                                        <tr>
                                            <?php foreach($sources as $source): ?>
                                            <th class="text-center"><?=$source->name?></th>
                                            <?php endforeach ?>
                                        </tr>
                                    </thead>
                                    <?php if(!empty($tree)): ?>
                                    <tbody>
                                        <?= render_tree_on_row_detail($tree, $sources, $year->id, 1) ?>
                                    </tbody>
                                    <?php endif ?>
                                </table>
                            </div>
                            <?php if(!isset($_GET['cetak'])): ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php load_templates('layouts/bottom') ?>
<script>
function updateDate(year)
{
    document.getElementById('from').setAttribute("min", year + "-01-01");
    document.getElementById('from').setAttribute("max", year + "-12-31");

    document.getElementById('to').setAttribute("min", year + "-01-01");
    document.getElementById('to').setAttribute("max", year + "-12-31");
}
</script>
<?php endif ?>