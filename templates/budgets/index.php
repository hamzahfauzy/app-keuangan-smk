<?php load_templates('layouts/top') ?>
<style>
td input.form-control
{
    height:calc(2.25rem + 2px) !important;
}
.text-xs {
    font-size:11px;
}
</style>
    <div class="content">
        <div class="panel-header bg-success-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Anggaran</h2>
                        <h5 class="text-white op-7 mb-2">Memanajemen data anggaran</h5>
                    </div>
                    <div class="ml-md-auto py-2 py-md-0">
                    <a href="index.php?r=budgets/form&id=<?=$_GET['id']?>" class="btn btn-success">Edit Anggaran</a>
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
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-nowrap" rowspan="2">Kode</th>
                                            <th class="text-center text-nowrap" rowspan="2">Kegiatan/Sub Kegiatan</th>
                                            <th class="text-center text-nowrap" colspan="<?=count($sources)?>">Anggaran</th>
                                            <th class="text-center text-nowrap" rowspan="2">Total</th>
                                            <th class="text-center text-nowrap" rowspan="2">Terpakai</th>
                                        </tr>
                                        <tr>
                                            <?php foreach($sources as $source): ?>
                                            <th class="text-center"><?=$source->name?></th>
                                            <?php endforeach ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?= render_tree_on_row_detail($tree, $sources, $_GET['id']) ?>
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