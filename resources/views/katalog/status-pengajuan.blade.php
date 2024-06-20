<x-layouts>
    <!--- Menangkap Variabel title yang dikirim dari routes untuk ditampilkan di layouts --->
    <x-slot:title>{{ $title }}</x-slot:title>
    <main class="container">
        <h2 class="mb-4">{{ $title }}</h2>
        <div class="d-flex flex-column flex-nowrap gap-2 justify-content-between">
            <section class="d-flex flex-column w-100">
                @foreach ($data_pengajuan as $barang)
                    <a href="{{ url('/progres-transaksi/' . $barang->id_pengajuan) }}"
                        class="d-block text-decoration-none text-dark">
                        <div class="pembelian-item shadow-sm mb-2">
                            <img src="{{ asset('storage/' . $foto_barang[$barang->id_pengajuan]->path) }}"
                                class="img-fluid rounded-start" alt="...">
                            <div class="pembelian-item-content">
                                <span class="pembelian-tanggal">
                                    <p class="m-0">Pengajuan Jual {{ $barang->platform }}</p>
                                    <p class="m-0">{{ $date[$barang->id_pengajuan] }}</p>
                                </span>
                                <div class="pembelian-content">
                                    <span class="text-decoration-none text-dark fw-semibold pembelian-judul">
                                        {{ $barang->merk . ' ' . $barang->tipe . ' ' . $barang->processor . ' ' . $barang->memory . ' ' . $barang->storage }}
                                    </span>
                                    <p class="p-0 m-0 d-block text-body-secondary">{{ $barang->jml_barang }} Barang</p>
                                    <p class="p-0 m-0 d-block text-body-secondary">Harga Pengajuan : Rp
                                        {{ number_format($barang->harga, 0, ',') }}</p>
                                </div>
                                <span
                                    class="badge 
                                    @if ($barang->status_pengajuan == 'Menunggu Konfirmasi') text-bg-warning 
                                    @elseif ($barang->status_pengajuan == 'Pengajuan Diterima') 
                                    text-bg-success
                                    @elseif ($barang->status_pengajuan == 'Pengajuan Ditolak') text-bg-danger
                                    @elseif ($barang->status_pengajuan == 'Driver Menuju Lokasi') text-bg-dark 
                                    @elseif ($barang->status_pengajuan == 'Pengajuan Selesai') text-bg-success ) @endif status-pembelian">{{ $barang->status_pengajuan }}</span>
                            </div>
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
                    <a href="{{ url('/notifikasi') }}" class="btn btn-secondary rounded-3 order-2 p-2 w-100">
                        Kembali</a>
                </div>
            </div>
        </section>
    </footer>
    <x-modal-hapus></x-modal-hapus>
    @if (session('success'))
        <x-modal-success>{{ session('success') }}</x-modal-success>
    @endif
    @if (session('error'))
        <x-modal-failed>{{ session('error') }}</x-modal-failed>
    @endif
    @push('customscript')
        <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
        @if (session('success'))
            <script>
                Swal.fire({
                    template: "#modal-success"
                });
            </script>
        @endif
    @endpush
</x-layouts>
