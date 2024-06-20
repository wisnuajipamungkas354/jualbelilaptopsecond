<x-layout-pegawai>
    @push('csrf_token')
        <meta name="csrf-token" content="{{ csrf_token() }}">
    @endpush
    <x-slot:title>{{ $title }}</x-slot:title>
    <section class="content">
        <h1 class="text-dark py-2 border-bottom border-secondary mb-3">{{ $title }}</h1>
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <label for="nm_pelanggan" class="col-sm-2 col-form-label">Nama
                        Pembeli</label>
                    <div class="col-sm-10">
                        <input type="text" name="nm_pembeli" class="form-control" id="nm_pembeli"
                            value="{{ $data_pembelian->nm_pembeli }}" disabled>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="no_hp" class="col-sm-2 col-form-label">Nomor
                        HP</label>
                    <div class="col-sm-10">
                        <input type="text" name="no_hp" class="form-control" id="no_hp"
                            value="{{ $data_pembelian->no_hp }}" disabled>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" name="alamat" class="form-control" id="alamat"
                            value="{{ $data_pembelian->alamat }}" disabled>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="mtd_pembayaran" class="col-sm-2 col-form-label">Metode Pembayaran</label>
                    <div class="col-sm-10">
                        <select class="form-select" aria-label="Default select example" name="mtd_pembayaran"
                            id="mtd_pembayaran" disabled>
                            <option value="{{ $data_pembelian->mtd_pembayaran }}">
                                {{ $data_pembelian->mtd_pembayaran }}</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="id_laptop" class="col-sm-2 col-form-label">ID Laptop</label>
                    <div class="col-sm-10">
                        <select class="form-select" aria-label="Default select example" name="id_laptop" id="id_laptop"
                            disabled>
                            <option selected value="{{ $data_pembelian->id_laptop }}">{{ $data_pembelian->id_laptop }}
                            </option>
                        </select>
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
                            value="{{ $data_pembelian->total_pembayaran }}" disabled>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="status_pembelian" class="col-2 col-form-label">Status Pembelian</label>
                    <div class="col-sm-10">
                        <select class="form-select" aria-label="Default select example" name="status_pembelian"
                            disabled>
                            <option selected value="{{ $data_pembelian->status_pembelian }}">
                                {{ $data_pembelian->status_pembelian }}</option>
                        </select>
                    </div>
                </div>
                <div class="mt-5">
                    <a href="/data-pembelian" class="btn btn-secondary">Kembali</a>
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
    @endpush
</x-layout-pegawai>
