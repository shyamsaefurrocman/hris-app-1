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
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted mb-1">Welcome back, {{ Auth::user()->nama }}!</h6>
                            <h5 class="mb-3">Dashboard</h5>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card border-0 rounded shadow p-4">
                                <div class="col d-flex">
                                    <h5>Absensi Sedang Berlangsung</h5>
                                    <div class="col text-end">
                                        <button onclick="handleRekapPresensi()"
                                            class="btn btn-pills btn-outline-primary">
                                            Rekap Absensi </button>
                                    </div>
                                </div>
                                @if ($absen == true)
                                    @if ($absen->keterangan == 'tidak hadir')
                                        <div class="col-md-4 col-12 pt-2">
                                            <div class="alert alert-danger mb-0" role="alert">
                                                <h6 class="mb-1">Presensi hari ini</h6>
                                                <p class="mb-0">{{ $absen->tgl_absen }}</p>
                                                <p class="mb-1">{{ $absen->time_start }} -
                                                    {{ $absen->time_end }}</p>
                                                <h6>Kehadiran Anda : {{ Str::upper($absen->keterangan) }}</h6>
                                                <hr>
                                                <div class="btn-presensi text-end">
                                                    <button
                                                        onclick="handlePresensi('{{ $absen->id_user_absen }}', '{{ $absen->id_absensi }}', '{{ $absen->keterangan }}')"
                                                        class="btn btn-pills btn-outline-secondary">
                                                        Presensi Disini </button>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif ($absen->keterangan == 'hadir')
                                        <div class="col-md-4 col-12 pt-2">
                                            <div class="alert alert-success mb-0" role="alert">
                                                <h6 class="mb-1">Presensi hari ini</h6>
                                                <p class="mb-0">{{ $absen->tgl_absen }}</p>
                                                <p class="mb-1">{{ $absen->time_start }} -
                                                    {{ $absen->time_end }}</p>
                                                <h6 class="mb-0">Kehadiran Anda :
                                                    {{ Str::upper($absen->keterangan) }}</h6>
                                            </div>
                                        </div>
                                    @elseif ($absen->keterangan == 'sakit')
                                        <div class="col-md-4 col-12 pt-2">
                                            <div class="alert alert-warning mb-0" role="alert">
                                                <h6 class="mb-1">Presensi hari ini</h6>
                                                <p class="mb-0">{{ $absen->tgl_absen }}</p>
                                                <p class="mb-1">{{ $absen->time_start }} -
                                                    {{ $absen->time_end }}</p>
                                                <h6 class="mb-0">Kehadiran Anda :
                                                    {{ Str::upper($absen->keterangan) }}</h6>
                                            </div>
                                        </div>
                                    @elseif ($absen->keterangan == 'izin')
                                        <div class="col-md-4 col-12 pt-2">
                                            <div class="alert alert-primary mb-0" role="alert">
                                                <h6 class="mb-1">Presensi hari ini</h6>
                                                <p class="mb-0">{{ $absen->tgl_absen }}</p>
                                                <p class="mb-1">{{ $absen->time_start }} -
                                                    {{ $absen->time_end }}</p>
                                                <h6 class="mb-0">Kehadiran Anda :
                                                    {{ Str::upper($absen->keterangan) }}</h6>
                                            </div>
                                        </div>
                                    @endif
                                @else
                                    <div class="row text-center p-5">
                                        <h6>Tidak ada absensi berlangsung hari ini</h6>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    @if (Auth::user()->role == 'admin')
                        <div class="row">
                            <div class="col-12 mt-4">
                                <div class="card border-0 rounded shadow p-4">
                                    <h5 class="">GeekGarden Software House</h5>
                                    <img src="{{ asset('storage/foto/pegawai.png') }}" alt="">
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    @endif

                    <div class="modal fade" id="rekapAbsensi" tabindex="-1" aria-labelledby="LoginForm-title"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content rounded shadow border-0">
                                <div class="modal-header border-bottom">
                                    <h5 class="modal-title" id="LoginForm-title">Rekap Absensi</h5>
                                    <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal"
                                        id="close-modal"><i class="uil uil-times fs-4 text-dark"></i></button>
                                </div>
                                <div class="modal-body">
                                    <div class="bg-white p-3 rounded box-shadow">
                                        <div class="card rounded shadow border-0 p-4">
                                            <div class="header-chart text-center">
                                                @if (date('m') == 1)
                                                    <b>
                                                        <h5>{{ Str::upper('januari') }}</h5>
                                                    </b>
                                                @elseif (date('m') == 2)
                                                    <b>
                                                        <h5>{{ Str::upper('februari') }}</h5>
                                                    </b>
                                                @elseif (date('m') == 3)
                                                    <b>
                                                        <h5>{{ Str::upper('maret') }}</h5>
                                                    </b>
                                                @elseif (date('m') == 4)
                                                    <b>
                                                        <h5>{{ Str::upper('april') }}</h5>
                                                    </b>
                                                @elseif (date('m') == 5)
                                                    <b>
                                                        <h5>{{ Str::upper('mei') }}</h5>
                                                    </b>
                                                @elseif (date('m') == 6)
                                                    <b>
                                                        <h5>{{ Str::upper('juni') }}</h5>
                                                    </b>
                                                @elseif (date('m') == 7)
                                                    <b>
                                                        <h5>{{ Str::upper('juli') }}</h5>
                                                    </b>
                                                @elseif (date('m') == 8)
                                                    <b>
                                                        <h5>{{ Str::upper('agustus') }}</h5>
                                                    </b>
                                                @elseif (date('m') == 9)
                                                    <b>
                                                        <h5>{{ Str::upper('september') }}</h5>
                                                    </b>
                                                @elseif (date('m') == 10)
                                                    <b>
                                                        <h5>{{ Str::upper('oktober') }}</h5>
                                                    </b>
                                                @elseif (date('m') == 11)
                                                    <b>
                                                        <h5>{{ Str::upper('november') }}</h5>
                                                    </b>
                                                @elseif (date('m') == 12)
                                                    <b>
                                                        <h5>{{ Str::upper('desember') }}</h5>
                                                    </b>
                                                @else
                                                    <h5>Error</h5>
                                                @endif
                                            </div>
                                            <div id="top-product-chart"></div>
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
                                    <h5 class="modal-title" id="LoginForm-title">Input Presensi</h5>
                                    <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal"
                                        id="close-modal"><i class="uil uil-times fs-4 text-dark"></i></button>
                                </div>
                                <form action="{{ route('presensi.update') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="bg-white p-3 rounded box-shadow">
                                            <div class="col text-end">
                                                <h5>{{ now() }}</h5>
                                            </div>
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
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
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
                <img src="{{ asset('storage/assets/images/logo-dark.png') }}" height="24" class="light-version"
                    alt="">
                <img src="{{ asset('storage/assets/images/logo-light.png') }}" height="24" class="dark-version"
                    alt="">
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
                                        onclick="setTheme('style-rtl')"><img
                                            src="{{ asset('storage/assets/images/demos/rtl.png') }}"
                                            class="img-fluid rounded-md shadow-md d-block" alt=""><span
                                            class="text-muted mt-2 d-block">RTL Version</span></a></li>
                                <li class="d-grid"><a href="javascript:void(0)" class="ltr-version t-ltr-light"
                                        onclick="setTheme('style')"><img
                                            src="{{ asset('storage/assets/images/demos/ltr.png') }}"
                                            class="img-fluid rounded-md shadow-md d-block" alt=""><span
                                            class="text-muted mt-2 d-block">LTR Version</span></a></li>
                                <li class="d-grid"><a href="javascript:void(0)" class="dark-rtl-version t-rtl-dark"
                                        onclick="setTheme('style-dark-rtl')"><img
                                            src="{{ asset('storage/assets/images/demos/dark-rtl.png') }}"
                                            class="img-fluid rounded-md shadow-md d-block" alt=""><span
                                            class="text-muted mt-2 d-block">RTL Version</span></a></li>
                                <li class="d-grid"><a href="javascript:void(0)" class="dark-ltr-version t-ltr-dark"
                                        onclick="setTheme('style-dark')"><img
                                            src="{{ asset('storage/assets/images/demos/dark.png') }}"
                                            class="img-fluid rounded-md shadow-md d-block" alt=""><span
                                            class="text-muted mt-2 d-block">LTR Version</span></a></li>
                                <li class="d-grid"><a href="javascript:void(0)" class="dark-version t-dark mt-4"
                                        onclick="setTheme('style-dark')"><img
                                            src="{{ asset('storage/assets/images/demos/dark.png') }}"
                                            class="img-fluid rounded-md shadow-md d-block" alt=""><span
                                            class="text-muted mt-2 d-block">Dark Version</span></a></li>
                                <li class="d-grid"><a href="javascript:void(0)" class="light-version t-light mt-4"
                                        onclick="setTheme('style')"><img
                                            src="{{ asset('storage/assets/images/demos/ltr.png') }}"
                                            class="img-fluid rounded-md shadow-md d-block" alt=""><span
                                            class="text-muted mt-2 d-block">Light Version</span></a></li>
                                <li class="d-grid"><a href="landing/index.html" target="_blank" class="mt-4"><img
                                            src="{{ asset('storage/assets/images/demos/landing.png') }}"
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
    <script>
        //Chart Three
        try {
            var options = {
                chart: {
                    height: 320,
                    type: 'donut',
                },
                series: [{{ $hadirPersen }}, {{ $sakitPersen }}, {{ $izinPersen }},
                    {{ $tidakHadirPersen }}
                ],
                labels: ["Hadir", "Sakit", "Izin", "Tidak Hadir"],
                legend: {
                    show: true,
                    position: 'bottom',
                    offsetY: 0,
                },
                dataLabels: {
                    enabled: true,
                    dropShadow: {
                        enabled: false,
                    }
                },
                stroke: {
                    show: true,
                    colors: ['transparent'],
                },
                // dataLabels: {
                //     enabled: false,
                // },
                theme: {
                    monochrome: {
                        enabled: true,
                        color: '#2f55d4',
                    }
                },
                responsive: [{
                    breakpoint: 768,
                    options: {
                        chart: {
                            height: 400,
                        },
                    }
                }]
            }
            var chart = new ApexCharts(document.querySelector("#top-product-chart"), options);
            chart.render();
        } catch (error) {

        }
    </script>

    @include('sweetalert::alert')
</body>

</html>
