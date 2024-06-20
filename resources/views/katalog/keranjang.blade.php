<x-layouts>
    <!--- Menangkap Variabel title yang dikirim dari routes untuk ditampilkan di layouts --->
    <x-slot:title>{{ $title }}</x-slot:title>
    <main class="container">
        <div class="mb-2 mb-md-4">
            <h2 class="mb-4">{{ $title }}</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Keranjang</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex flex-row flex-nowrap gap-2 justify-content-between">
            <section class="d-flex flex-column w-75">
                @if ($is_empty)
                    <div class="alert alert-warning" role="alert">
                        Keranjang kamu masih kosong! <a href="/" class="alert-link">Lihat Katalog</a> untuk
                        memilih
                        Laptop kesayanganmu!
                    </div>
                @else
                    @foreach ($data_cart as $laptop)
                        <div class="cart-item shadow-sm mb-2">
                            <img src="{{ asset('storage/' . $images[$laptop->id_laptop]->path) }}"
                                class="img-fluid rounded-start" alt="...">
                            <div class="p-2">
                                <a href="{{ url('/detail/' . $laptop->id_laptop) }}"
                                    class="text-decoration-none text-dark fs-6 fs-md-5">{{ $laptop->merk . ' ' . $laptop->tipe . ' ' . $laptop->processor . ' ' . $laptop->memory . ' ' . $laptop->storage }}
                                </a>
                                <h5>Rp {{ number_format($laptop->harga, 0, ',') }}</h5>
                            </div>
                            <div class="btn-control-cart">
                                <a href="#" class="btn btn-outline-danger fw-semibold btn-hapus-cart"
                                    data-bs-toggle="modal" data-bs-target="#modal-hapus"
                                    data-id="{{ $laptop->id_laptop }}"><i class="bi bi-trash"></i></a>
                                <a href="{{ url('/pembayaran/' . $laptop->id_laptop) }}"
                                    class="btn btn-outline-success fw-semibold"><i class="bi bi-cart-check"></i>
                                    Checkout</a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </section>
        </div>
    </main>
    <footer class="fixed-bottom bg-light p-2 d-md-none">
        <section class="container">
            <div class="d-flex flex-row flex-nowrap gap-2">
                <div class="flex-grow-1 d-flex justify-content-center align-items-center">
                    <a href="{{ url('/') }}" class="btn btn-secondary rounded-3 order-2 p-2 w-100">
                        Dashboard</a>
                </div>
            </div>
        </section>
    </footer>
    <x-modal-hapus></x-modal-hapus>
    @push('customscript')
        <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                var idLaptop;
                $('.btn-hapus-cart').click(function() {
                    idLaptop = $(this).data('id');
                    $('.form-hapus').attr('action', `/keranjang/${idLaptop}/hapus`);
                })
            })
        </script>
    @endpush
</x-layouts>
