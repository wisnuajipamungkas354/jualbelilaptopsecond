<section>
    <!-- Modal -->
    <div class="modal fade" id="modalDaftar" tabindex="-1" aria-labelledby="modalDaftarTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalDaftarTitle">Daftar Akun Baru</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="mb-3">
                            <label for="namaLengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="namaLengkap" placeholder="Nama Lengkap Kamu"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat Lengkap</label>
                            <input type="textarea" class="form-control" id="alamat" placeholder="Dusun x RT/RW ..."
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="noHp" class="form-label">Nomor HP</label>
                            <input type="text" class="form-control" id="nomorHp" placeholder="085xxxxx..."
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Email Aktif"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Password Akun"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="confirmPassword"
                                placeholder="Konfirmasi Password" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Daftar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
