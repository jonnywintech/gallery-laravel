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
                        <div class="card mb-3">
                            <div class="row g-0 d-flex align-items-center">
                                <div class="col-lg-4 d-none d-lg-flex">
                                    <img src="https://mdbootstrap.com/img/new/ecommerce/vertical/004.jpg"
                                        alt="Trendy Pants and Shoes"
                                        class="w-100 rounded-t-5 rounded-tr-lg-0 rounded-bl-lg-5" />
                                </div>
                                <div class="col-lg-8">
                                    <div class="card-body py-5 px-md-5">

                                        <form method="POST" action="{{route('logOn')}}">
                                            @csrf
                                            <!-- Email input -->
                                            <div class="form-outline mb-4">
                                                <input type="email" id="form2Example1" class="form-control" name="email"/>
                                                <label class="form-label" for="form2Example1">Email address</label>
                                            </div>

                                            <!-- Password input -->
                                            <div class="form-outline mb-4">
                                                <input type="password" id="form2Example2" class="form-control" name="password" />
                                                <label class="form-label" for="form2Example2">Password</label>
                                            </div>

                                            <!-- 2 column grid layout for inline styling -->
                                            <div class="row mb-4">
                                                <div class="col d-flex justify-content-center">
                                                    <!-- Checkbox -->
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="form2Example31" checked />
                                                        <label class="form-check-label" for="form2Example31"> Remember me
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <!-- Simple link -->
                                                    <a href="#!">Forgot password?</a>
                                                </div>
                                            </div>

                                            <!-- Submit button -->
                                            <button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>

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
