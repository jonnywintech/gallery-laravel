@extends('base.main')
@section('title', 'Create Gallery')
@section('content')
    <section class="vh-100" style="background-color: #eee;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                                    <h1 class="text-center pb-2">Create Gallery</h1>
                                    <form method="POST" action="{{ route('create.gallery') }}">
                                        @csrf
                                        <!-- Name input -->
                                        <div class="form-outline mb-4">
                                            <input type="text" id="form4name" name="gallery_name" required class="form-control" />
                                            <label class="form-label" for="form4name"  >Gallery Name</label>
                                        </div>

                                        <!-- URL input -->
                                        <div class="form-outline mb-4">
                                            <input type="text" id="form4url" class="form-control" required name="gallery_url" />
                                            <label class="form-label" for="form4url"  >Cover image URL</label>
                                        </div>

                                        <!-- Checkbox -->
                                        <div class="form-check d-flex justify-content-center mb-4">
                                            <input class="form-check-input me-2" type="checkbox" value=""
                                                id="form5Example3" required />
                                            <label class="form-check-label" for="form5Example3">
                                                I have read and agree to the terms
                                            </label>
                                        </div>

                                        <!-- Submit button -->
                                        <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary mb-4">Create</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
