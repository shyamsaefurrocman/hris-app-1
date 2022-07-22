<div class="modal fade" id="showAdmin" tabindex="-1" aria-labelledby="LoginForm-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded shadow border-0">
            <div class="modal-header border-bottom">
                <h5 class="modal-title" id="LoginForm-title">Detail Pegawai</h5>
                <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal"><i
                        class="uil uil-times fs-4 text-dark"></i></button>
            </div>
            <div class="modal-body">
                <div class="bg-white p-1 rounded box-shadow">
                    <div class="col text-center mb-4">
                        @if (Auth::user()->foto != null)
                            <img style="width: 150px; height: 150px;"
                                src="{{ asset('storage/foto/' . Auth::user()->foto) }}"
                                class="avatar avatar-md-sm rounded-circle border shadow" alt="">
                        @else
                            <img style="width: 150px; height: 150px;" src="{{ asset('storage/foto/user.png') }}"
                                class="avatar avatar-md-sm rounded-circle border shadow" alt="">
                        @endif
                    </div>
                    <div class="form-group d-flex align-items-baseline gap-3">
                        <label class="control-label mb-0" style="width: 25%;" for="nip_show">Nama
                            Lengkap</label>
                        <div>:</div>
                        <div>
                            <input type="text" class="form-control-plaintext" style="width: 300px;"
                                id="nama_admin_show" disabled readonly>
                        </div>
                    </div>
                    <div class="form-group d-flex align-items-baseline gap-3">
                        <label class="control-label mb-0" style="width: 25%;" for="nama_unit_admin_show">Email</label>
                        <div>:</div>
                        <div>
                            <input type="text" class="form-control-plaintext" style="width: 300px;"
                                id="email_admin_show" disabled readonly>
                        </div>
                    </div>
                    <div class="form-group d-flex align-items-baseline gap-3">
                        <label class="control-label mb-0" style="width: 25%;" for="nama_pegawai_admin_show">Nomor
                            Telepon</label>
                        <div>:</div>
                        <div>
                            <input type="text" class="form-control-plaintext" style="width: 300px;"
                                id="nomor_telepon_admin_show" disabled readonly>
                        </div>
                    </div>
                    <div class="form-group d-flex align-items-baseline gap-3">
                        <label class="control-label mb-0" style="width: 25%;"
                            for="email_pegawai_admin_show">Alamat</label>
                        <div>:</div>
                        <div>
                            <textarea type="text" class="form-control-plaintext" rows="1" style="width: 300px; resize: none;"
                                id="alamat_admin_show" disabled readonly></textarea>
                        </div>
                    </div>
                    <div class="form-group d-flex align-items-baseline gap-3">
                        <label class="control-label mb-0" style="width: 25%;" for="role_admin_show">Role</label>
                        <div>:</div>
                        <div>
                            <input type="text" name="role" class="form-control-plaintext" style="width: 300px;"
                                id="role_admin_show" disabled readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button"
                            onclick="handleEditAdmin('{{ $pegawais }}', '{{ Auth::user()->id_user }}')"
                            class="btn btn-primary">Edit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editAdmin" tabindex="-1" aria-labelledby="LoginForm-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded shadow border-0">
            <div class="modal-header border-bottom">
                <h5 class="modal-title" id="LoginForm-title">Edit Pegawai</h5>
                <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal"><i
                        class="uil uil-times fs-4 text-dark"></i></button>
            </div>
            <form action="{{ route('pegawai.update', 1) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="bg-white p-3 rounded box-shadow">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Nama
                                Lengkap</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                id="nama_admin_put" placeholder="Nama Lengkap" name="nama">
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1"
                                class="form-label @error('email') is-invalid @enderror">Email</label>
                            <input type="email" class="form-control" id="email_admin_put"
                                placeholder="name@example.com" name="email">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1"
                                class="form-label @error('nomor_telepon') is-invalid @enderror">Nomor
                                Telepon</label>
                            <input type="number" class="form-control" id="nomor_telepon_admin_put"
                                placeholder="08xxxxxxxxx" name="nomor_telepon">
                            @error('nomor_telepon')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1"
                                class="form-label @error('alamat') is-invalid @enderror">Alamat</label>
                            <textarea type="text" name="alamat" class="form-control" id="alamat_admin_put" rows="4"></textarea>
                            @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1"
                                class="form-label @error('role') is-invalid @enderror">Role</label>
                            <select class="form-select" name="role" aria-label="Default select example"
                                id="role_admin_put">
                                <option selected>---Pilih Role---</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Foto Profil</label>
                            <input class="form-control" name="foto" type="file" id="formFile">
                            <div id="emailHelp" class="form-text"><span class="text-danger">*</span>Format file :
                                jpg, jpeg, png</div>
                        </div>
                        <input type="hidden" name="id_user" id="id_user_admin_put">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
