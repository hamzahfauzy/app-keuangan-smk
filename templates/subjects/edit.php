<?php load_templates('layouts/top') ?>
    <div class="content">
        <div class="<?=config('theme')['panel_color']?>">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Edit Subjek : <?=$data->name?></h2>
                        <h5 class="text-white op-7 mb-2">Memanajemen data subjek transaksi</h5>
                    </div>
                    <div class="ml-md-auto py-2 py-md-0">
                        <a href="index.php?r=subjects/index" class="btn btn-warning btn-round">Kembali</a>
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
                                    <label for="">NIK/NIP/NISN</label>
                                    <input type="text" name="subjects[special_id]" class="form-control" required value="<?=$data->special_id?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input type="text" name="subjects[name]" class="form-control" required value="<?=$data->name?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Grup</label>
                                    <input type="text" name="subjects[subject_group]" class="form-control" required value="<?=$data->subject_group?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Tipe</label>
                                    <select name="subjects[subject_type]" id="" class="form-control" required>
                                        <option value="">Pilih</option>
                                        <option <?=$data->subject_type=='PTK'?'selected=""':''?>>PTK</option>
                                        <option <?=$data->subject_type=='SISWA'?'selected=""':''?>>SISWA</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Deskripsi</label>
                                    <textarea name="subjects[description]" class="form-control" required><?=$data->description?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Whatsapp</label>
                                    <input type="number" name="subjects[whatsapp]" class="form-control" required value="<?=$data->whatsapp?>">
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