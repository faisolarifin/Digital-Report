@extends('templates.guest', ['title' => 'Verify | DigitalKas'])

@section('content')
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-sm-5 p-4">
            <div class="bg-light p-5 rounded">
                <h3 class="mb-3">Verifikasi Email Anda</h3>

                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        A fresh verification link has been sent to your email address.
                    </div>
                @endif

                Link verifikasi telah dikirimkan ke email kamu, Segera cek email dan klik tombol <strong>Verifikasi Email</strong> agar bisa melanjukan ke halaman utama.
                <form action="{{ route('verification.resend') }}" method="POST" class="text-center mt-3">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-primary">
                        Kirim Link Verifikasi Lagi.
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
