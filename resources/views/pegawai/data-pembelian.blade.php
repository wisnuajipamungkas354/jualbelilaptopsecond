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
                <table id="table-laptop" class="display table table-sm table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nama Pembeli</th>
                            <th>ID Barang</th>
                            <th>Metode</th>
                            <th>Total Bayar</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_pembelian as $pembelian)
                            <tr>
                                <td>{{ $pembelian->id_pembelian }}</td>
                                <td>{{ $pembelian->nm_pembeli }}</td>
                                <td><a
                                        href="{{ url('/data-laptop/laptop-detail/' . $pembelian->id_laptop) }}">{{ $pembelian->id_laptop }}</a>
                                </td>
                                <td>{{ $pembelian->mtd_pembayaran }}</td>
                                <td class="text-end">Rp {{ number_format($pembelian->total_pembayaran, 0, ',') }}
                                <td>{{ $pembelian->status_pembelian }}</td>
                                </td>
                                <td>
                                    <a href="/data-pembelian/pembelian-detail/{{ $pembelian->id_pembelian }}"
                                        class="badge text-bg-primary badge-table"><i class="bi bi-info-circle"></i></a>
                                    @if ($pembelian->status_pembelian != 'Dalam Pengiriman')
                                        <a href="/data-pembelian/pembelian-edit/{{ $pembelian->id_pembelian }}"
                                            class="badge text-bg-warning badge-table"><i
                                                class="bi bi-pencil-square"></i></a>
                                    @elseif($pembelian->status_pembelian == 'Dalam Pengiriman')
                                        <a href="#" class="badge badge-table disabled" tabindex="-1"
                                            role="button" aria-disabled="true"><i class="bi bi-pencil-square"></i></a>
                                    @endif
                                    <a href="" class="badge text-bg-danger badge-table btn-hapus"
                                        data-bs-toggle="modal" data-bs-target="#modal-hapus"
                                        data-id="{{ $pembelian->id_pembelian }}"><i class="bi bi-trash"></i></a>
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
    {{-- <x-modal-hapus></x-modal-hapus> --}}
    @push('Custom Script')
        <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
        <script
            src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.7/b-3.0.2/b-colvis-3.0.2/b-html5-3.0.2/b-print-3.0.2/date-1.5.2/datatables.min.js">
        </script>
        <script>
            new DataTable('#table-laptop', {
                layout: {
                    topStart: {
                        buttons: [],
                        @can('owner')
                            pageLength: {
                                menu: [10, 25, 50, 100],
                            }
                        @endcan
                    }
                }
            });
            @can('admin')
                $('.dt-buttons.btn-group.flex-wrap').prepend(
                    '<a class="btn btn-success" href="/data-pembelian/pembelian-tambah"><i class="bi bi-plus-circle"></i></a>'
                );
            @endcan

            $('.btn-hapus').click(function() {
                $('.form-hapus').attr('action', '/data-pembelian/' + $(this).data('id') + '/hapus');
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
