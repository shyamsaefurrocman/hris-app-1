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
                                <h3 class="mb-4">List Absen Pegawai</h3>
                                <h4 class="mb-4 text-end">{{ $tgl_absen->tgl_absen }}</h4>
                                <table id="example" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th style="max-width: 300px">Nama</th>
                                            <th style="max-width: 300px" class="text-center">Keterangan</th>
                                            <th style="max-width: 50px" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($userAbsens as $userAbsen)
                                            <tr>
                                                <td>{{ $userAbsen->nama }}</td>
                                                <td class="text-center">
                                                    @if ($userAbsen->keterangan == 'hadir')
                                                        <span class="badge rounded-pill bg-success">Hadir</span>
                                                    @elseif ($userAbsen->keterangan == 'tidak hadir')
                                                        <span class="badge rounded-pill bg-danger">Tidak Hadir</span>
                                                    @elseif ($userAbsen->keterangan == 'sakit')
                                                        <span class="badge rounded-pill bg-warning">Sakit</span>
                                                    @else
                                                        <span class="badge rounded-pill bg-primary">Izin</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <div>
                                                        <button style="border: none; background: none;"
                                                            onclick="handleEditAbsensiPegawai('{{ $userAbsens }}', '{{ $userAbsen->id_user_absen }}')"
                                                            title="Edit Absensi" data-bs-toggle="tooltip"
                                                            data-bs-placement="bottom">
                                                            <span class="text-primary me-2">
                                                                <i data-feather="edit" class="fea icon-sm"> </i>
                                                            </span>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot hidden>
                                        <tr>
                                            <th>Nama</th>
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

                <div class="modal fade" id="editAbsensi" tabindex="-1" aria-labelledby="LoginForm-title"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content rounded shadow border-0">
                            <div class="modal-header border-bottom">
                                <h5 class="modal-title" id="LoginForm-title">Edit Absen Pegawai</h5>
                                <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal"
                                    id="close-modal"><i class="uil uil-times fs-4 text-dark"></i></button>
                            </div>
                            <form action="{{ route('home.update', 1) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="bg-white p-3 rounded box-shadow">
                                        <div class="">
                                            <label for="exampleFormControlInput1"
                                                class="form-label @error('keterangan') is-invalid @enderror">Keterangan</label>
                                            <select id="keterangan_put" class="form-select" name="keterangan"
                                                aria-label="Default select example">
                                                <option disabled selected>---Pilih Keterangan---</option>
                                                <option value="hadir">Hadir</option>
                                                <option value="tidak hadir">Tidak Hadir</option>
                                                <option value="sakit">Sakit</option>
                                                <option value="izin">Izin</option>
                                            </select>
                                            @error('keterangan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <input type="hidden" name="id_user_absen" id="id_user_absen_put">
                                        <input type="hidden" name="id_absensi" id="id_absensi_put">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
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
