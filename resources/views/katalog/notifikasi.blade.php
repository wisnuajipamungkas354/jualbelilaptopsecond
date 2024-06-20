<x-layouts>
    <!--- Menangkap Variabel title yang dikirim dari routes untuk ditampilkan di layouts --->
    <x-slot:title>{{ $title }}</x-slot:title>
    <main class="container">
        <div class="mb-3">
            <h2 class="mb-4">{{ $title }}</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Notifikasi</li>
                </ol>
            </nav>
            <section class="bg-light p-2 w-100 w-md-75 d-flex flex-row flex-nowrap gap-3">
                <a href="{{ url('/status-pembelian') }}"
                    class="btn @if ($status_pembelian == 0) btn-outline-secondary
                    @elseif ($status_pembelian > 0)
                    btn-outline-success @endif btn-control-notifikasi"><i
                        class="bi bi-bag-check"></i>
                    Status Pembelian <span class="badge text-bg-danger">{{ $status_pembelian }}</span></a>
                <a href="{{ url('/status-pengajuan') }}"
                    class="btn @if ($status_pengajuan == 0) btn-outline-secondary
                    @elseif ($status_pengajuan > 0)
                    btn-outline-success @endif btn-control-notifikasi"><i
                        class="bi bi-laptop"></i> Status
                    Pengajuan <span class="badge text-bg-danger">{{ $status_pengajuan }}</span></a>
            </section>
        </div>
        <div class="d-flex flex-column flex-nowrap gap-2 justify-content-between">
            <h3>Terbaru</h3>
            <section class="d-flex flex-column w-100 w-md-75">
                @foreach ($notifikasi as $pesan)
                    <a href="{{ url('/progres-transaksi/' . $pesan->id_trx) }}" class="d-block text-decoration-none">
                        <div
                            class="card mb-3 position-relative shadow-sm @if ($pesan->is_read == 'Belum') bg-body-secondary @elseif ($pesan->is_read == 'Sudah') bg-white @endif">
                            <div class="card-body">
                                <h5 class="card-title"><i class="bi bi-bag-check"></i> {{ $pesan->jenis_trx }}</h5>
                                <p class="card-text">{{ $pesan->pesan }}</p>
                            </div>
                            @if ($pesan->is_read == 'Belum')
                                <span
                                    class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                                    <span class="visually-hidden">New alerts</span>
                                </span>
                            @endif
                        </div>
                    </a>
                @endforeach
            </section>
        </div>
    </main>
    <footer class="fixed-bottom bg-light p-2 d-md-none">
        <section class="container">
            <div class="d-flex flex-row flex-nowrap gap-2">
                <div class="flex-grow-1 d-flex justify-content-center align-items-center">
                    <a href="{{ url('/') }}" class="btn btn-secondary rounded-3 order-2 p-2 w-100">
                        Dashboard</a>
                </div>
            </div>
        </section>
    </footer>
    <x-modal-hapus></x-modal-hapus>
    @push('customscript')
        <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    @endpush
</x-layouts>
