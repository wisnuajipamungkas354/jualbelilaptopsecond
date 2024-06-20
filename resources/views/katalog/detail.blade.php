<x-layouts>
    <!--- Menangkap Variabel title yang dikirim dari routes untuk ditampilkan di layouts --->
    <x-slot:title>{{ $title }}</x-slot:title>
    <main class="container">
        <div class="d-flex flex-column gap-2 justify-content-start flex-md-row gap-md-2 justify-content-md-between">
            <section id="detail-image">
                <div id="carouselExampleIndicators" class="carousel slide">
                    <div class="carousel-inner">
                        @foreach ($foto_produk as $foto)
                            <div class="carousel-item">
                                <img src="{{ asset('storage/' . $foto->path) }}" class="image-carousel" alt="Foto Produk">
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                    <div class="carousel-indicators">
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($foto_produk as $foto)
                            <button type="button" data-bs-target="#carouselExampleIndicators"
                                class="btn-{{ $i }}">
                                <img src="{{ asset('storage/' . $foto->path) }}" class="img-thumbnail" alt="">
                            </button>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    </div>
                </div>
            </section>
            <section id="detail-description">
                <div>
                    <h4>{{ $laptop->merk . ' ' . $laptop->tipe . ' ' . $laptop->processor . ' ' . 'RAM ' . $laptop->memory . ' ' . $laptop->storage }}
                    </h4>
                    <span class="badge text-bg-success">Grade {{ $laptop->grade }}</span>
                    <h1>Rp {{ number_format($laptop->harga, 0, ',') }}</h1>
                    <hr>
                </div>
                <div>
                    <h5>Detail Produk</h5>
                    <hr>
                    <table>
                        <tr>
                            <td>Platform </td>
                            <td>:</td>
                            <td> {{ $laptop->platform }}</td>
                        </tr>
                        <tr>
                            <td>Merk </td>
                            <td>:</td>
                            <td> {{ $laptop->merk }}</td>
                        </tr>
                        <tr>
                            <td>Tipe </td>
                            <td>:</td>
                            <td> {{ $laptop->tipe }}</td>
                        </tr>
                        <tr>
                            <td>Processor </td>
                            <td>:</td>
                            <td> {{ $laptop->processor }}</td>
                        </tr>
                        <tr>
                            <td>RAM </td>
                            <td>:</td>
                            <td> {{ $laptop->memory }}</td>
                        </tr>
                        <tr>
                            <td>Storage </td>
                            <td> :</td>
                            <td> {{ $laptop->storage }}</td>
                        </tr>
                        <tr>
                            <td>Ukuran Layar</td>
                            <td>:</td>
                            <td> {{ $laptop->uk_layar }} Inch</td>
                        </tr>
                        <tr>
                            <td>Touchscreen</td>
                            <td>:</td>
                            <td> {{ $laptop->is_touchscreen }}</td>
                        </tr>
                        <tr>
                            <td>Grade</td>
                            <td>:</td>
                            <td> A</td>
                        </tr>
                        <tr>
                            <td>Catatan</td>
                            <td>:</td>
                            <td> {{ $laptop->info_tambahan }}</td>
                        </tr>
                        <tr>
                            <td>Kelengkapan</td>
                            <td>:</td>
                            <td> {{ $laptop->kelengkapan }}</td>
                        </tr>
                        <tr>
                            <td>Garansi</td>
                            <td>:</td>
                            <td> 1 Bulan</td>
                        </tr>
                        <tr>
                            <td>Minus</td>
                            <td>:</td>
                        </tr>
                        <tr>
                            <td>
                                <ol>
                                    @foreach ($laptop->minus as $m)
                                        <li>{{ $m }}</li>
                                    @endforeach
                                </ol>
                            </td>
                        </tr>
                    </table>
                </div>
            </section>

            <!-- Section Atur Jumlah
        Section ini akan hilang ketika display width < 768px
        Section ini akan muncul ketika display width >= 768px
        -->
            <section id="detail-aside">
                <div class="card rounded-4">
                    <div class="card-body">
                        <b>Atur Jumlah</b>
                        <!-- Kolom Tambah Item dan Stok -->
                        <form action="/pembayaran/{{ $laptop->id_laptop }}" method="GET">
                            <div class="my-2 d-flex flex-row flex-wrap flex-lg-nowrap gap-2 align-items-center">
                                <div class="d-flex flex-row flex-wrap p-1 border border-outline-secondary rounded-5"
                                    style="width: 55%;">
                                    <button type="button" class="bg-transparent text-dark d-inline-block btn-decrease"
                                        style="border: none; width:25%;"><i class="bi bi-dash-lg"></i></button>
                                    <input id="totalBarang" class="d-inline-block text-center" name="totalbarang"
                                        type="number" value="1" minlength="1">
                                    <button type="button"
                                        class="bg-transparent border-none d-inline-block btn-increase"
                                        style="border: none; width:25%;"><i class="bi bi-plus-lg"></i></button>
                                </div>
                                <div>
                                    <span class="text-secondary">Stok : </span><b
                                        class="stok">{{ $laptop->stok }}</b>
                                </div>
                            </div>
                            <div class="d-flex flex-row flex-nowrap justify-content-between pb-2">
                                <span class="text-secondary">Sub Total</span>
                                <span><b class="total-harga" data-harga={{ $laptop->harga }}>Rp
                                        {{ number_format($laptop->harga, 0, ',') }}</b></span>
                            </div>
                            <div class="d-flex flex-column flex-nowrap gap-2">
                                <a href="/keranjang/{{ $laptop->id_laptop }}/add" class="btn btn-primary rounded-3">+
                                    Keranjang</a>
                                <button type="submit" class="btn btn-outline-success rounded-3">Beli Langsung</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <footer class="fixed-bottom bg-light p-2 d-md-none">
        <section class="container">
            <div class="d-flex flex-row flex-nowrap gap-2">
                <a href="/keranjang/{{ $laptop->id_laptop }}/add"
                    class="btn btn-primary rounded-3 flex-grow-1 order-2">+ Keranjang</a>
                <a href="{{ url('/pembayaran/' . $laptop->id_laptop) }}"
                    class="btn btn-outline-success rounded-3 flex-grow-1 order-1">Beli
                    Langsung
                </a>
            </div>
        </section>
    </footer>
    @push('customscript')
        <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                var countButton = $('.carousel-indicators button').length;

                for (i = 0; i <= countButton; i++) {
                    $(`.carousel-indicators button.btn-${i}`).attr('data-bs-slide-to', `${i-1}`);
                    $(`.carousel-indicators button.btn-${i}`).attr('aria-label', `Slide ${i}`);
                }

                $('.carousel-inner div:first-child').toggleClass('active');
                $('.carousel-indicators button:first-child').toggleClass('active')
                $('.carousel-indicators button:first-child').attr('aria-current', 'true');

                var valStok = $('.stok').html();
                var valTotal = $('#totalBarang').val();
                var valHarga = $('.total-harga').data('harga');
                var valHargaTotal;
                $('.btn-increase').click(function() {
                    if (valStok == 1) {
                        $('#totalBarang').attr('disabled', 'disabled');
                    } else if (valTotal < valStok) {
                        valTotal++;
                        $('#totalBarang').val(valTotal);
                        $('#totalBarang').attr('maxlength', valStok);
                        valHargaTotal = valHarga * valTotal;
                        varHargaTotal = new Intl.NumberFormat().format(valHargaTotal);
                        $('.total-harga').html('Rp ' + varHargaTotal);
                    } else if (valTotal == valStok) {
                        $('#totalBarang').attr('maxlength', valStok);
                    }
                })

                $('.btn-decrease').click(function() {
                    if (valStok == 1) {
                        $('#totalBarang').attr('disabled', 'disabled');
                    } else if (valTotal > 1) {
                        valTotal--;
                        $('#totalBarang').val(valTotal);
                        valHargaTotal = valHarga * valTotal;
                        varHargaTotal = new Intl.NumberFormat().format(valHargaTotal);
                        $('.total-harga').html('Rp ' + varHargaTotal);
                    }
                })
            })
        </script>
    @endpush
</x-layouts>
