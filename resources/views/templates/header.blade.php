<header class="shadow-sm fixed-top">
    <nav class="navbar bg-body-tertiary">
        <div class="container flex-nowrap">
            <!-- Navbar Brand akan hilang ketikda display dibawah < 768px -->
            <a class="navbar-brand d-none d-md-inline">Laptop Second</a>
            <div class="w-custom d-flex flex-row justify-content-center">
                <input id="search-box" class="form-control me-2" type="search" placeholder="Cari Laptop" aria-label="Search">
            </div>
            <div class="d-flex flex-row gap-4 align-items-center">
                <a href=""><i class="bi bi-currency-dollar text-dark icon-widget"></i></a>
                <a href="" class="position-relative">
                    <i class="bi bi-bell text-dark icon-widget"></i>
                    <span class="position-absolute start-100 translate-middle badge badge-custom rounded-pill bg-danger">
                        9+
                        <span class="visually-hidden">unread messages</span>
                    </span>
                </a>
                <a href="" class="position-relative">
                    <i class="bi bi-cart-plus text-dark icon-widget"></i>
                    <span class="position-absolute start-100 translate-middle badge badge-custom rounded-pill bg-danger">
                        9+
                        <span class="visually-hidden">unread messages</span>
                    </span>
                </a>
                <div class="d-flex justify-content-center align-items-center gap-2">
                    <!-- Jika Belum Login, Tampil Teks Login dan Daftar
                    Text akan hilang ketika display width dibawah < 768px --->
                    <a href="" class="text-dark d-none d-md-inline" data-bs-toggle="modal" data-bs-target="#modalLogin">Login</a>
                    <a href="" class="text-dark d-none d-md-inline" data-bs-toggle="modal" data-bs-target="#modalDaftar">Daftar</a>

                    <!-- Jika Sudah Login -->
                    {{-- <button class="btn btn-outline-success icon-profile bg-dark"></button> --}}
                    {{-- <a class="text-profile" href="">Wisnu</a> --}}
                    <!-- Icon List akan muncul ketika display width < 768px -->
                    <a class="d-inline d-md-none" data-bs-toggle="offcanvas" data-bs-target="#aside"><i class="bi bi-list text-dark icon-widget"></i></a>
                </div>
            </div>
        </div>
      </nav>
</header>