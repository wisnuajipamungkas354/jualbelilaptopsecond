<x-layout-pegawai>
    @push('csrf_token')
        <meta name="csrf-token" content="{{ csrf_token() }}">
    @endpush
    <x-slot:title>{{ $title }}</x-slot:title>
    <section class="content">
        <h1 class="text-dark py-2 border-bottom border-secondary mb-3">{{ $title }}</h1>
        <div class="card">
            <div class="card-body">
                <form action="{{ url('/data-pembelian/pembelian-edit/' . $data_pembelian->id_pembelian . '/edit') }}"
                    method="POST">
                    @csrf
                    <div class="row mb-3">
                        <label for="nm_pelanggan" class="col-sm-2 col-form-label">ID Pembelian</label>
                        <div class="col-sm-10">
                            <input type="text" name="id_pembeli" class="form-control" id="nm_pembeli"
                                value="{{ old('id_pembeli', $data_pembelian->id_pembelian) }}" disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="nm_pelanggan" class="col-sm-2 col-form-label">Nama Pembeli</label>
                        <div class="col-sm-10">
                            <input type="text" name="nm_pembeli"
                                class="form-control @error('nm_pembeli') is-invalid @enderror" id="nm_pembeli"
                                value="{{ old('nm_pembeli', $data_pembelian->nm_pembeli) }}">
                            @error('nm_pembeli')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="no_hp" class="col-sm-2 col-form-label">Nomor
                            HP</label>
                        <div class="col-sm-10">
                            <input type="text" name="no_hp"
                                class="form-control @error('no_hp') is-invalid @enderror" id="no_hp"
                                value="{{ old('no_hp', $data_pembelian->no_hp) }}">
                            @error('no_hp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <input type="text" name="alamat"
                                class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                                value="{{ old('alamat', $data_pembelian->alamat) }}">
                            @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="mtd_pembayaran" class="col-sm-2 col-form-label">Metode Pembayaran</label>
                        <div class="col-sm-10">
                            <select class="form-select" aria-label="Default select example" name="mtd_pembayaran"
                                id="mtd_pembayaran" disabled>
                                <option value="{{ $data_pembelian->mtd_pembayaran }}">
                                    {{ $data_pembelian->mtd_pembayaran }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="id_laptop" class="col-sm-2 col-form-label">ID Laptop</label>
                        <div class="col-sm-10">
                            <select class="form-select" aria-label="Default select example" name="id_laptop"
                                id="id_laptop" disabled>
                                <option selected value="{{ $data_laptop->id_laptop }}">{{ $data_laptop->id_laptop }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="harga" value="{{ $data_laptop->harga }}"
                                disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="jml_barang" class="col-sm-2 col-form-label">Jumlah Barang</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control @error('jml_barang') is-invalid @enderror"
                                id="jml_barang" name="jml_barang" value="{{ $data_pembelian->jml_barang }}" disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="total_pembayaran" class="col-sm-2 col-form-label">Total Pembayaran</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control @error('total_pembayaran') is-invalid @enderror"
                                id="total_pembayaran" name="total_pembayaran" minlength="1"
                                value="{{ old('total_pembayaran', $data_pembelian->total_pembayaran) }}" disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="status_pembelian" class="col-2 col-form-label">Status Pembelian</label>
                        <div class="col-sm-10">
                            <select class="form-select" aria-label="Default select example" name="status_pembelian">
                                <option @if (old('status_pembelian', $data_pembelian->status_pembelian) == 'Menunggu Konfirmasi') selected @endif value="Menunggu Konfirmasi">
                                    Menunggu Konfirmasi</option>
                                <option @if (old('status_pembelian', $data_pembelian->status_pembelian) == 'Diproses Admin') selected @endif value="Diproses Admin">
                                    Diproses Admin</option>
                                <option @if (old('status_pembelian', $data_pembelian->status_pembelian) == 'Dalam Pengiriman') selected @endif value="Dalam Pengiriman">
                                    Dalam Pengiriman</option>
                                <option @if (old('status_pembelian', $data_pembelian->status_pembelian) == 'Diterima Pembeli') selected @endif value="Diterima Pembeli">
                                    Diterima Pembeli</option>
                                <option @if (old('status_pembelian', $data_pembelian->status_pembelian) == 'Dibatalkan Pembeli') selected @endif value="Dibatalkan Pembeli">
                                    Dibatalkan Pembeli</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-5">
                        <a href="/data-pembelian" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-warning">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    @if (session('success'))
        <x-modal-success>{{ session('success') }}</x-modal-success>
    @elseif (session('error'))
        <x-modal-failed>{{ session('error') }}</x-modal-failed>
    @endif
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
                        $('#stok').empty();
                        let dataLaptop = data.data;
                        $.each(dataLaptop, function(i, data) {
                            $('#harga').val(data.harga);
                            $('#stok').val(data.stok);
                            $('#jml_barang').attr('max', data.stok);
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
        @if (session('success'))
            <script>
                Swal.fire({
                    template: "#modal-success"
                });
            </script>
        @endif
        @if (session('error'))
            <script>
                Swal.fire({
                    template: "#modal-failed"
                });
            </script>
        @endif
    @endpush
</x-layout-pegawai>
