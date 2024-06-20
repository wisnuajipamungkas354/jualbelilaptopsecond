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
                <table id="table-laporan" class="display table table-sm table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th class="text-center">Pemasukan</th>
                            <th class="text-center">Pengeluaran</th>
                            <th class="text-center">Terjual</th>
                            <th class="text-center">Dibeli</th>
                            <th class="text-center">Total Transaksi</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($laporan as $lap)
                            <tr>
                                <td>{{ $lap->id }}</td>
                                <td class="text-end">Rp {{ number_format($lap->pemasukan, 0, ',') }}</td>
                                <td class="text-end">Rp {{ number_format($lap->pengeluaran, 0, ',') }}</td>
                                <td>{{ $lap->terjual }}</td>
                                <td>{{ $lap->dibeli }}</td>
                                <td>{{ $lap->jml_trx }}</td>
                                <td class="text-center">
                                    <a href="/data-laporan/laporan-detail/{{ $lap->id }}/cetak-pdf"
                                        class="badge text-bg-primary badge-table"><i class="bi bi-info-circle"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
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
            new DataTable('#table-laporan', {
                layout: {
                    topStart: {
                        buttons: [],
                        @can('owner')
                            pageLength: {
                                menu: [10, 25, 50, 100]
                            }
                        @endcan
                    }
                }
            });
            @can('admin')
                $('.dt-buttons.btn-group.flex-wrap').prepend(
                    '<a class="btn btn-dark mb-3" href="/data-laporan/laporan-tambah"><i class="bi bi-plus-circle"></i></a>'
                );

                $('.btn-hapus').click(function() {
                    $('.form-hapus').attr('action', '/data-laporan/' + $(this).data('id') + '/hapus');
                })
            @endcan
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
