<?php load_templates('layouts/top') ?>
<?php load_templates('subjects/modal') ?>
    <div class="content">
        <div class="<?=config('theme')['panel_color']?>">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Subjek</h2>
                        <h5 class="text-white op-7 mb-2">Memanajemen data subjek transaksi</h5>
                    </div>
                    <div class="ml-md-auto py-2 py-md-0">
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn-round">Import</a>
                        <a href="index.php?r=subjects/create" class="<?=config('theme')['button_main_color']?> btn-round">Buat Subjek</a>
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
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Tipe</th>
                                            <th>Whatsapp</th>
                                            <th>Group</th>
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
                                            <td><?=$data->special_id?></td>
                                            <td><?=$data->name?></td>
                                            <td><?=$data->subject_type?></td>
                                            <td><?=$data->whatsapp?></td>
                                            <td><?=$data->subject_group?></td>
                                            <td>
                                                <a href="index.php?r=subjects/view&id=<?=$data->id?>" class="btn btn-sm btn-success"><i class="fas fa-eye"></i> Lihat</a>
                                                <a href="index.php?r=subjects/edit&id=<?=$data->id?>" class="btn btn-sm btn-warning"><i class="fas fa-pencil-alt"></i> Edit</a>
                                                <a href="index.php?r=subjects/delete&id=<?=$data->id?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Hapus</a>
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