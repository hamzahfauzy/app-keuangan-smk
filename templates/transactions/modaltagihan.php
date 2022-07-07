<!-- Modal -->
<div class="modal fade" id="modaltagihan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Tagihan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <button class="btn btn-primary" onclick="loadTagihan()">Tampilkan Tagihan</button>
                <div class="form-group listDataTagihan d-none">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Subjek</th>
                                <th>Nama Tagihan</th>
                                <th>Jumlah</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="responseDataTagihan">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-close-modal-tagihan" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
async function loadTagihan()
{
    var subject = document.querySelector('#subject').value
    if(subject == '')
    {
        alert('Pilih Subject Terlebih Dahulu')
        return
    }

    var tbody = document.querySelector('#responseDataTagihan')
    tbody.innerHTML = '<tr><td colspan="4">Loading...</td></tr>'
    
    var request = await fetch('index.php?r=api/bills/get-bill&subject='+subject)
    var response = await request.json()

    tbody.innerHTML = ''


    var listData = document.querySelector('.listDataTagihan')
    listData.classList.remove('d-none')

    response.forEach(data => {
        tbody.innerHTML += `<tr><td>${data.subject_name}</td><td>${data.name}</td><td>${data.amount_format}</td><td><button class="btn btn-primary" onclick="pilihTagihan('${data.id}', '${data.name}', '${data.amount}', ${data.account_id})">Pilih</button></tr>`
    })

}

function pilihTagihan(val,name,jumlah,account_id)
{
    document.querySelector('[name="transactions[bill]"]').value = val +' - '+name
    document.querySelector('[name="transactions[amount]"]').value = jumlah
    document.querySelector('[name="transactions[account_id]"]').value = account_id
    document.querySelector('[name="transactions[description]"]').value = name
    document.querySelector('.btn-close-modal-tagihan').click()
}
</script>