<?php load_templates('layouts/top') ?>
<?php load_templates('transactions/modal') ?>
<?php load_templates('transactions/modaltagihan') ?>
    <div class="content">
        <div class="<?=config('theme')['panel_color']?>">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Buat Transaksi Baru</h2>
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
                                <input type="hidden" name="transactions[invoice_code]" value="<?=$_GET['invoice_code']?>">
                                <div class="form-group">
                                    <label for="">Subjek</label>
                                    <input type="text" name="transactions[subject]" id="subject" class="form-control" readonly data-toggle="modal" data-target="#exampleModal">
                                </div>
                                <div class="form-group">
                                    <label for="">Tagihan</label>
                                    <input type="text" name="transactions[bill]" class="form-control" readonly data-toggle="modal" data-target="#modaltagihan">
                                </div>
                                <div class="form-group">
                                    <label for="">Akun</label>
                                    <select name="transactions[account_id]" id="" class="form-control" required>
                                        <option value="">- Pilih -</option>
                                        <?php foreach($accounts as $account): ?>
                                        <option value="<?=$account->id?>"><?=$account->name?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Jumlah</label>
                                    <input type="number" name="transactions[amount]" id="amount" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Deskripsi</label>
                                    <textarea name="transactions[description]" class="form-control" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Tanggal</label>
                                    <input type="date" name="transactions[created_at]" class="form-control" value="<?=date('Y-m-d')?>" required>
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