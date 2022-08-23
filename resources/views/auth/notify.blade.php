@extends('templates.guest', ['title' => 'Verify | Digital Report'])

@section('content')
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-sm-5 p-4">
            <div class="bg-light p-5 rounded">
                <h1>Dashboard</h1>

                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        A fresh verification link has been sent to your email address.
                    </div>
                @endif

                Before proceeding, please check your email for a verification link. If you did not receive the email,
                <form action="{{ route('verification.resend') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="d-inline btn btn-link p-0">
                        click here to request another
                    </button>.
                </form>
            </div>
        </div>
    </div>
@endsection
