<!DOCTYPE html>
<html lang="en">

@include('layout/header')

<body>
    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner">
                <div class="double-bounce1"></div>
                <div class="double-bounce2"></div>
            </div>
        </div>
    </div>
    <!-- Loader -->

    <div class="page-wrapper landrick-theme toggled">
        @include('layout/sidemenu')
        <!-- sidebar-wrapper  -->

        <!-- Start Page Content -->
        <main class="page-content bg-light">
            <div class="top-header">
                <div class="header-bar d-flex justify-content-between border-bottom">
                    <div class="d-flex align-items-center">
                        <a href="#" class="logo-icon me-3">
                            <img src="../assets/images/logo-icon.png" height="30" class="small" alt="">
                            <span class="big">
                                <img src="../assets/images/logo-dark.png" height="24" class="logo-light-mode"
                                    alt="">
                                <img src="../assets/images/logo-light.png" height="24" class="logo-dark-mode"
                                    alt="">
                            </span>
                        </a>
                        <a id="close-sidebar" class="btn btn-icon btn-soft-light" href="javascript:void(0)">
                            <i class="ti ti-menu-2"></i>
                        </a>
                    </div>

                    <ul class="list-unstyled mb-0">
                        @include('layout/profile')
                    </ul>
                </div>
            </div>
            @include('layout/profileshow')

            <div class="container-fluid">
                <div class="layout-specing">

                    <div class="row">
                        <div class="col-12 mt-4">
                            <div class="card border-0 rounded shadow p-4">
                                <h3 class="mb-4">List Absensi</h3>
                                <div class="text-end">
                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#addAbsensi"
                                        class="btn btn-primary mb-4"><span class="text-light">
                                            <i data-feather="plus" class="fea" style="width: 20px;"></i>
                                        </span></a>
                                </div>
                                <div class="modal fade" id="addAbsensi" tabindex="-1" aria-labelledby="LoginForm-title"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content rounded shadow border-0">
                                            <div class="modal-header border-bottom">
                                                <h5 class="modal-title" id="LoginForm-title">Add Absensi</h5>
                                                <button type="button" class="btn btn-icon btn-close"
                                                    data-bs-dismiss="modal" id="close-modal"><i
                                                        class="uil uil-times fs-4 text-dark"></i></button>
                                            </div>
                                            <form action="{{ route('absensi.store') }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="bg-white p-3 rounded box-shadow">
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1"
                                                                class="form-label">Tanggal Absen</label>
                                                            <input type="date"
                                                                class="form-control @error('tgl_absen') is-invalid @enderror"
                                                                id="exampleFormControlInput1" name="tgl_absen">
                                                            @error('tgl_absen')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col">
                                                                <label for="exampleFormControlInput1"
                                                                    class="form-label">Mulai</label>
                                                                <input type="time"
                                                                    class="form-control @error('time_start') is-invalid @enderror"
                                                                    id="exampleFormControlInput1" name="time_start">
                                                                @error('time_start')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="col">
                                                                <label for="exampleFormControlInput1"
                                                                    class="form-label">Selesai</label>
                                                                <input type="time"
                                                                    class="form-control @error('time_end') is-invalid @enderror"
                                                                    id="exampleFormControlInput1" name="time_end">
                                                                @error('time_end')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="">
                                                            <label for="exampleFormControlInput1"
                                                                class="form-label @error('keterangan') is-invalid @enderror">Keterangan</label>
                                                            <select class="form-select" name="keterangan"
                                                                aria-label="Default select example">
                                                                <option disabled selected>---Pilih Keterangan---
                                                                </option>
                                                                <option value="buka">Buka</option>
                                                                <option value="tutup">Tutup</option>
                                                            </select>
                                                            @error('keterangan')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <table id="example" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th style="max-width: 200px">Tanggal Absen</th>
                                            <th style="max-width: 100px" class="text-center">Mulai</th>
                                            <th style="max-width: 100px" class="text-center">Selesai</th>
                                            <th style="max-width: 200px" class="text-center">Keterangan</th>
                                            <th style="max-width: 200px" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($absensis as $absensi)
                                            <tr>
                                                <td>{{ $absensi->tgl_absen }}</td>
                                                <td class="text-center">{{ $absensi->time_start }}</td>
                                                <td class="text-center">{{ $absensi->time_end }}</td>
                                                <td class="text-center">
                                                    @if ($absensi->keterangan == 'buka')
                                                        <span class="badge rounded-pill bg-success">Buka</span>
                                                    @else
                                                        <span class="badge rounded-pill bg-danger">Tutup</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <div>
                                                        <a href="{{ route('absensi.show', $absensi->id_absensi) }}" role="button" style="border: none; background: none;"
                                                            title="Show Absensi" data-bs-toggle="tooltip"
                                                            data-bs-placement="bottom">
                                                            <span class="text-success me-2">
                                                                <i data-feather="eye" class="fea icon-sm"> </i>
                                                            </span>
                                                        </a>
                                                        <button style="border: none; background: none;"
                                                            onclick="handleEditAbsensi('{{ $absensis }}', '{{ $absensi->id_absensi }}')"
                                                            title="Edit Absensi" data-bs-toggle="tooltip"
                                                            data-bs-placement="bottom">
                                                            <span class="text-primary me-2">
                                                                <i data-feather="edit" class="fea icon-sm"> </i>
                                                            </span>
                                                        </button>
                                                        <button style="border: none; background: none;"
                                                            onclick="handleDeleteAbsensi('{{ $absensi->id_absensi }}')"
                                                            title="Delete Absensi" data-bs-toggle="tooltip"
                                                            data-bs-placement="bottom">
                                                            <span class="text-danger">
                                                                <i data-feather="trash" class="fea icon-sm"> </i>
                                                            </span>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot hidden>
                                        <tr>
                                            <th>Tanggal Absen</th>
                                            <th>Mulai</th>
                                            <th>Selesai</th>
                                            <th>Keterangan</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->

                </div>

                <div class="modal fade" id="showPegawai" tabindex="-1" aria-labelledby="LoginForm-title"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content rounded shadow border-0">
                            <div class="modal-header border-bottom">
                                <h5 class="modal-title" id="LoginForm-title">Detail Pegawai</h5>
                                <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal"
                                    id="close-modal"><i class="uil uil-times fs-4 text-dark"></i></button>
                            </div>
                            <div class="modal-body">
                                <div class="bg-white p-1 rounded box-shadow">
                                    <div class="col text-center mb-4">
                                        <img id="foto_show" style="width: 150px; height: 150px;"
                                            class="avatar avatar-md-sm rounded-circle border shadow" alt="">
                                    </div>
                                    <div class="form-group d-flex align-items-baseline gap-3">
                                        <label class="control-label mb-0" style="width: 25%;" for="nip_show">Nama
                                            Lengkap</label>
                                        <div>:</div>
                                        <div>
                                            <input type="text" class="form-control-plaintext"
                                                style="width: 300px;" id="nama_show" disabled readonly>
                                        </div>
                                    </div>
                                    <div class="form-group d-flex align-items-baseline gap-3">
                                        <label class="control-label mb-0" style="width: 25%;"
                                            for="nama_unit_show">Email</label>
                                        <div>:</div>
                                        <div>
                                            <input type="text" class="form-control-plaintext"
                                                style="width: 300px;" id="email_show" disabled readonly>
                                        </div>
                                    </div>
                                    <div class="form-group d-flex align-items-baseline gap-3">
                                        <label class="control-label mb-0" style="width: 25%;"
                                            for="nama_pegawai_show">Nomor Telepon</label>
                                        <div>:</div>
                                        <div>
                                            <input type="text" class="form-control-plaintext"
                                                style="width: 300px;" id="nomor_telepon_show" disabled readonly>
                                        </div>
                                    </div>
                                    <div class="form-group d-flex align-items-baseline gap-3">
                                        <label class="control-label mb-0" style="width: 25%;"
                                            for="email_pegawai_show">Alamat</label>
                                        <div>:</div>
                                        <div>
                                            <textarea type="text" class="form-control-plaintext" rows="1" style="width: 300px; resize: none;"
                                                id="alamat_show" disabled readonly></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group d-flex align-items-baseline gap-3">
                                        <label class="control-label mb-0" style="width: 25%;"
                                            for="role_show">Role</label>
                                        <div>:</div>
                                        <div>
                                            <input type="text" name="role" class="form-control-plaintext"
                                                style="width: 300px;" id="role_show" disabled readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="editAbsensi" tabindex="-1" aria-labelledby="LoginForm-title"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content rounded shadow border-0">
                            <div class="modal-header border-bottom">
                                <h5 class="modal-title" id="LoginForm-title">Edit Absensi</h5>
                                <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal"
                                    id="close-modal"><i class="uil uil-times fs-4 text-dark"></i></button>
                            </div>
                            <form action="{{ route('absensi.update', 1) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="bg-white p-3 rounded box-shadow">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Tanggal
                                                Absen</label>
                                            <input type="date"
                                                class="form-control @error('tgl_absen') is-invalid @enderror"
                                                id="tgl_absen_put" name="tgl_absen">
                                            @error('tgl_absen')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <label for="exampleFormControlInput1" class="form-label">Mulai</label>
                                                <input type="time"
                                                    class="form-control @error('time_start') is-invalid @enderror"
                                                    id="time_start_put" name="time_start">
                                                @error('time_start')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col">
                                                <label for="exampleFormControlInput1"
                                                    class="form-label">Selesai</label>
                                                <input type="time"
                                                    class="form-control @error('time_end') is-invalid @enderror"
                                                    id="time_end_put" name="time_end">
                                                @error('time_end')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="">
                                            <label for="exampleFormControlInput1"
                                                class="form-label @error('keterangan') is-invalid @enderror">Keterangan</label>
                                            <select id="keterangan_put" class="form-select" name="keterangan"
                                                aria-label="Default select example">
                                                <option disabled selected>---Pilih Keterangan---</option>
                                                <option value="buka">Buka</option>
                                                <option value="tutup">Tutup</option>
                                            </select>
                                            @error('keterangan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <input type="hidden" name="id_absensi" id="id_absensi_put">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="deleteAbsensi" tabindex="-1" aria-labelledby="LoginForm-title"
                    aria-hidden="true">
                    <form action="{{ route('absensi.delete') }}" method="post">
                        @csrf
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content rounded shadow border-0">
                                <div class="modal-header border-bottom">
                                    <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal"
                                        id="close-modal"><i class="uil uil-times fs-4 text-dark"></i></button>
                                </div>
                                <div class="modal-body text-center">
                                    <div class="bg-white p-3 rounded box-shadow">
                                        <input type="hidden" name="id_absensi" id="id_absensi_delete">
                                        <h3 class="judul mb-3">Delete Absensi</h3>
                                        <div id="content-delete"></div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--end container-->

            <!-- Footer Start -->
            @include('layout/footer')
            <!--end footer-->
            <!-- End -->
        </main>
        <!--End page-content" -->
    </div>
    <!-- page-wrapper -->

    <!-- Offcanvas Start -->
    <div class="offcanvas offcanvas-end bg-white shadow" tabindex="-1" id="offcanvasRight"
        aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header border-bottom">
            <h5 id="offcanvasRightLabel" class="mb-0">
                <img src="../assets/images/logo-dark.png" height="24" class="light-version" alt="">
                <img src="../assets/images/logo-light.png" height="24" class="dark-version" alt="">
            </h5>
            <button type="button" class="btn-close d-flex align-items-center text-dark" data-bs-dismiss="offcanvas"
                aria-label="Close"><i class="mdi mdi-close fs-4"></i></button>
        </div>
        <div class="offcanvas-body p-4 px-md-5">
            <div class="row">
                <div class="col-12">
                    <!-- Style switcher -->
                    <div id="style-switcher">
                        <div>
                            <ul class="text-center list-unstyled mb-0">
                                <li class="d-grid"><a href="javascript:void(0)" class="rtl-version t-rtl-light"
                                        onclick="setTheme('style-rtl')"><img src="../assets/images/demos/rtl.png"
                                            class="img-fluid rounded-md shadow-md d-block" alt=""><span
                                            class="text-muted mt-2 d-block">RTL Version</span></a></li>
                                <li class="d-grid"><a href="javascript:void(0)" class="ltr-version t-ltr-light"
                                        onclick="setTheme('style')"><img src="../assets/images/demos/ltr.png"
                                            class="img-fluid rounded-md shadow-md d-block" alt=""><span
                                            class="text-muted mt-2 d-block">LTR Version</span></a></li>
                                <li class="d-grid"><a href="javascript:void(0)" class="dark-rtl-version t-rtl-dark"
                                        onclick="setTheme('style-dark-rtl')"><img
                                            src="../assets/images/demos/dark-rtl.png"
                                            class="img-fluid rounded-md shadow-md d-block" alt=""><span
                                            class="text-muted mt-2 d-block">RTL Version</span></a></li>
                                <li class="d-grid"><a href="javascript:void(0)" class="dark-ltr-version t-ltr-dark"
                                        onclick="setTheme('style-dark')"><img src="../assets/images/demos/dark.png"
                                            class="img-fluid rounded-md shadow-md d-block" alt=""><span
                                            class="text-muted mt-2 d-block">LTR Version</span></a></li>
                                <li class="d-grid"><a href="javascript:void(0)" class="dark-version t-dark mt-4"
                                        onclick="setTheme('style-dark')"><img src="../assets/images/demos/dark.png"
                                            class="img-fluid rounded-md shadow-md d-block" alt=""><span
                                            class="text-muted mt-2 d-block">Dark Version</span></a></li>
                                <li class="d-grid"><a href="javascript:void(0)" class="light-version t-light mt-4"
                                        onclick="setTheme('style')"><img src="../assets/images/demos/ltr.png"
                                            class="img-fluid rounded-md shadow-md d-block" alt=""><span
                                            class="text-muted mt-2 d-block">Light Version</span></a></li>
                                <li class="d-grid"><a href="../landing/index.html" target="_blank"
                                        class="mt-4"><img src="../assets/images/demos/landing.png"
                                            class="img-fluid rounded-md shadow-md d-block" alt=""><span
                                            class="text-muted mt-2 d-block">Landing Demos</span></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- end Style switcher -->
                </div>
                <!--end col-->
            </div>
        </div>

        <div class="offcanvas-footer p-3 border-top text-center">
            <ul class="list-unstyled social-icon mb-0">
                <li class="list-inline-item mb-0"><a href="https://1.envato.market/landrick" target="_blank"
                        class="rounded"><i class="ti ti-shopping-cart align-middle" title="Buy Now"></i></a></li>
                <li class="list-inline-item mb-0"><a href="https://dribbble.com/shreethemes" target="_blank"
                        class="rounded"><i class="ti ti-brand-dribbble align-middle" title="dribbble"></i></a></li>
                <li class="list-inline-item mb-0"><a href="https://www.facebook.com/shreethemes" target="_blank"
                        class="rounded"><i class="ti ti-brand-facebook align-middle" title="facebook"></i></a></li>
                <li class="list-inline-item mb-0"><a href="https://www.instagram.com/shreethemes/" target="_blank"
                        class="rounded"><i class="ti ti-brand-instagram align-middle" title="instagram"></i></a></li>
                <li class="list-inline-item mb-0"><a href="https://twitter.com/shreethemes" target="_blank"
                        class="rounded"><i class="ti ti-brand-twitter align-middle" title="twitter"></i></a></li>
                <li class="list-inline-item mb-0"><a href="mailto:support@shreethemes.in" class="rounded"><i
                            class="ti ti-mail align-middle" title="email"></i></a></li>
                <li class="list-inline-item mb-0"><a href="https://shreethemes.in" target="_blank"
                        class="rounded"><i class="ti ti-world align-middle" title="website"></i></a></li>
            </ul>
            <!--end icon-->
        </div>
    </div>
    <!-- Offcanvas End -->

    @include('layout/js')
    <script src="{{ asset('storage/assets/js/admin/absensi.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>


    @include('sweetalert::alert')
</body>

</html>
