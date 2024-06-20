@push('customcss')
    <link rel="stylesheet" href="{{ asset('css/sign-in.css') }}">
@endpush

<x-layouts>
    <x-slot:title>{{ $title }}</x-slot:title>
    <main class="form-registration">
        <form action="/registration" method="post">
            @csrf
            <h1 class="h3 mb-3 fw-normal text-center">Daftar Akun</h1>
            <div class="form-floating mb-3">
                <input type="text" class="form-control @error('nm_user') is-invalid @enderror" id="nm_user"
                    name="nm_user" placeholder="John Doe" value="{{ old('nm_user') }}" required>
                <label for="nm_user">Nama Lengkap</label>
                @error('nm_user')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp"
                    name="no_hp" placeholder="085xxxx" value="{{ old('no_hp') }}" required>
                <label for="no_hp">Nomor HP</label>
                @error('no_hp')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Perum Mustika ..."
                    value="{{ old('alamat') }}" required>
                <label for="alamat">Alamat Tinggal</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                    name="email" placeholder="name@example.com" value="{{ old('email') }}" required>
                <label for="email">Email address</label>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control @if (session('wrongpassword')) is-invalid @endif"
                    id="password" name="password" placeholder="Password" required>
                <label for="password">Password</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control @if (session('wrongpassword')) is-invalid @endif"
                    id="verify_password" name="verify_password" placeholder="Ketik Ulang Password" required>
                <label for="verify_password">Ketik Ulang Password</label>
                @if (session('wrongpassword'))
                    <div class="invalid-feedback">
                        {{ session('wrongpassword') }}
                    </div>
                @endif
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
        </form>
        <x-aside-link></x-aside-link>
    </main>
</x-layouts>
