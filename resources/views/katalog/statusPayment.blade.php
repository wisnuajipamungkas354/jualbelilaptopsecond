<x-layouts>
    <x-slot:title>{{ $title }}</x-slot:title>
    <main class="container">
        <section class="sect-success-pembayaran bg-light">
            <div class="d-flex flex-column justify-content-center mb-5">
                <img src="" alt="">
                <h3 class="icon-pembayaran-success text-center text-success"><i class="bi bi-patch-check-fill"></i></h3>
                <h1 class="d-block text-center">Rp {{ number_format($data_pembelian['total_pembayaran'], 0, ',') }}</h1>
                <span class="d-block text-center">Pembayaran Berhasil!</span>
                <span class="d-block text-center">Barang akan diproses oleh Admin!</span>
            </div>
            <div class="d-flex flex-column">
                <table class="mb-3 table table-stripped rounded-1">
                    <thead>
                        <tr>
                            <th colspan="2">Rincian Transaksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Status</td>
                            <td class="text-success text-end"><b>Selesai</b> <i class="bi bi-check-circle-fill"></i>
                            </td>
                        </tr>
                        <tr>
                            <td>Metode Pembayaran</td>
                            <td class="text-end">{{ $data_pembelian['mtd_pembayaran'] }} <img
                                    src="{{ asset('img/qris.png') }}" alt="" style="width: 2rem;"></td>
                        </tr>
                        <tr>
                            <td>Waktu</td>
                            <td class="text-end">{{ $jam }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td class="text-end">{{ $tgl }}</td>
                        </tr>
                        <tr>
                            <td>ID Pembelian</td>
                            <td class="text-end">{{ $data_pembelian['id_pembelian'] }}</td>
                        </tr>
                        <tr>
                            <td>Jumlah</td>
                            <td class="text-end">Rp {{ number_format($data_pembelian['total_pembayaran'], 0, ',') }}
                            </td>
                        </tr>
                        <tr>
                            <td>Biaya Admin</td>
                            <td class="text-end">Gratis</td>
                        </tr>
                        <tr>
                            <td><b>Total</b></td>
                            <td class="text-end"><b>Rp
                                    {{ number_format($data_pembelian['total_pembayaran'], 0, ',') }}</b></td>
                        </tr>
                        <tr>
                            <td colspan="2">Harga tercantum sudah termasuk PPN</td>
                        </tr>
                    </tbody>
                </table>
                <a href="/" class="btn btn-secondary mb-3">Kembali</a>
            </div>
            <div>
                <h6>PT. Laptop Second Bekasi Jaya</h6>
                <h6>085889634432</h6>
                <p>Jalan Pegangsaan Timur No. 7, Karawang Timur, Karawang 41371</p>
            </div>
        </section>
    </main>
    @push('customscript')
        <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('body').addClass('bg-primary');
            });
        </script>
    @endpush
</x-layouts>
