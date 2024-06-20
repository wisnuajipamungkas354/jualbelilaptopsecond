<aside>
    <section>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="aside" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasRightLabel">Laptop Second</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                @auth
                    <div class="d-flex flex-column justify-content-center align-items-center gap-2 w-100 mb-5">
                        <img src="{{ asset('img/person-circle.svg') }}" alt="" class="icon-profile">
                        <h4>{{ auth()->user()->nm_user }}</h4>
                    </div>
                    <hr>
                    <a class="btn-aside d-block" href="">Detail Akun</a>
                    <hr>
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger w-100">Logout</button>
                    </form>
                @else
                    <hr>
                    <a href="/login" class="btn-aside d-block">Login</a>
                    <hr>
                    <a href="/registration" class="btn-aside d-block">Daftar</a>
                    <hr>
                @endauth
            </div>
        </div>
    </section>
</aside>
