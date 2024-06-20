<x-layouts>
    <x-slot:title>{{ $title }}</x-slot:title>
    <main class="container">
        <section class="my-3">
            <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="5000">
                        <img src="{{ asset('img/carousel1.jpg') }}" class="d-block w-100"
                            alt="Banner Jual Beli Laptop Second 1">
                    </div>
                    <div class="carousel-item" data-bs-interval="5000">
                        <img src="{{ asset('img/carousel2.jpg') }}" class="d-block w-100"
                            alt="Banner Jual Beli Laptop Second 2">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </section>
        <section class="d-flex flex-wrap gap-2 justify-content-evenly">
            @foreach ($data_laptop as $laptop)
                <a href="{{ url('/detail/' . $laptop->id_laptop) }}" class="text-decoration-none card-link-hover">
                    <div class="card card-item">
                        <img src="{{ asset('storage/' . $foto_produk[$laptop->id_laptop]->path) }}"
                            class="card-img-top image-card" alt="...">
                        <div class="card-body">
                            <p class="card-text">
                                {{ $laptop->merk . ' ' . $laptop->tipe . ' ' . $laptop->processor }}
                            </p>
                            <h5 class="card-title">Rp {{ number_format($laptop->harga, 0, ',') }}</h5>
                            <span class="badge rounded-pill text-bg-success">Grade {{ $laptop->grade }}</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </section>
        <!--- Tag Aside --->
        <x-aside-link></x-aside-link>
        @if (session('success'))
            <x-modal-success>{{ session('success') }}</x-modal-success>
        @endif
        @if (session('loginSuccess'))
            <x-modal-success>{{ session('loginSuccess') }}</x-modal-success>
            @push('customscript')
                <script>
                    Swal.fire({
                        template: "#modal-success"
                    });
                </script>
            @endpush
        @endif
        @if (session('logoutSuccess'))
            <x-modal-success>{{ session('logoutSuccess') }}</x-modal-success>
        @endif
    </main>
</x-layouts>
