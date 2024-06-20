<x-layout-pegawai>
    <x-slot:title>{{ $title }}</x-slot:title>
    @push('Custom CSS')
        <link
            href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.7/b-3.0.2/b-colvis-3.0.2/b-html5-3.0.2/b-print-3.0.2/date-1.5.2/datatables.min.css"
            rel="stylesheet">
    @endpush

    <section class="content">
        <h1 class="text-dark py-2 border-bottom border-secondary mb-3">{{ $title }}</h1>
        <div class="card shadow">
            <div class="card-body">
                <table id="data-pembelian" class="display table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Jenis Transaksi</th>
                            <th>Nomor Transaksi</th>
                            <th>Total Bayar</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi as $trx)
                            <tr>
                                <td>{{ $trx->id }}</td>
                                <td>{{ $trx->jenis_trx }}</td>
                                <td>{{ $trx->id_trx }}</td>
                                <td>{{ number_format($trx->total_trx, 0, ',') }}</td>
                                <td><span
                                        class="badge @if ($trx->status_trx == 'Selesai') text-bg-success
                                    @elseif ($trx->status_trx == 'Pending')
                                    text-bg-warning
                                    @elseif ($trx->status_trx == 'Refund Dana')
                                    text-bg-danger @endif">{{ $trx->status_trx }}</span>
                                </td>
                                <td class="text-center">
                                    <a href="" class="badge text-bg-danger badge-table btn-hapus"
                                        data-bs-toggle="modal" data-bs-target="#modal-hapus"
                                        data-id="{{ $trx->id }}"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                </table>
            </div>
        </div>
    </section>
    <x-modal-hapus></x-modal-hapus>
    @if (session('success'))
        <x-modal-success>{{ session('success') }}</x-modal-success>
    @elseif (session('error'))
        <x-modal-failed>{{ session('error') }}</x-modal-failed>
    @endif
    @push('Custom Script')
        <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
        <script
            src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.7/b-3.0.2/b-colvis-3.0.2/b-html5-3.0.2/b-print-3.0.2/date-1.5.2/datatables.min.js">
        </script>
        <script>
            new DataTable('#data-pembelian', {
                layout: {
                    topStart: {
                        pageLength: {
                            menu: [10, 25, 50, 100]
                        }
                    }
                }
            });

            $('.btn-hapus').click(function() {
                $('.form-hapus').attr('action', '/riwayat-transaksi/hapus/' + $(this).data('id'));
            })
        </script>
        @if (session('success'))
            <script>
                Swal.fire({
                    template: "#modal-success"
                });
            </script>
        @endif
    @endpush
</x-layout-pegawai>
