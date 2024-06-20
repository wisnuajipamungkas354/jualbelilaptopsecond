<x-layout-pegawai>
    <x-slot:title>{{ $title }}</x-slot:title>
    @push('Custom CSS')
        <link
            href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.7/b-3.0.2/b-colvis-3.0.2/b-html5-3.0.2/b-print-3.0.2/date-1.5.2/datatables.min.css"
            rel="stylesheet">
    @endpush

    <section class="content">
        <h1 class="text-dark py-2 border-bottom border-secondary mb-3"> {{ $title }}</h1>
        <div class="card shadow">
            <div class="card-body">
                <table id="table-pengajuan" class="display table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nama Penjual</th>
                            <th>Merk</th>
                            <th>Tipe</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengajuan as $pn)
                            <tr>
                                <td>{{ $pn->id_pengajuan }}</td>
                                <td>{{ $pn->nm_penjual }}</td>
                                <td>{{ $pn->merk }}</td>
                                <td>{{ $pn->tipe }}</td>
                                <td class="text-end">Rp {{ number_format($pn->harga, 0, ',') }}</td>
                                <td>{{ $pn->status_pengajuan }}</td>
                                <td>
                                    <a href="/data-pengajuan/pengajuan-detail/{{ $pn->id_pengajuan }}"
                                        class="badge text-bg-primary badge-table"><i class="bi bi-info-circle"></i></a>
                                    <a href="/data-pengajuan/pengajuan-edit/{{ $pn->id_pengajuan }}"
                                        class="badge text-bg-warning badge-table"><i
                                            class="bi bi-pencil-square"></i></a>
                                    <a href="" class="badge text-bg-danger badge-table btn-hapus"
                                        data-bs-toggle="modal" data-bs-target="#modal-hapus"
                                        data-id="{{ $pn->id_pengajuan }}"><i class="bi bi-trash"></i></a>
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
            new DataTable('#table-pengajuan', {
                layout: {
                    topStart: {
                        buttons: []
                    }
                }
            });

            $('.dt-buttons.btn-group.flex-wrap').prepend(
                '<a class="btn btn-success" href="/data-pengajuan/pengajuan-tambah"><i class="bi bi-plus-circle"></i></a>'
            );

            $('.btn-hapus').click(function() {
                $('.form-hapus').attr('action', '/data-pengajuan/' + $(this).data('id') + '/hapus');
            });
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
