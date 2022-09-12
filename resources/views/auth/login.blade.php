@extends('templates.guest', ['title' => 'Login | DigitalKas'])

@section('content')
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-sm-5 p-4">
            <div class="card">
                <div class="card-body px-5 pt-5">
                    <form action="{{route('login.auth')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <h5 class="text-left mb-0">Login ke Akun Anda</h5>
                                <small>Gunakan akun anda untuk mengelola</small>
                                @if (Session::has('error'))
                                    <div class="alert alert-danger mt-2 alert-dismissible show fade">
                                        {{Session::get('error')}}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                                <div class="form-group mt-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{old('email')}}" />
                                </div>
                                <div class="form-group">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" />
                                </div>
                                <div class="form-group mt-4">
                                    <button class="btn btn-primary btn-block">Sign In</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <div class="row mt-4 btn-login">
                        <div class="col-sm-12">
                            <a href="{{route('auth.google')}}" class="btn btn-outline-secondary btn-sm btn-block mb-2"><i class="bi bi-google"></i> Sign In with Google</a>
                            <a href="{{route('auth.fb')}}" class="btn btn-outline-secondary btn-sm btn-block"><i class="bi bi-facebook"></i> Sign In with Facebook</a>
                            <p class="mt-3 text-center">Belum memiliki akun? Daftar <a href="{{route('register')}}" class="text-primary"> disini.</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
