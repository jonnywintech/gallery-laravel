@extends('base.main')
@section('title', 'Register')

@section('content')
    <section class="pb-4">
        <div class="bg-white border rounded-5">

            <section class="p-5 w-100" style="background-color: #eee; border-radius: .5rem .5rem 0 0;">
                <div class="row">
                    <div class="col-12">
                        <div class="card text-black" style="border-radius: 25px;">
                            <div class="card-body p-md-5">
                                <div class="row justify-content-center">
                                    <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                        <p class="text-center h1 fw-bold mb-5 mt-4">Sign up</p>

                                        <form>

                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                                <div class="form-outline flex-fill mb-0">
                                                    <input type="text" id="form3Example1c" class="form-control">
                                                    <label class="form-label" for="form3Example1c"
                                                        style="margin-left: 0px;">Your Name</label>
                                                    <div class="form-notch">
                                                        <div class="form-notch-leading" style="width: 9px;"></div>
                                                        <div class="form-notch-middle" style="width: 71.2px;"></div>
                                                        <div class="form-notch-trailing"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                                <div class="form-outline flex-fill mb-0">
                                                    <input type="email" id="form3Example3c" class="form-control">
                                                    <label class="form-label" for="form3Example3c"
                                                        style="margin-left: 0px;">Your Email</label>
                                                    <div class="form-notch">
                                                        <div class="form-notch-leading" style="width: 9px;"></div>
                                                        <div class="form-notch-middle" style="width: 69.6px;"></div>
                                                        <div class="form-notch-trailing"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                                <div class="form-outline flex-fill mb-0">
                                                    <input type="password" id="form3Example4c" class="form-control">
                                                    <label class="form-label" for="form3Example4c"
                                                        style="margin-left: 0px;">Password</label>
                                                    <div class="form-notch">
                                                        <div class="form-notch-leading" style="width: 9px;"></div>
                                                        <div class="form-notch-middle" style="width: 64px;"></div>
                                                        <div class="form-notch-trailing"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                                <div class="form-outline flex-fill mb-0">
                                                    <input type="password" id="form3Example4cd" class="form-control">
                                                    <label class="form-label" for="form3Example4cd"
                                                        style="margin-left: 0px;">Repeat your password</label>
                                                    <div class="form-notch">
                                                        <div class="form-notch-leading" style="width: 9px;"></div>
                                                        <div class="form-notch-middle" style="width: 136px;"></div>
                                                        <div class="form-notch-trailing"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-check d-flex justify-content-center mb-5">
                                                <input class="form-check-input me-2" type="checkbox" value=""
                                                    id="form2Example3c">
                                                <label class="form-check-label" for="form2Example3">
                                                    I agree all statements in <a href="#!">Terms of service</a>
                                                </label>
                                            </div>

                                            <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                                <button type="button" class="btn btn-primary btn-lg">Register</button>
                                            </div>

                                        </form>

                                    </div>
                                    <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                                            class="img-fluid" alt="Sample image">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>



            <div class="p-4 text-center border-top mobile-hidden">
                <a class="btn btn-link px-3" data-mdb-toggle="collapse" href="#example1" role="button"
                    aria-expanded="false" aria-controls="example1" data-ripple-color="hsl(0, 0%, 67%)">
                    <i class="fas fa-code me-md-2"></i>
                    <span class="d-none d-md-inline-block">
                        Show code
                    </span>
                </a>


                <a class="btn btn-link px-3 " data-ripple-color="hsl(0, 0%, 67%)">
                    <i class="fas fa-file-code me-md-2 pe-none"></i>
                    <span class="d-none d-md-inline-block export-to-snippet pe-none">
                        Edit in sandbox
                    </span>
                </a>

            </div>


        </div>
    </section>
@endsection
