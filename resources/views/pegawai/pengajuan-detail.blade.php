<x-layout-pegawai>
    @push('csrf_token')
        <meta name="csrf-token" content="{{ csrf_token() }}">
    @endpush
    <x-slot:title>{{ $title }}</x-slot:title>
    <section class="content">
        <h1 class="text-dark py-2 border-bottom border-secondary mb-3">{{ $title }}</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="mb-3">Data Diri</h5>
                <div class="row mb-3">
                    <label for="nm_penjual" class="col-sm-2 col-form-label">Nama
                        Penjual</label>
                    <div class="col-sm-10">
                        <input type="text" name="nm_penjual" class="form-control" id="nm_penjual"
                            value="{{ $pengajuan->nm_penjual }}" disabled>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="no_hp" class="col-sm-2 col-form-label">Nomor
                        HP</label>
                    <div class="col-sm-10">
                        <input type="text" name="no_hp" class="form-control" id="no_hp"
                            value="{{ $pengajuan->no_hp }}" disabled>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" name="alamat" class="form-control" id="alamat"
                            value="{{ $pengajuan->alamat }}" disabled>
                    </div>
                </div>
                <h5 class="mb-3">Data Barang</h5>
                <div class="row mb-3">
                    <label for="id_laptop" class="col-sm-2 col-form-label">ID Pengajuan</label>
                    <div class="col-sm-10">
                        <select class="form-select" aria-label="Default select example" name="id_pengajuan"
                            id="id_pengajuan" disabled>
                            <option selected value="{{ $pengajuan->id_pengajuan }}">{{ $pengajuan->id_pengajuan }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="images" class="col-sm-2 col-form-label">Foto Produk</label>
                    <div class="col-sm-10">
                        @foreach ($foto_produk as $foto)
                            <img src="{{ asset('storage/' . $foto->path) }}" alt="" class="img-thumbnail"
                                style="width: 200px; height: 200px; object-fit: cover">
                        @endforeach
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="platform" class="col-sm-2 col-form-label">Platform</label>
                    <div class="col-sm-10">
                        <select class="form-select" name="platform" disabled>
                            @if ($pengajuan->platform == 'Laptop')
                                <option selected value="Laptop">Laptop</option>
                            @elseif ($pengajuan->platform == 'Notebook')
                                <option selected value="Notebook">Notebook</option>
                            @elseif ($pengajuan->platform == 'Chromebook')
                                <option selected value="Chromebook">Chromebook</option>
                            @elseif ($pengajuan->platform == 'Macbook')
                                <option selected value="Macbook">Macbook</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="merk" class="col-sm-2 col-form-label">Merk</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('merk') is-invalid @enderror" name="merk"
                            id="merk" value="{{ old('merk', $pengajuan->merk) }}" disabled>
                        @error('merk')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="tipe" class="col-sm-2 col-form-label">Tipe Laptop</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('tipe') is-invalid @enderror" name="tipe"
                            id="tipe" value="{{ old('tipe', $pengajuan->tipe) }}" disabled>
                        @error('tipe')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="processor" class="col-sm-2 col-form-label">Processor</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('processor') is-invalid @enderror"
                            name="processor" id="processor" value="{{ old('processor', $pengajuan->processor) }}"
                            disabled>
                        @error('processor')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="memory" class="col-sm-2 col-form-label">Memory (RAM)</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('memory') is-invalid @enderror" name="memory"
                            id="memory" value="{{ old('memory', $pengajuan->memory) }}" disabled>
                        @error('memory')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="storage" class="col-sm-2 col-form-label">Storage</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('storage') is-invalid @enderror"
                            name="storage" id="storage" value="{{ old('storage', $pengajuan->storage) }}"
                            disabled>
                        @error('storage')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="uk_layar" class="col-sm-2 col-form-label">Ukuran Layar (Inch)</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('uk_layar') is-invalid @enderror"
                            name="uk_layar" id="uk_layar" value="{{ old('uk_layar', $pengajuan->uk_layar) }}"
                            disabled>
                        @error('uk_layar')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="is_touchscreen" class="col-sm-2 col-form-label">Jenis Layar</label>
                    <div class="col-sm-10">
                        <select class="form-select" name="is_touchscreen" disabled>
                            @if ($pengajuan->is_touchscreen == 'Ya')
                                <option selected value="Ya">Touchscreen</option>
                            @else
                                <option selected value="Tidak">Non Touchscreen</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="info_tambahan" class="col-sm-2 col-form-label">Info Tambahan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('info_tambahan') is-invalid @enderror"
                            name="info_tambahan" id="info_tambahan"
                            value="{{ old('info_tambahan', $pengajuan->info_tambahan) }}" disabled>
                        @error('info_tambahan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="kelengkapan" class="col-sm-2 col-form-label">Kelengkapan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('kelengkapan') is-invalid @enderror"
                            name="kelengkapan" id="kelengkapan"
                            value="{{ old('kelengkapan', $pengajuan->kelengkapan) }}" disabled>
                        @error('kelengkapan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div>
                    <div class="row mb-3">
                        <label for="tambah-minus" class="col-2 col-form-label">Minus</label>
                        <div class="col" id="minus">
                            @foreach ($pengajuan->minus as $m)
                                <div class="mb-3 d-flex flex-row flex-nowrap gap-1 justify-content-start">
                                    <input type="text" class="form-control d-inline-block" name="minus[]"
                                        value="{{ $m }}" disabled>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control @error('harga') is-invalid @enderror"
                            name="harga" id="harga" value="{{ old('harga', $pengajuan->harga) }}" disabled>
                        @error('harga')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="jml_barang" class="col-sm-2 col-form-label">Jumlah Barang</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control @error('jml_barang') is-invalid @enderror"
                            name="jml_barang" id="jml_barang"
                            value="{{ old('jml_barang', $pengajuan->jml_barang) }}" disabled>
                        @error('jml_barang')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="status_pembelian" class="col-2 col-form-label">Status Pengajuan</label>
                    <div class="col-sm-10">
                        <select class="form-select" aria-label="Default select example" name="status_pembelian"
                            disabled>
                            <option selected value="{{ $pengajuan->status_pengajuan }}">
                                {{ $pengajuan->status_pengajuan }}</option>
                        </select>
                    </div>
                </div>
                <div class="mt-5">
                    <a href="/data-pengajuan" class="btn btn-secondary">Kembali</a>
                </div>
                </form>
            </div>
        </div>
    </section>
    @push('Custom Script')
        <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
        <script>
            var num = 1;
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })

                $('#id_laptop').on('change', function() {
                    let LaptopId = $(this).val();
                    $.getJSON('/data-pembelian/get-data-laptop/' + LaptopId, function(data) {
                        $('#harga').empty();
                        $('#jml_barang').empty();
                        let dataLaptop = data.data;
                        $.each(dataLaptop, function(i, data) {
                            $('#harga').val(data.harga);
                            $('#jml_barang').val(data.jml_barang);
                            $('#jml_barang').attr('max', data.jml_barang);
                            $('#total_pembayaran').val(data.harga * $('#jml_barang').val());
                        });
                    });
                })

                $('#jml_barang').on('change', function() {
                    $('#total_pembayaran').val($(this).val() * $('#harga').val());
                })

                $('#btn-minus').click(function() {
                    $('#minus').append(
                        `<div class="minus-item row mb-3 d-flex flex-row flex-nowrap gap-2 justify-content-start">
                                <input type="text" class="form-control d-inline-block w-50" id="minus[${num}]" placeholder="Minus ${num}">
                                <button id="btn1" type="button" class="d-inline-block btn btn-danger w-25 btn-hapus"><i class="bi bi-trash"></i></button>
                        </div>`
                    )
                    num++;
                })


            });
        </script>
    @endpush
</x-layout-pegawai>
