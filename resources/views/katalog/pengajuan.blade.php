<x-layouts>
    <!--- Menangkap Variabel title yang dikirim dari routes untuk ditampilkan di layouts --->
    <x-slot:title>{{ $title }}</x-slot:title>
    <main class="container">
        <div class="mb-2 mb-md-4">
            <h2 class="mb-4">{{ $title }}</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pengajuan Jual Laptop</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex flex-column flex-nowrap gap-2 justify-content-center">
            <section class="d-flex flex-column w-sm-100 w-md-75" style="margin-inline: auto;">
                <h3 class="text-center">Selamat Datang <br> di Halaman Pengajuan Jual Laptop!</h3>
                <p class="text-center">Kamu bisa menjual laptop yang sudah tidak dipakai dengan mudah, dengan
                    melakukan pengisian form dibawah
                    ini!</p>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ url('/jual-laptop') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <h5 class="mb-3">Data Diri</h5>
                            <div class="row mb-3">
                                <label for="nm_penjual" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('nm_penjual') is-invalid @enderror"
                                        name="nm_penjual" id="nm_penjual"
                                        value="{{ old('nm_penjual', auth()->user()->nm_user) }}" disabled>
                                    @error('nm_penjual')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="no_hp" class="col-sm-2 col-form-label">No HP</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                        name="no_hp" id="no_hp" value="{{ old('no_hp', auth()->user()->no_hp) }}"
                                        disabled>
                                    @error('no_hp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-5">
                                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                        name="alamat" id="alamat" placeholder="Asus"
                                        value="{{ old('alamat', auth()->user()->alamat) }}">
                                    @error('alamat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <h5 class="mb-3">Data Barang</h5>
                            <div class="row mb-3">
                                <label for="images" class="col-sm-2 col-form-label">Foto Produk</label>
                                <div class="col-sm-10">
                                    <input class="form-control @error('image[]') is-invalid @enderror mb-3"
                                        type="file" name="images[]" multiple accept="image/*">
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
                                        <option selected value="Laptop">Laptop</option>
                                        <option value="Notebook">Notebook</option>
                                        <option value="Chromebook">Chromebook</option>
                                        <option value="Macbook">Macbook</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="merk" class="col-sm-2 col-form-label">Merk</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('merk') is-invalid @enderror"
                                        name="merk" id="merk" placeholder="Asus" value="{{ old('merk') }}">
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
                                        name="tipe" id="tipe" placeholder="Vivobook X441M"
                                        value="{{ old('tipe') }}">
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
                                        name="processor" id="processor" placeholder="Intel Core i5"
                                        value="{{ old('processor') }}">
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
                                        name="memory" id="memory" placeholder="4GB"
                                        value="{{ old('memory') }}">
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
                                        name="storage" id="storage" placeholder="500GB"
                                        value="{{ old('storage') }}">
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
                                        name="uk_layar" id="uk_layar" placeholder="14"
                                        value="{{ old('uk_layar') }}">
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
                                        <option value="Ya">Touchscreen</option>
                                        <option selected value="Tidak">Non Touchscreen</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="info_tambahan" class="col-sm-2 col-form-label">Info Tambahan</label>
                                <div class="col-sm-10">
                                    <input type="text"
                                        class="form-control @error('info_tambahan') is-invalid @enderror"
                                        name="info_tambahan" id="info_tambahan"
                                        placeholder="Semua Fungsi Normal / Grafis Nvidia MX130"
                                        value="{{ old('info_tambahan') }}">
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
                                    <input type="text"
                                        class="form-control @error('kelengkapan') is-invalid @enderror"
                                        name="kelengkapan" id="kelengkapan" placeholder="Unit & Charger"
                                        value="{{ old('kelengkapan') }}">
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
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control @error('harga') is-invalid @enderror"
                                        name="harga" id="harga" value="{{ old('harga') }}">
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
                                    <input type="number"
                                        class="form-control @error('jml_barang') is-invalid @enderror"
                                        name="jml_barang" id="jml_barang" value="{{ old('jml_barang') }}">
                                    @error('jml_barang')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-5">
                                <a href="/data-laptop" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-success">Kirim Pengajuan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <footer class="fixed-bottom bg-light p-2 d-md-none">
        <section class="container">
            <div class="d-flex flex-row flex-nowrap gap-2">
                <div class="flex-grow-1 d-flex justify-content-center align-items-center">
                    <a href="{{ url('/notifikasi') }}" class="btn btn-secondary rounded-3 order-2 p-2 w-100">
                        Kembali</a>
                </div>
            </div>
        </section>
    </footer>
    <x-modal-hapus></x-modal-hapus>
    @push('customscript')
        <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
        <script>
            var num = 1;
            $(document).ready(function() {
                $('#btn-minus').click(function() {
                    $('#minus').append(
                        `<div class="minus-item mb-3 d-flex flex-row flex-nowrap gap-1 justify-content-start">
                            <input type="text" class="form-control d-inline-block w-75" name="minus[]" id="minus[${num}]" placeholder="Minus ${num}">
                            <div class="w-25">
                                <button id="btn1" type="button" class="d-inline-block btn btn-danger btn-hapus"><i class="bi bi-trash"></i></button>
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
</x-layouts>
