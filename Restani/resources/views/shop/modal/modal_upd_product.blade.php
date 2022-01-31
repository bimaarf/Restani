<div class="modal top fade" id="upd-product{{ $prod->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-mdb-backdrop="true" data-mdb-keyboard="true">
    <div class="modal-dialog modal-lg  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Produk</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('shop.update', ['id'=>$prod->id]) }}" method="POST">
                    @csrf
                    <div class="form-outline my-4">
                        <input name="title" type="text" class="form-control form-control-lg" value="{{ $prod->title }}" required>
                        <label class="form-label" for="title">Nama Produk</label>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 my-2">
                            <div class="form-outline">
                                <input name="harga" type="number" class="form-control form-control-lg" value="{{ $prod->harga }}" required>
                                <label class="form-label" for="harga">Harga</label>
                            </div>
                        </div>
                        <div class="col-lg-6 my-2">
                            <div class="form-outline">
                                <input name="stok" type="number" class="form-control form-control-lg" value="{{ $prod->stok }}" required>
                                <label class="form-label" for="stok">Stok</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 my-2">
                            <div class="form-outline">
                                <input name="lokasi" type="text" class="form-control form-control-lg" value="{{ $prod->lokasi }}" required>
                                <label class="form-label" for="lokasi">Lokasi</label>
                            </div>
                        </div>
                        <div class="col-lg-6 my-2">
                            <select class="form-select form-select-lg" name="kategori_id" id="kategori_id">
                                @foreach ($category as $categ)
                                    <option {{($categ->id == $prod->kategori_id) ? 'selected' : ''}} value="{{ $categ->id }}">{{ $categ->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-info" value="Submit">
                </div>
            </form>
        </div>
    </div>
</div>

