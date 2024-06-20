<div class="bg-white shadow-md collapse-user hide d-none d-md-block">
    <div class="d-flex flex-row justify-content-center align-items-center gap-2 w-100 mb-3">
        <img src="{{ asset('img/person-circle.svg') }}" alt="" class="icon-profile">
        <span>{{ auth()->user()->nm_user }}</span>
    </div>
    <a class="collapse-item" href="/edit-akun">Edit Akun</a>
    <form action="/logout" method="POST">
        @csrf
        <button type="submit" class="collapse-item">Logout</button>
    </form>
</div>
