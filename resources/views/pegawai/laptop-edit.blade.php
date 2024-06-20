<x-layout-pegawai>
    <x-slot:title>{{ $title }}</x-slot:title>
    <section class="content">
        <h1 class="text-dark py-2 border-bottom border-secondary mb-3">{{ $title }}</h1>
        <div class="card">
            <div class="card-body">
                <form action="./{{ $data_laptop->id_laptop }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label for="#" class="mb-3">Foto Lama</label>
                        <div class="col-sm-10">
                            @foreach ($foto_produk as $foto)
                                <img src="{{ asset('storage/' . $foto->path) }}" alt="" name="images-before"
                                    class="img-thumbnail" style="width: 200px; height: 200px; object-fit: cover">
                            @endforeach
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="images" class="col-sm-2 col-form-label">Upload Foto Baru</label>
                        <div class="col-sm-10">
                            <input class="form-control @error('image[]') is-invalid @enderror mb-3" type="file"
                                name="images[]" multiple accept="image/jpeg, image/jpg, image/png, image/svg"
                                value="{{ $foto_produk }}">
                            <div class="form-text">Dapat Mengupload beberapa gambar, max size per file 1MB.
                            </div>
                            @error('images[]')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="platform" class="col-sm-2 col-form-label">Platform</label>
                        <div class="col-sm-10">
                            <select class="form-select" name="platform">
                                @if (old('platform', $data_laptop->platform) == 'Laptop')
                                    <option selected value="Laptop">Laptop</option>
                                    <option value="Notebook">Notebook</option>
                                    <option value="Chromebook">Chromebook</option>
                                    <option value="Macbook">Macbook</option>
                                @elseif (old('platform', $data_laptop->platform) == 'Notebook')
                                    <option value="Laptop">Laptop</option>
                                    <option selected value="Notebook">Notebook</option>
                                    <option value="Chromebook">Chromebook</option>
                                    <option value="Macbook">Macbook</option>
                                @elseif (old('platform', $data_laptop->platform) == 'Chromebook')
                                    <option value="Laptop">Laptop</option>
                                    <option value="Notebook">Notebook</option>
                                    <option selected value="Chromebook">Chromebook</option>
                                    <option value="Macbook">Macbook</option>
                                    </option>
                                @elseif (old('platform', $data_laptop->platform) == 'Macbook')
                                    <option value="Laptop">Laptop</option>
                                    <option value="Notebook">Notebook</option>
                                    <option value="Chromebook">Chromebook</option>
                                    <option selected value="Macbook">Macbook</option>
                                    </option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="merk" class="col-sm-2 col-form-label">Merk</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('merk') is-invalid @enderror"
                                name="merk" id="merk" value="{{ old('merk', $data_laptop->merk) }}">
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
                            <input type="text" class="form-control @error('tipe') is-invalid @enderror"
                                name="tipe" id="tipe" value="{{ old('tipe', $data_laptop->tipe) }}">
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
                                name="processor" id="processor"
                                value="{{ old('processor', $data_laptop->processor) }}">
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
                            <input type="text" class="form-control @error('memory') is-invalid @enderror"
                                name="memory" id="memory" value="{{ old('memory', $data_laptop->memory) }}">
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
                                name="storage" id="storage" value="{{ old('storage', $data_laptop->storage) }}">
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
                                name="uk_layar" id="uk_layar"
                                value="{{ old('uk_layar', $data_laptop->uk_layar) }}">
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
                            <select class="form-select" name="is_touchscreen">
                                @if (old('is_touchscreen', $data_laptop->is_touchscreen) == 'Ya')
                                    <option selected value="Ya">Touchscreen</option>
                                    <option value="Tidak">Non Touchscreen</option>
                                @else
                                    <option value="Ya">Touchscreen</option>
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
                                value="{{ old('info_tambahan', $data_laptop->info_tambahan) }}">
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
                                value="{{ old('kelengkapan', $data_laptop->kelengkapan) }}">
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
                                <div class="col-1 mb-3">
                                    <a id="btn-minus" class="form-control btn btn-success"><i
                                            class="bi bi-plus-circle"></i></a>
                                </div>
                                @foreach ($data_laptop->minus as $m)
                                    <div
                                        class="minus-item mb-3 d-flex flex-row flex-nowrap gap-1 justify-content-start">
                                        <input type="text" class="form-control d-inline-block w-75"
                                            name="minus[{{ array_search($m, $data_laptop->minus) }}]"
                                            value="{{ $m }}" required>
                                        <div class="w-25">
                                            <button type="button" class="d-inline-block btn btn-danger btn-hapus"><i
                                                    class="bi bi-trash"></i></button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control @error('harga') is-invalid @enderror"
                                name="harga" id="harga" value="{{ old('harga', $data_laptop->harga) }}">
                            @error('harga')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="stok" class="col-sm-2 col-form-label">Stok</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control @error('stok') is-invalid @enderror"
                                name="stok" id="stok" value="{{ old('stok', $data_laptop->stok) }}">
                            @error('stok')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-5">
                        <a href="/data-laptop" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <x-modal-failed>{{ session('error') }}</x-modal-failed>
    @push('Custom Script')
        <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
        <script>
            var num = 1;
            $(document).ready(function() {
                $('#btn-minus').click(function() {
                    $('#minus').append(
                        `<div class="minus-item mb-3 d-flex flex-row flex-nowrap gap-1 justify-content-start">
                                <input type="text" class="form-control d-inline-block w-75" name="minus[]" id="minus[${num}]" required>
                                <div class="w-25">
                                    <button type="button" class="d-inline-block btn btn-danger btn-hapus"><i class="bi bi-trash"></i></button>
                                </div>
                        </div>`
                    )
                    num++;
                })

                $('#minus').on('click', '.btn-hapus', function() {
                    num--;
                    $(this).closest('div.minus-item').remove();
                });
            });
        </script>
    @endpush
</x-layout-pegawai>
