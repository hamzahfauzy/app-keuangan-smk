<!-- Modal -->
<div class="modal fade" id="modalakun" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Akun</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($accounts as $account): ?>
                            <tr>
                                <td><?=$account->code?></td>
                                <td><?=$account->name?></td>
                                <td><button class="btn btn-primary" onclick="pilihAkun('<?=$account->code?> - <?=$account->name?>')">Pilih</button></td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-close-modal-akun" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
function pilihAkun(account_id)
{
    document.querySelector('[name="transactions[account]"]').value = account_id
    document.querySelector('.btn-close-modal-akun').click()
}
</script>