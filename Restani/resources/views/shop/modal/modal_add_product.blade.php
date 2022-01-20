<div class="modal top fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-mdb-backdrop="true" data-mdb-keyboard="true">
    <div class="modal-dialog modal-lg  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambahkan Produk</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('shop.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-outline my-4">
                        <input name="title" type="text" class="form-control form-control-lg" required>
                        <label class="form-label" for="title">Nama Produk</label>
                    </div>
                    <div class="form-outline my-4">
                        <input id="desc" type="hidden" name="desc" value="{{ old('desc') }}">
                        <trix-editor input="desc"></trix-editor>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 my-2">
                            <div class="form-outline">
                                <input name="harga" type="number" class="form-control form-control-lg" required>
                                <label class="form-label" for="harga">Harga</label>
                            </div>
                        </div>
                        <div class="col-lg-6 my-2">
                            <div class="form-outline">
                                <input name="stok" type="number" class="form-control form-control-lg"  required>
                                <label class="form-label" for="stok">Stok</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 my-2">
                            <div class="form-outline">
                                <input name="lokasi" type="text" class="form-control form-control-lg" required>
                                <label class="form-label" for="lokasi">Lokasi</label>
                            </div>
                        </div>
                        <div class="col-lg-6 my-2">
                            <select class="form-select form-select-lg" name="kategori_id" id="kategori_id">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($category as $categ)
                                    <option value="{{ $categ->id }}">{{ $categ->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputFormRow">Foto</label><span class="small text-danger font-italic">*max 6</span>
                        <div id="inputFormRow">
                            <div class="input-group mb-3">
                                <input type="file" name="foto[]" class="form-control-file form-control" required autofocus>
                                <div class="input-group-append">
                                    <button id="removeRow" type="button" class="btn btn-danger">Hapus</button>
                                </div>
                            </div>
                        </div>
                        <div id="newRow"></div>
                        <button id="inc" onclick="addRow()" type="button" class="btn btn-info my-2">Tambah
                            Foto</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-info" value="Submit">
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    // add row
    var i = 1;
    $('.btn').attr('disabled', false);

    function addRow() {
        ++i;
        var html = '';
        html += '<div id="inputFormRow">';
        html += '<div class="input-group mb-3">';
        html += '<input type="file" name="foto[]" id="input-file-now" class="form-control-file form-control"data-file-upload="file-upload" required autofocus>'
        html += '<div class="input-group-append">';
        html += '<button id="removeRow" type="button" class="btn btn-danger">Hapus</button>';
        html += '</div>';
        html += '</div>';
        $('#newRow').append(html);
        if (i > 5) {
            console.log('lebih');
            $('#inc').attr('disabled', true);
        }
    }
    // remove row
    $(document).on('click', '#removeRow', function() {
        --i;
        $(this).closest('#inputFormRow').remove();
        if(i < 7) {
            $('.btn').attr('disabled', false);
        }
    });
</script>
