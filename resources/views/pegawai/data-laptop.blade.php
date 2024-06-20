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
                            <th>Merk</th>
                            <th>Tipe</th>
                            <th>Grade</th>
                            <th>Processor</th>
                            <th>Memory</th>
                            <th>Harga</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($database as $laptop)
                            <tr>
                                <td>{{ $laptop->id_laptop }}</td>
                                <td>{{ $laptop->merk }}</td>
                                <td>{{ $laptop->tipe }}</td>
                                <td class="text-center">
                                    @if ($laptop->grade == 'A')
                                        <span class="badge text-bg-success">{{ $laptop->grade }}</span>
                                    @elseif ($laptop->grade == 'B')
                                        <span class="badge text-bg-primary">{{ $laptop->grade }}</span>
                                    @elseif ($laptop->grade == 'C')
                                        <span class="badge text-bg-warning">{{ $laptop->grade }}</span>
                                    @elseif ($laptop->grade == 'D')
                                        <span class="badge text-bg-danger">{{ $laptop->grade }}</span>
                                    @endif
                                </td>
                                <td>{{ $laptop->processor }}</td>
                                <td>{{ $laptop->memory }}</td>
                                <td>Rp {{ number_format($laptop->harga, 0, ',') }}</td>
                                <td>
                                    <a href="/data-laptop/laptop-detail/{{ $laptop->id_laptop }}"
                                        class="badge text-bg-primary badge-table"><i class="bi bi-info-circle"></i></a>
                                    <a href="/data-laptop/laptop-edit/{{ $laptop->id_laptop }}"
                                        class="badge text-bg-warning badge-table"><i
                                            class="bi bi-pencil-square"></i></a>
                                    <a href="" class="badge text-bg-danger badge-table btn-hapus"
                                        data-bs-toggle="modal" data-bs-target="#modal-hapus"
                                        data-id="{{ $laptop->id_laptop }}"><i class="bi bi-trash"></i></a>
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
                        pageLength: {
                            menu: [10, 25, 50, 100]
                        }
                    },
                    topEnd: {
                        search: {}
                    },
                    top2Start: {
                        buttons: [{
                                extend: 'pdf',
                                text: '<i class="bi bi-file-earmark-pdf-fill"></i> Pdf',
                                className: 'btn-danger mb-3'
                            },
                            {
                                extend: 'excel',
                                text: '<i class="bi bi-file-earmark-spreadsheet-fill"></i> Excel',
                                className: 'btn-success mb-3'
                            }

                        ]
                    },
                }
            });

            $('.dt-buttons.btn-group.flex-wrap').prepend(
                '<a class="btn btn-dark mb-3" href="/data-laptop/laptop-tambah"><i class="bi bi-plus-circle"></i></a>'
            );

            $('.btn-hapus').click(function() {
                $('.form-hapus').attr('action', 'data-laptop/hapus/' + $(this).data('id'));
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
