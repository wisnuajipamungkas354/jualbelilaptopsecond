<header class="shadow-sm bg-body-tertiary">
    <nav class="navbar">
        <div class="container-fluid flex-nowrap">
            <a href="/" class="navbar-brand d-none d-md-inline fs-5">{{ $slot }}</a>
            <div class="search-box">
                <form action="/">
                    <input class="form-control" type="search" name="search" id="search" placeholder="Cari Laptop"
                        aria-label="Search" value="{{ request('search') }}">
                </form>
            </div>
            <div class="d-flex flex-row gap-2 align-items-center">
                @auth
                    <a href="{{ url('/jual-laptop') }}" class="p-1 rounded-circle icon-widget"><i
                            class="bi bi-currency-dollar"></i></a>
                    <a href="{{ url('/notifikasi') }}"
                        class="icon-widget p-1 rounded-circle position-relative notification">
                        <i class="bi bi-bell"></i>
                        <span class="position-absolute bg-danger border border-light rounded-circle badge-notification">
                            <span class="visually-hidden">New alerts</span>
                        </span>
                    </a>
                    <a href="{{ url('/keranjang') }}" class="p-1 rounded-circle position-relative icon-widget">
                        <i class="bi bi-cart-plus"></i>
                        <span class="position-absolute bg-danger border border-light rounded-circle badge-notification">
                            <span class="visually-hidden">New alerts</span>
                        </span>
                    </a>
                @endauth
                <div class="d-none d-md-flex justify-content-center align-items-center gap-2 profile">
                    @auth
                        <a class="link-profile" href="#">
                            <img src="{{ asset('img/person-circle.svg') }}" alt="" class="icon-profile">
                            <span>{{ auth()->user()->nm_user }}</span>
                        </a>
                    @else
                        <a href="/login" class="text-dark d-none d-md-inline">Login</a>
                        <a href="/registration" class="text-dark d-none d-md-inline">Daftar</a>
                    @endauth
                </div>
                <a class="d-inline d-md-none" data-bs-toggle="offcanvas" data-bs-target="#aside"><i
                        class="bi bi-list text-dark icon-widget"></i></a>
            </div>
        </div>
    </nav>
</header>
@auth
    <x-profile-hover></x-profile-hover>
    <div class="bg-collapse hide"></div>
@endauth

@push('customscript')
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script>
        $('.link-profile').click(function() {
            $('.collapse-user').toggleClass('hide');
            $('.bg-collapse').toggleClass('hide');
            $('body').toggleClass('overflow-hidden');
        })

        $('.cart').click(function() {
            $('.collapse-cart').toggleClass('hide');
            $('.bg-collapse').toggleClass('hide');
            $('body').toggleClass('overflow-hidden');
        })
    </script>
@endpush
