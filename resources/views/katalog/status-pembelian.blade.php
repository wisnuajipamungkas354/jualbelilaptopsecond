<x-layouts>
    <!--- Menangkap Variabel title yang dikirim dari routes untuk ditampilkan di layouts --->
    <x-slot:title>{{ $title }}</x-slot:title>
    <main class="container">
        <h2 class="mb-4">{{ $title }}</h2>
        <div class="d-flex flex-column flex-nowrap gap-2 justify-content-between">
            <section class="d-flex flex-column w-100">
                @foreach ($data_pembelian as $barang)
                    <a href="{{ url('/progres-transaksi/' . $barang->id_pembelian) }}"
                        class="d-block text-decoration-none text-dark">
                        <div class="pembelian-item shadow-sm mb-2">
                            <img src="{{ asset('storage/' . $foto_barang[$barang->id_laptop]->path) }}"
                                class="img-fluid rounded-start" alt="...">
                            <div class="pembelian-item-content">
                                <span class="pembelian-tanggal">
                                    <p class="m-0">Pembelian {{ $laptop[$barang->id_laptop]->platform }}</p>
                                    <p class="m-0">{{ $date[$barang->id_laptop] }}</p>
                                </span>
                                <div class="pembelian-content">
                                    <span class="text-decoration-none text-dark fw-semibold pembelian-judul">
                                        {{ $laptop[$barang->id_laptop]->merk . ' ' . $laptop[$barang->id_laptop]->tipe . ' ' . $laptop[$barang->id_laptop]->processor . ' ' . $laptop[$barang->id_laptop]->memory . ' ' . $laptop[$barang->id_laptop]->storage }}
                                    </span>
                                    <p class="p-0 m-0 d-block text-body-secondary">{{ $barang->jml_barang }} Barang</p>
                                    <p class="p-0 m-0 d-block text-body-secondary">Total Belanja : Rp
                                        {{ number_format($barang->total_pembayaran, 0, ',') }}</p>
                                </div>
                                <span
                                    class="badge 
                                    @if ($barang->status_pembelian == 'Menunggu Konfirmasi') text-bg-warning 
                                    @elseif ($barang->status_pembelian == 'Diproses Admin') 
                                    text-bg-info
                                    @elseif ($barang->status_pembelian == 'Dalam Pengiriman') text-bg-dark
                                    @elseif ($barang->status_pembelian == 'Diterima Pembeli') text-bg-success
                                    @elseif ($barang->status_pembelian == 'Dibatalkan Pembeli') text-bg-danger @endif status-pembelian">{{ $barang->status_pembelian }}</span>
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
    @push('customscript')
        <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    @endpush
</x-layouts>
