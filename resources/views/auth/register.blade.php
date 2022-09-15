@extends('templates.guest', ['title' => 'Register'])

@section('content')
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-sm-5 p-4">
            <div class="card">
                <div class="card-body px-5 pt-5">
                    <form action="{{route('register.auth')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <h5 class="text-left mb-0">Buat Akun dengan Email</h5>
                                <small>Coba Daftar Praktis dengan Google atau Facebook. </small>
                                @if (Session::has('error'))
                                    <div class="alert alert-danger alert-dismissible show fade mt-2">
                                        {{Session::get('error')}}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                                <div class="form-group mt-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" />
                                </div>
                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" />
                                </div>
                                <div class="form-group">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" />
                                </div>
                                <div class="form-group mt-4">
                                    <button class="btn btn-success btn-block">Sign Up</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <div class="row mt-4 btn-login">
                        <div class="col-sm-12">
                            <p class="text-center">Sudah memiliki akun? Login <a href="{{route('login')}}" class="text-primary"> disini.</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
