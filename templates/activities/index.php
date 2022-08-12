<?php load_templates('layouts/top') ?>
    <div class="content">
        <div class="<?=config('theme')['panel_color']?>">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Kegiatan</h2>
                        <h5 class="text-white op-7 mb-2">Memanajemen data kegiatan</h5>
                    </div>
                    <div class="ml-md-auto py-2 py-md-0">
                        <a href="index.php?r=activities/create" class="<?=config('theme')['button_main_color']?> btn-round">Buat Kegiatan</a>
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
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th width="20px">#</th>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Deskripsi</th>
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
                                            <td><?=$data->code?></td>
                                            <td>
                                                <?=$data->name?>
                                                <?=isset($data->parent)?'<br><i>'.$data->parent->name.'</i>':''?>
                                            </td>
                                            <td><?=$data->description?></td>
                                            <td>
                                                <a href="index.php?r=activities/edit&id=<?=$data->id?>" class="btn btn-sm btn-warning"><i class="fas fa-pencil-alt"></i> Edit</a>
                                                <a href="index.php?r=activities/delete&id=<?=$data->id?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Hapus</a>
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