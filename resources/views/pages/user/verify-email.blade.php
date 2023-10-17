@extends('base.main')
@section('title', 'Login')

@section('content')
    <!-- Section: Design Block -->
    <style>
        .rounded-t-5 {
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
        }

        @media (min-width: 992px) {
            .rounded-tr-lg-0 {
                border-top-right-radius: 0;
            }

            .rounded-bl-lg-5 {
                border-bottom-left-radius: 0.5rem;
            }
        }
    </style>
    <section class="vh-100" style="background-color: #eee;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }} <button type="button" onclick=" this.parentElement.parentElement.parentElement.style.display = 'none'" class="btn-close float-end mt-2" aria-label="Close"></button></li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card">
                            <div class="row g-0 d-flex align-items-center">
                                <div class="col-lg-4 d-none d-lg-flex">
                                    <img src="https://img.freepik.com/premium-vector/email-envelope-concept_34259-135.jpg"
                                        alt="Trendy Pants and Shoes"
                                        class="w-100 rounded-t-5 rounded-tr-lg-0 rounded-bl-lg-5" />
                                </div>
                                <div class="col-lg-8">
                                    <div class="card-body py-5 px-md-5">
                                        <h2>You must activate profile to access this page</h2>
                                        <p>Double check your email address before you require activation link again.</p>

                                        <form method="POST" action="{{route('resend.email')}}">
                                            @csrf
                                            <!-- Email input -->

                                            <button type="submit" class="btn btn-primary btn-block mb-4">Resend Confirmation email</button>

                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
