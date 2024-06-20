<x-layout-pegawai>
    <x-slot:title>{{ $title }}</x-slot:title>
    <section class="content">
        <h1 class="text-dark py-2 border-bottom border-secondary mb-3">{{ $title }}</h1>
        <div class="card">
            <div class="card-body">
                <form action="{{ url('/data-user/user-tambah') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <label for="role" class="col-sm-2 col-form-label">Role</label>
                        <div class="col-sm-10">
                            <select class="form-select" name="role">
                                <option selected value="Owner">Owner</option>
                                <option value="Admin">Admin</option>
                                <option value="Driver">Driver</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="nm_user" class="col-sm-2 col-form-label">Nama User</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('nm_user') is-invalid @enderror"
                                name="nm_user" id="nm_user" value="{{ old('nm_user') }}">
                            @error('nm_user')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="no_hp" class="col-sm-2 col-form-label">No HP</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                name="no_hp" id="no_hp" value="{{ old('no_hp') }}">
                            @error('no_hp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                name="alamat" id="alamat" value="{{ old('alamat') }}">
                            @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" id="email" value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" id="password" value="{{ old('password') }}">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="verify_password" class="col-sm-2 col-form-label">Konfirmasi Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control @error('verify_password') is-invalid @enderror"
                                name="verify_password" id="verify_password" value="{{ old('verify_password') }}">
                            @error('verify_password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-5">
                        <a href="/data-user" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-success">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <x-modal-failed>{{ session('error') }}</x-modal-failed>
    @push('Custom Script')
        <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
        <script>
            var num = 1;
            $(document).ready(function() {
                $('#btn-minus').click(function() {
                    $('#minus').append(
                        `<div class="minus-item mb-3 d-flex flex-row flex-nowrap gap-1 justify-content-start">
                                <input type="text" class="form-control d-inline-block w-75" name="minus[]" id="minus[${num}]" placeholder="Minus ${num}">
                                <div class="w-25">
                                    <button id="btn1" type="button" class="d-inline-block btn btn-danger btn-hapus"><i class="bi bi-trash"></i></button>
                                </div>
                        </div>`
                    )
                    num++;
                })

                $('#minus').on('click', '.btn-hapus', function() {
                    num--;
                    $(this).closest('div.minus-item').remove();
                });

                $('#verify_password').on('keyup', function() {
                    if ($(this).val() == $('#password').val()) {
                        $(this).removeClass('is-invalid');
                        $('#password').addClass('is-valid');
                        $(this).addClass('is-valid');
                    } else if ($(this).val() != $('#password').val()) {
                        $(this).addClass('is-invalid');
                    }
                });
            });
        </script>
    @endpush
</x-layout-pegawai>
