<aside class="aside-pegawai bg-dark">
    <div class="p-3">
        <div
            class="d-flex flex-row flex-md-column justify-content-end justify-content-md-start p-3 bg-dark mb-3 header-aside">
            <h5 class="text-white fw-medium d-none d-md-inline-block"><img src="{{ asset('img/logo.png') }}" alt=""
                    style="max-width:30px; max-height: 30px; margin-right: 10px"> Zafran
                Laptop
            </h5>
            <a href="#" class="btn-navbar icon-widget text-white d-inline d-md-none"><i class="bi bi-list"></i></a>
        </div>
        <div class="d-flex flex-column gap-2">
            <a href="/dashboard"
                class="btn-aside {{ Request::is('dashboard*') ? 'active' : '' }} d-none d-md-inline-block"><i
                    class="icon-sidebar bi bi-speedometer2"></i>
                Dashboard</a>
            @canany(['admin', 'owner'])
                <a href="/data-laptop"
                    class="btn-aside {{ Request::is('data-laptop*') ? 'active' : '' }} d-none d-md-inline-block"><i
                        class="icon-sidebar bi bi-laptop"></i> Data
                    Laptop</a>
                <a href="/data-pembelian"
                    class="btn-aside {{ Request::is('data-pembelian*') ? 'active' : '' }} d-none d-md-inline-block"
                    btn-show><i class="icon-sidebar bi bi-bag-check"></i> Data Pembelian</a>
            @endcanany
            @can('owner')
                <a href="/data-pengajuan"
                    class="btn-aside {{ Request::is('data-pengajuan*') ? 'active' : '' }} d-none d-md-inline-block"><i
                        class="icon-sidebar bi bi-cash"></i> Data Pengajuan</a>
                <a href="/data-user"
                    class="btn-aside {{ Request::is('data-user*') ? 'active' : '' }} d-none d-md-inline-block"><i
                        class="icon-sidebar bi bi-people"></i> Data User</a>
            @endcan
            @canany(['admin', 'owner'])
                <a href="/riwayat-transaksi"
                    class="btn-aside {{ Request::is('riwayat-transaksi*') ? 'active' : '' }} d-none d-md-inline-block"><i
                        class="icon-sidebar bi bi-wallet"></i>
                    Riwayat Transaksi</a>
                <a href="/data-laporan"
                    class="btn-aside {{ Request::is('data-laporan*') ? 'active' : '' }} d-none d-md-inline-block"><i
                        class="icon-sidebar bi bi-journal-check"></i>
                    Laporan</a>
            @endcanany
            @can('driver')
                <a href="/data-antar"
                    class="btn-aside {{ Request::is('data-antar*') ? 'active' : '' }} d-none d-md-inline-block"><i
                        class="icon-sidebar bi bi-box-seam"></i>
                    Antar Barang </a>
                <a href="/data-ambil"
                    class="btn-aside {{ Request::is('data-ambil*') ? 'active' : '' }} d-none d-md-inline-block"><i
                        class="icon-sidebar bi bi-cursor"></i>
                    Ambil Barang </a>
            @endcan
        </div>
    </div>
    <div class="w-100 d-flex flex-column justify-content-center text-center p-3 profile-account">
        <img src="{{ asset('img/person-circle.svg') }}" alt=""
            class="rounded-circle bg-white d-none d-md-block" style="width: 50px; margin: auto;">
        <p class="mt-2 d-none d-md-inline text-white"><b>{{ auth()->user()->nm_user }}</b><br>
            {{ auth()->user()->role }}</p>
        <form action="{{ url('/logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger d-none d-md-inline-block w-100"><i
                    class="bi bi-box-arrow-right"></i>
                Logout</button>
        </form>
    </div>
</aside>

@push('Custom Script')
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.btn-navbar').click(function() {
                $('.btn-aside').toggleClass('d-none');
                $('.btn-logout').toggleClass('d-none');
                $('.aside-pegawai').toggleClass('show-navbar');
            });
        });
    </script>
@endpush
