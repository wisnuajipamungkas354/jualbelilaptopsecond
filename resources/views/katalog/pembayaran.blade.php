<x-layouts>
    <!--- Menangkap Variabel title yang dikirim dari routes untuk ditampilkan di layouts --->
    <x-slot:title>{{ $title }}</x-slot:title>
    <form action="/pembayaran/{{ $laptop->id_laptop }}/bayar" method="POST">
        @csrf
        <main class="container">
            <h2>Beli Langsung</h2>
            <div class="d-flex flex-row flex-nowrap gap-2 justify-content-center">
                <section class="w-100 w-md-75">
                    <div class="alert alert-primary w-100" role="alert">
                        <span class="mx-2"><i class="bi bi-exclamation-triangle-fill"></i></span>
                        <span>Ini adalah halaman terakhir dari proses belanjamu, Pastikan semua sudah benar ya!</span>
                    </div>
                    <div class="card-pembayaran-barang mb-5">
                        <h5>Barang yang dibeli</h5>
                        <div class="card mb-3 flex-row justify-content-between">
                            <img src="{{ asset('storage/' . $foto_produk->path) }}" class="img-thumbnail rounded-start"
                                alt="...">
                            <div class="card-body">
                                <h5 class="card-title">
                                    {{ $laptop->merk . ' ' . $laptop->tipe . ' ' . $laptop->processor . ' ' . 'RAM ' . $laptop->memory . ' ' . $laptop->storage }}
                                </h5>
                                <h5 class="card-text">Rp {{ number_format($laptop->harga, 0, ',') }}</h5>
                                <div class="d-flex flex-row justify-content-start align-items-center gap-3 w-100">
                                    <div
                                        class="d-flex flex-row flex-wrap p-1 border border-outline-secondary rounded-5 m-0">
                                        <button type="button"
                                            class="bg-transparent text-dark d-inline-block btn-decrease"
                                            style="border: none; width:25%;"><i class="bi bi-dash-lg"></i></button>
                                        <input id="totalBarang" class="d-inline-block text-center" type="number"
                                            name="jmlBarang" value="{{ $jml_pembelian }}" minlength="1">
                                        <button type="button"
                                            class="bg-transparent border-none d-inline-block btn-increase"
                                            style="border: none; width:25%;"><i class="bi bi-plus-lg"></i></button>
                                    </div>
                                    <span class="text-secondary align-self-center">Stok : <b
                                            class="stok">{{ $laptop->stok }}</b></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-pengiriman-barang">
                        <h5>Pembayaran dan Pengiriman</h5>
                        <div class="card mb-3">
                            <div class="card-body">
                                <section class="w-100">
                                    <span class="text-center d-block"><b>Alamat</b></span>
                                    <hr>
                                    <button type="button" class="btn-alamat" data-bs-toggle="modal"
                                        data-bs-target="#modalAlamat">
                                        <div class="d-flex flex-column justify-content-between w-100 position-relative">
                                            <span class="d-block mb-1 text-start">
                                                <span class="badge rounded-pill text-bg-success">Penerima</span>
                                                {{ auth()->user()->nm_user }}
                                                - {{ auth()->user()->no_hp }}</span>
                                            <span
                                                class="d-block text-start span-alamat">{{ auth()->user()->alamat }}</span>
                                            <span class="position-absolute top-0 end-0 fs-5"><i
                                                    class="bi bi-pencil-square"></i></span>
                                            <input type="text" name="alamat" class="input-alamat"
                                                value="{{ auth()->user()->alamat }}" hidden>
                                        </div>
                                    </button>
                                </section>
                                <hr>
                                <section class="w-100 d-flex flex-column justify-content-center gap-3">
                                    <span class="text-center d-block"><b>Metode Pembayaran</b></span>
                                    <hr class="m-0">
                                    <div
                                        class="metode-pembayaran-item d-flex flex-row flex-wrap gap-3 justify-content-center">
                                        <button type="button" class="btn-pembayaran shadow-sm"
                                            data-name-payment="GOPAY">
                                            <img src="{{ asset('img/gopay.png') }}" alt="">
                                        </button>
                                        <button type="button" class="btn-pembayaran shadow-sm" data-name-payment="BCA">
                                            <img src="{{ asset('img/bca.png') }}" alt="">
                                        </button>
                                        <button type="button" class="btn-pembayaran shadow-sm" data-name-payment="BRI">
                                            <img src="{{ asset('img/bri.png') }}" alt="">
                                        </button>
                                        <button type="button" class="btn-pembayaran shadow-sm" data-name-payment="BSI">
                                            <img src="{{ asset('img/bsi.png') }}" alt="">
                                        </button>
                                        <button type="button" class="btn-pembayaran shadow-sm" data-name-payment="OVO">
                                            <img src="{{ asset('img/ovo.png') }}" alt="">
                                        </button>
                                        <button type="button" class="btn-pembayaran shadow-sm"
                                            data-name-payment="QRIS">
                                            <img src="{{ asset('img/qris.png') }}" alt="">
                                        </button>
                                        <input type="text" name="metodePembayaran" class="inputMetodePembayaran"
                                            value="" hidden>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="detail-aside" class="w-25">
                    <div class="card rounded-4">
                        <div class="card-body">
                            <b>Rincian Belanja</b>
                            <!-- Kolom Tambah Item dan Stok -->
                            <div class="d-flex flex-row flex-nowrap justify-content-between pb-2">
                                <span class="text-secondary">Sub Total</span>
                                <span name="total_harga" value="10000"><b class="total-harga"
                                        data-harga={{ $laptop->harga }}>Rp
                                        {{ number_format($total_harga, 0, ',') }}</b></span>
                                <input type="text" name="totalHarga" class="inputTotalHarga"
                                    value="{{ $laptop->harga }}" hidden>
                            </div>
                            <div class="d-flex flex-column flex-nowrap gap-2">
                                <button type="submit" class="btn btn-success rounded-3"><i
                                        class="bi bi-bag-check"></i>
                                    Bayar</button>
                            </div>

                        </div>
                    </div>
                </section>
            </div>
        </main>
        <footer class="fixed-bottom bg-light p-2 d-md-none">
            <section class="container">
                <div class="d-flex flex-row flex-nowrap gap-2">
                    <div class="flex-grow-1">
                        <p>
                            Total Bayar <br>
                            <b class="total-harga">Rp {{ number_format($total_harga, 0, ',') }}</b>
                        </p>
                    </div>
                    <div class="flex-grow-1 d-flex justify-content-center align-items-center">
                        <button class="btn btn-success rounded-3 order-2 p-2 w-100"><i class="bi bi-bag-check"></i>
                            Bayar</button>
                    </div>
                </div>
            </section>
        </footer>
    </form>
    <!-- Modal -->
    <div class="modal fade" id="modalAlamat" tabindex="-1" aria-labelledby="modalAlamatLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalAlamatLabel">Ubah Alamat</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="ubahAlamat">Alamat</label>
                    <textarea class="form-control" name="ubahAlamat" id="ubahAlamat" rows="3">{{ auth()->user()->alamat }}</textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-warning btn-ubah" data-bs-dismiss="modal">Ubah</button>
                </div>
            </div>
        </div>
    </div>
    @if (session('error'))
        <x-modal-failed>{{ session('error') }}</x-modal-failed>
    @endif
    @push('customscript')
        @if (session('error'))
            <script>
                Swal.fire({
                    template: "#modal-failed"
                });
            </script>
        @endif
        <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                // Metode Pembayaran Click ----------------------------------------
                $('.btn-pembayaran').click(function() {
                    var namePayment = $(this).data('name-payment');
                    $('.btn-pembayaran').removeClass('active');
                    $(this).addClass('active');
                    $('.inputMetodePembayaran').val(namePayment);
                })

                // Input Jumlah Barang yang akan dibeli ----------------------------
                var valStok = $('.stok').html();
                var valTotal = $('#totalBarang').val();
                var valHarga = $('.total-harga').data('harga');
                var valHargaTotal;
                var valHargaTotalFormatted;
                $('.btn-increase').click(function() {
                    if (valStok == 1) {
                        $('#totalBarang').attr('disabled', 'disabled');
                    } else if (valTotal < valStok) {
                        valTotal++;
                        $('#totalBarang').val(valTotal);
                        $('#totalBarang').attr('maxlength', valStok);
                        valHargaTotal = valHarga * valTotal;
                        valHargaTotalFormatted = new Intl.NumberFormat().format(valHargaTotal);
                        $('.inputTotalHarga').val(valHargaTotal);
                        $('.total-harga').html('Rp ' + valHargaTotalFormatted);
                    } else if (valTotal == valStok) {
                        $('#totalBarang').attr('maxlength', valStok);
                    }
                })

                $('.btn-decrease').click(function() {
                    if (valStok == 1) {
                        $('#totalBarang').attr('disabled', 'disabled');
                    } else if (valTotal > 1) {
                        valTotal--;
                        valHargaTotal = valHarga * valTotal;
                        varHargaTotal = new Intl.NumberFormat().format(valHargaTotal);
                        $('#totalBarang').val(valTotal);
                        $('.total-harga').html('Rp ' + varHargaTotal);
                    }
                })

                // Ubah Alamat -----------------------------------------------------
                $('.btn-ubah').click(function() {
                    var textUbahAlamat = $('#ubahAlamat').val();
                    $('.span-alamat').html(textUbahAlamat);
                    $('.input-alamat').val(textUbahAlamat);
                })
            })
        </script>
    @endpush
</x-layouts>
