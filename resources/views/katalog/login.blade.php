@push('customcss')
    <link rel="stylesheet" href="{{ asset('css/sign-in.css') }}">
@endpush

<x-layouts>
    <x-slot:title>{{ $title }}</x-slot:title>
    <main class="form-signin">
        <form action="{{ url('/login') }}" method="post">
            <img class="mb-4" src="{{ asset('img/logo.png') }}" alt="" width="120" height="120">
            <h1 class="h3 mb-3 fw-normal text-center">ZAFRAN LAPTOP</h1>
            @csrf
            <div class="form-floating">
                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                    name="email" placeholder="Email" autofocus required>
                <label for="email">Username</label>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                    required>
                <label for="password">Password</label>
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
            <p class="mt-5 mb-3 text-muted text-center">&copy; Laptop Second Bekasi 2024</p>
        </form>
        @if (session('loginError'))
            <x-modal-failed>{{ session('loginError') }}</x-modal-failed>
        @endif
        @if (session('registerSuccess'))
            <x-modal-success>{{ session('registerSuccess') }}</x-modal-success>
        @endif
    </main>
</x-layouts>
