<?php load_templates('layouts/top') ?>
    <div class="content">
        <div class="panel-header bg-success-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Anggaran</h2>
                        <h5 class="text-white op-7 mb-2">Memanajemen data anggaran</h5>
                    </div>
                    <div class="ml-md-auto py-2 py-md-0">
                        <a href="index.php?r=years/create" class="btn btn-success btn-round">Buat Tahun Anggaran</a>
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
                                            <th>Nama</th>
                                            <th>Total Anggaran</th>
                                            <th>Terpakai</th>
                                            <th>Sisa</th>
                                            <!-- <th>Status</th> -->
                                            <th class="text-right">
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        foreach($datas as $index => $data): 
                                            $terpakai = terpakai($tree,$data->id);
                                        ?>
                                        <tr>
                                            <td>
                                                <?=$index+1?>
                                            </td>
                                            <td><?=$data->name?></td>
                                            <td class="text-nowrap">Rp. <?=number_format($data->budget)?></td>
                                            <td class="text-nowrap">Rp. <?=number_format($terpakai) ?></td>
                                            <td class="text-nowrap">Rp. <?=number_format($data->budget-$terpakai)?></td>
                                            <!-- <td><?=config('status_anggaran')[$data->status]?></td> -->
                                            <td>
                                                <a href="index.php?r=budgets/index&id=<?=$data->id?>" class="btn btn-sm btn-success"><i class="fas fa-eye"></i> Lihat</a>
                                                <a href="index.php?r=years/edit&id=<?=$data->id?>" class="btn btn-sm btn-warning"><i class="fas fa-pencil-alt"></i> Edit</a>
                                                <a href="index.php?r=years/delete&id=<?=$data->id?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Hapus</a>
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