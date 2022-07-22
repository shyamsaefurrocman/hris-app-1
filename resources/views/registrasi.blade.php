
<!DOCTYPE html>
<html lang="en">

    @include('layout/header')

    <body>
        <!-- Loader -->
        <!-- <div id="preloader">
            <div id="status">
                <div class="spinner">
                    <div class="double-bounce1"></div>
                    <div class="double-bounce2"></div>
                </div>
            </div>
        </div> -->
        <!-- Loader -->

        <!-- Hero Start -->
        <section class="bg-home bg-circle-gradiant d-flex align-items-center">
            <div class="bg-overlay bg-overlay-white"></div>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="form-signin p-4 bg-white rounded shadow">
                            <form action="{{ route('processregistrasi') }}" method="POST">
                                @csrf
                                <h2 class="logo text-center" style="color: #3933FF"><b>HRiS System</b></h2>
                                <h5 class="mb-3 text-center">Register</h5>
                            
                                <div class="form-floating mb-2">
                                    <input type="text" class="form-control" name="nama" id="floatingInput" placeholder="Nama Lengkap">
                                    <label for="floatingInput">Nama Lengkap</label>
                                </div>

                                <div class="form-floating mb-2">
                                    <input type="number" class="form-control" name="nomor_telepon" id="floatingInput" placeholder="08xxxxxxxxxx">
                                    <label for="floatingInput">Nomor Telepon</label>
                                </div>

                                <div class="form-floating mb-2">
                                    <input type="email" class="form-control" name="email" id="floatingEmail" placeholder="name@example.com">
                                    <label for="floatingEmail">Email Address</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
                                    <label for="floatingPassword">Password</label>
                                </div>
                            
                                <button class="btn btn-primary w-100" type="submit">Register</button>

                                <div class="col-12 text-center mt-3">
                                    <p class="mb-0 mt-3"><small class="text-dark me-2">Already have an account ?</small> <a href="{{ route('login') }}" class="text-dark fw-bold">Sign in</a></p>
                                </div><!--end col-->

                                <p class="mb-0 text-muted mt-3 text-center">© <script>document.write(new Date().getFullYear())</script> GeekGarden Sofware House.</p>
                            </form>
                        </div>
                    </div>
                </div>
            </div> <!--end container-->
        </section><!--end section-->
        <!-- Hero End -->
        
        @include('layout/js')
        
    </body>

</html>