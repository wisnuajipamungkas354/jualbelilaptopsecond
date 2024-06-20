<x-layout-pegawai>
    <x-slot:title>{{ $title }}</x-slot:title>

    <section class="content">
        <h1 class="text-dark py-2 border-bottom border-secondary mb-3">
            {{ $title }}
        </h1>
        <section class="d-flex flex-row gap-3 flex-wrap mb-3">
            <div class="card card-dashboard shadow-sm">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 text-body-secondary">Data Laptop</h6>
                    <a @cannot('driver') href="{{ url('/data-laptop') }}" @endcannot class="card-link text-dark"><i
                            class="bi bi-laptop"></i>
                        {{ $total_laptop }}
                        Unit</a>
                </div>
            </div>
            <div class="card card-dashboard shadow-sm">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 text-body-secondary">Terjual</h6>
                    <a href="#" class="card-link text-success"><i class="bi bi-bag-check"></i> 20 Unit</a>
                </div>
            </div>
            <div class="card card-dashboard shadow-sm">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 text-body-secondary">Dibeli</h6>
                    <a href="#" class="card-link"><i class="bi bi-bag-dash"></i> 15 Unit</a>
                </div>
            </div>
            @cannot('driver')
                <div class="card card-dashboard shadow-sm">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-body-secondary">Pemasukan</h6>
                        <a href="#" class="card-link fs-4 text-dark"><i class="bi bi-arrow-down-circle"></i> Rp
                            75.600.000</a>
                    </div>
                </div>
                <div class="card card-dashboard shadow-sm">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-body-secondary">Pengeluaran</h6>
                        <a href="#" class="card-link fs-4 text-danger"><i class="bi bi-arrow-up-circle"></i> Rp
                            30.600.000</a>
                    </div>
                </div>
            @endcannot
            <div class="card card-dashboard shadow-sm">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 text-body-secondary">Pelanggan</h6>
                    <a href="#" class="card-link"><i class="bi bi-people-fill"></i> {{ $total_pelanggan }}</a>
                </div>
            </div>
            <div class="card card-dashboard shadow-sm">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 text-body-secondary">Pegawai</h6>
                    <a href="#" class="card-link"><i class="bi bi-person-badge-fill"></i> {{ $total_pegawai }}</a>
                </div>
            </div>
        </section>
        @cannot('driver')
            <section class="w-100">
                <div class="bg-white p-5">
                    <canvas id="myChart"></canvas>
                </div>
            </section>
        @endcannot
    </section>
    @if (session('success'))
        <x-modal-success>{{ session('success') }}</x-modal-success>
        @push('Custom Script')
            <script>
                Swal.fire({
                    template: "#modal-success"
                });
            </script>
        @endpush
    @endif
    @push('Custom Script')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js"
            integrity="sha512-ZwR1/gSZM3ai6vCdI+LVF1zSq/5HznD3ZSTk7kajkaj4D292NLuduDCO1c/NT8Id+jE58KYLKT7hXnbtryGmMg=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        @cannot('driver')
            <script>
                const ctx = document.getElementById('myChart');

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                        datasets: [{
                                label: 'Pembelian Laptop',
                                data: [12, 15, 14, 17, 20, 15, 10],
                                fill: false,
                                borderColor: '#003CFF',
                                backgroundColor: '#003CFF',
                                tension: 0.3
                            },
                            {
                                label: 'Pengajuan Laptop',
                                data: [5, 10, 12, 15, 8, 3, 13],
                                fill: false,
                                borderColor: '#FF0000',
                                backgroundColor: '#FF000',
                                tension: 0.3
                            },
                        ]
                    }
                });
            </script>
        @endcannot
    @endpush
</x-layout-pegawai>
