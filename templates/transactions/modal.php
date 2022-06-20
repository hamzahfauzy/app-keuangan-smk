<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Subjek</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Jenis</label>
                    <select name="jenis" id="jenis" class="form-control" onchange="loadData()" required></select>
                </div>
                <div class="form-group">
                    <label for="">Nama / ID</label>
                    <input type="text" name="keyword" class="form-control" id="keyword" onkeyup="loadData()">
                </div>
                <div class="form-group listData d-none">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="responseData">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-close-modal" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
loadSubjectType()
async function loadSubjectType()
{
    var request = await fetch('index.php?r=api/subjects/get-subject-type')
    var response = await request.json()
    var jenis = document.querySelector('#jenis')
    jenis.innerHTML = '<option value="">- Pilih -</option>'
    response.forEach(data => {
        jenis.innerHTML += '<option value="'+data.subject_type+'">'+data.subject_type+'</option>'
    })
}

async function loadData()
{
    var jenis = document.querySelector('#jenis').value
    if(jenis == '')
    {
        alert('Pilih Jenis Terlebih Dahulu')
        return
    }

    var keyword = document.querySelector('#keyword').value
    if(keyword)
    {
        keyword = '&keyword='+keyword
    }

    var tbody = document.querySelector('#responseData')
    tbody.innerHTML = '<tr><td colspan="4">Loading...</td></tr>'
    
    var request = await fetch('index.php?r=api/subjects/get-subject&jenis='+jenis+keyword)
    var response = await request.json()

    tbody.innerHTML = ''


    var listData = document.querySelector('.listData')
    listData.classList.remove('d-none')

    response.forEach(data => {
        tbody.innerHTML += `<tr><td>${data.special_id}</td><td>${data.name}</td><td><button class="btn btn-primary" onclick="pilih('${data.special_id} - ${data.name}')">Pilih</button></tr>`
    })

}

function pilih(val)
{
    document.querySelector('[name="transactions[subject]"]').value = val
    document.querySelector('.btn-close-modal').click()
}
</script>