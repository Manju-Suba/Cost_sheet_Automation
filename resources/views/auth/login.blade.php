<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>Cost Sheet Automation</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Costsheet Automation Portal" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/h_logo.png">

        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    </head>


    <body>

    <!-- <body data-layout="horizontal"> -->

    <div class="authentication-bg min-vh-100">
        <div class="bg-overlay bg-light"></div>
        <div class="container">
            <div class="d-flex flex-column min-vh-100 px-3 pt-4">
                <div class="row justify-content-center my-auto">
                    <div class="col-md-8 col-lg-6 col-xl-5">

                        <div class="mb-4 pb-2">
                            <a href="index.html" class="d-block auth-logo">
                                {{-- <img src="assets/images/logo-dark.png" alt="" height="30" class="auth-logo-dark me-start"> --}}
                                <img src="assets/images/logo-light.png" alt="" height="30" class="auth-logo-light me-start">
                            </a>
                        </div>

                        <div class="card">
                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5>Welcome Back !</h5>
                                    <p class="text-muted">Sign in to continue to Cost Sheet Automation.</p>
                                </div>
                                <div class="p-2 mt-4">
                                    @if ($errors->any())
                                        <ul class="alert alert-danger">
                                            {!! implode('',$errors->all('<li class="list-group-item bg-danger">:message</li>')) !!}
                                        </ul>
                                    @endif
                                    <form  method="POST" action="{{ url('authenticate')}}">

                                        <div class="mb-3">
                                            <label class="form-label" for="Email">Email</label>
                                            <div class="position-relative input-custom-icon">
                                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email">
                                                 <span class="bx bx-user"></span>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="float-end">
                                                {{-- <a href="auth-recoverpw.html" class="text-muted text-decoration-underline">Forgot password?</a> --}}
                                            </div>
                                            <label class="form-label" for="password-input">Password</label>
                                            <div class="position-relative auth-pass-inputgroup input-custom-icon">
                                                <span class="bx bx-lock-alt"></span>
                                                <input type="password" class="form-control" id="password-input" name="password" placeholder="Enter password">
                                                <button type="button" class="btn btn-link position-absolute h-100 end-0 top-0" id="password-addon">
                                                    <i class="mdi mdi-eye-outline font-size-18 text-muted"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <button class="btn btn-primary w-100 waves-effect waves-light" type="submit" value="Login"> Log In</button>
                                        </div>
<br>
                                        @csrf
                                    </form>
                                </div>

                            </div>
                        </div>

                    </div><!-- end col -->
                </div><!-- end row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center p-4">
                            <p>© <script>document.write(new Date().getFullYear())</script> Cost Sheet Automation. Crafted with <i class="mdi mdi-heart text-danger"></i> by HEPL</p>
                        </div>
                    </div>
                </div>

            </div>
        </div><!-- end container -->
    </div>
    <!-- end authentication section -->

        <!-- JAVASCRIPT -->
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenujs/metismenujs.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/eva-icons/eva.min.js"></script>

        <script src="assets/js/pages/pass-addon.init.js"></script>

    </body>

</html>
