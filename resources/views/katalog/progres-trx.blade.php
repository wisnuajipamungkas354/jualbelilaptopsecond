<x-layouts>
    <!--- Menangkap Variabel title yang dikirim dari routes untuk ditampilkan di layouts --->
    <x-slot:title>{{ $title }}</x-slot:title>
    <main class="container progres-pembelian">
        <h2 class="mb-4">{{ $title }}</h2>
        <div class="d-flex flex-column flex-nowrap gap-2 justify-content-between p-3">
            @if ($jenis_transaksi == 'Pembelian')
                <p class="text-body-secondary">No {{ $jenis_transaksi }} : {{ $data_trx->id_pembelian }}</p>
            @elseif ($jenis_transaksi == 'Pengajuan')
                <p class="text-body-secondary">No {{ $jenis_transaksi }} : {{ $data_trx->id_pengajuan }}</p>
            @endif
            <section class="d-flex flex-column w-100 justify-content-center gap-5">
                <img class="img-status-pembelian" src="{{ asset('img/progres-pembelian-proses.svg') }}" alt="">
                @if ($jenis_transaksi == 'Pembelian')
                    <div class="progress my-0" role="progressbar" aria-label="Success example" aria-valuenow="25"
                        aria-valuemin="0" aria-valuemax="100">
                        @if ($data_trx->status_pembelian == 'Menunggu Konfirmasi')
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning"
                                style="width: 25%"></div>
                        @endif
                        @if ($data_trx->status_pembelian == 'Diproses Admin')
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                                style="width: 50%"></div>
                        @endif
                        @if ($data_trx->status_pembelian == 'Dalam Pengiriman')
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-dark"
                                style="width: 75%"></div>
                        @endif
                        @if ($data_trx->status_pembelian == 'Diterima Pembeli')
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                style="width: 100%"></div>
                        @endif
                        @if ($data_trx->status_pembelian == 'Dibatalkan Pembeli')
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger"
                                style="width: 1%"></div>
                        @endif
                    </div>
                    <span class="text-center my-0 fs-5 fw-bolder">{{ $data_trx->status_pembelian }}</span>
                @elseif ($jenis_transaksi == 'Pengajuan')
                    <div class="progress mb-0" role="progressbar" aria-label="Success example" aria-valuenow="25"
                        aria-valuemin="0" aria-valuemax="100">
                        @if ($data_trx->status_pengajuan == 'Menunggu Konfirmasi')
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning"
                                style="width: 25%">
                            </div>
                        @endif
                        @if ($data_trx->status_pengajuan == 'Pengajuan Diterima')
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                style="width: 50%">
                            </div>
                        @endif
                        @if ($data_trx->status_pengajuan == 'Driver Menuju Lokasi')
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                style="width: 75%">
                            </div>
                        @endif
                        @if ($data_trx->status_pengajuan == 'Dalam Pengiriman')
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                style="width: 75%">
                            </div>
                        @endif
                        @if ($data_trx->status_pengajuan == 'Pengajuan Selesai')
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                style="width: 100%">
                            </div>
                        @endif
                        @if ($data_trx->status_pengajuan == 'Pengajuan Ditolak')
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger"
                                style="width: 1%">
                            </div>
                        @endif
                    </div>
                    <span class="text-center fw-bolder">{{ $data_trx->status_pengajuan }}</span>
                @endif
            </section>
        </div>
    </main>
    <footer class="fixed-bottom bg-light p-2 d-md-none">
        <section class="container">
            <div class="d-flex flex-row flex-nowrap gap-2">
                <div class="flex-grow-1 d-flex justify-content-center align-items-center">
                    <a href="{{ url('/status-pembelian') }}" class="btn btn-secondary rounded-3 order-2 p-2 w-100">
                        Kembali</a>
                </div>
            </div>
        </section>
    </footer>
    <x-modal-hapus></x-modal-hapus>
    @push('customscript')
        <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('body').addClass('status-pembelian');
            })
        </script>
    @endpush
</x-layouts>
