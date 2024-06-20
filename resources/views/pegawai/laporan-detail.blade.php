<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lapsec | {{ $title }}</title>

    <!-- My Own CSS-->
    <link rel="stylesheet" href="{{ public_path('css/style-laporan.css') }}">

</head>

<body>
    <header class="">
        <h1>LAPORAN</h1>
        <h1>PENJUALAN DAN PEMBELIAN</h1>
        <h1>ZAFRAN LAPTOP</h1>
    </header>
    <main>
        <div>
            <div id="table-header">
                <table>
                    <tr>
                        <td colspan="6">Ringkasan</td>
                    </tr>
                    <tr>
                        <th class="header-head">ID Laporan</th>
                        <td class="header-dua">:</td>
                        <td class="header-item">{{ $laporan->id }}</td>
                        <th class="header-head">Terjual</th>
                        <td class="header-dua">:</td>
                        <td class="header-item">{{ $laporan->terjual }} Unit</td>
                    </tr>
                    <tr>
                        <th class="header-head">Bulan</th>
                        <td class="header-dua">:</td>
                        <td class="header-item">Juni 2024</td>
                        <th class="header-head">Dibeli</th>
                        <td class="header-dua">:</td>
                        <td class="header-item">{{ $laporan->dibeli }} Unit</td>
                    </tr>
                    <tr>
                        <th class="header-head">Pemasukan</th>
                        <td class="header-dua">:</td>
                        <td class="header-item">Rp {{ number_format($laporan->pemasukan, 0, ',') }}</td>
                    </tr>
                    <tr>
                        <th class="header-head">Pengeluaran</th>
                        <td class="header-dua">:</td>
                        <td class="header-item">Rp {{ number_format($laporan->pengeluaran, 0, ',') }}</td>
                    </tr>
                </table>
            </div>
            <div class="table-content mb-2">
                <table>
                    <thead>
                        <tr>
                            <td colspan="6">Riwayat Transaksi Pembelian Pelanggan
                            </td>
                        </tr>
                        <tr class="bg-secondary">
                            <th class="text-center border-head">Tanggal</th>
                            <th class="text-center border-head">Jenis Transaksi</th>
                            <th class="text-center border-head">Merk</th>
                            <th class="text-center border-head">Tipe</th>
                            <th class="text-center border-head">Jumlah</th>
                            <th class="text-center border-head">Pemasukan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pembelian as $p)
                            <tr>
                                <td>{{ Carbon\Carbon::parse($date[$p->id_pembelian])->format('Y-m-d') }}</td>
                                <td class="text-center">Pembelian</td>
                                <td>{{ $p->merk }}</td>
                                <td>{{ $p->tipe }}</td>
                                <td class="text-right">{{ $p->jml_barang }} Unit</td>
                                <td class="text-right">Rp {{ number_format($p->total_pembayaran, 0, ',') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-right"><b>Total</b></td>
                            <td class="text-right"><b>{{ $laporan->terjual }} Unit</b></td>
                            <td class="text-right"><b>Rp {{ number_format($laporan->pemasukan, 0, ',') }}</b></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div>
                <table>
                    <thead>
                        <tr>
                            <td colspan="6">Riwayat Transaksi Pengajuan Jual Laptop dari Pelanggan
                            </td>
                        </tr>
                        <tr class="bg-secondary">
                            <th class="text-center border-head">Tanggal</th>
                            <th class="text-center border-head">Jenis Transaksi</th>
                            <th class="text-center border-head">Merk</th>
                            <th class="text-center border-head">Tipe</th>
                            <th class="text-center border-head">Jumlah</th>
                            <th class="text-center border-head">Pengeluaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengajuan as $p)
                            <tr>
                                <td>{{ Carbon\Carbon::parse($date[$p->id_pengajuan])->format('Y-m-d') }}</td>
                                <td class="text-center">Pengajuan</td>
                                <td>{{ $p->merk }}</td>
                                <td>{{ $p->tipe }}</td>
                                <td class="text-right">{{ $p->jml_barang }} Unit</td>
                                <td class="text-right">Rp {{ number_format($p->harga, 0, ',') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-right"><b>Total</b></td>
                            <td class="text-right"><b>{{ $laporan->dibeli }} Unit</b></td>
                            <td class="text-right"><b>Rp {{ number_format($laporan->pengeluaran, 0, ',') }}</b></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </main>
</body>

</html>
