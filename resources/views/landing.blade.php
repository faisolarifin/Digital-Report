<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        body {
            background: #F9FAFB;
        }
        h1, h2, h3, h4, p, a, button {
            font-family: 'Comic Neue', cursive;
            font-weight: 400;
        }
        .flex-what h2 {
            font-weight: 700;
        }

        .navbar-brand img {
            max-width: 12.2rem;
        }
        .collapse {
            max-width: 43rem;
        }
        .flex-what {
            margin-top: 5rem;
        }
        button {
            font-weight: 700;
        }
        .btn-primary {
            background-color: #5f61e6;
            border-color: #5f61e6;
            box-shadow: 0 0.125rem 0.25rem 0 rgba(105, 108, 255, 0.4);
        }
    </style>

    <title>Selamat Datang | Prokas</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{asset('assets/images/logo/logo.png')}}" alt="..">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-sm-flex justify-content-sm-between" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="/">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Solusi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Keuntungan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Kontak</a>
                    </li>
                </ul>
                <a href="{{route('login')}}" class="btn btn-sm btn-primary">Login / Daftar</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row flex-what">
            <div class="col-sm-6 d-flex flex-column justify-content-center text-center text-sm-start mb-4 mb-sm-0">
                <h2 class="mb-3">Apa itu Kaspro?</h2>
                <p class="mb-3 mb-sm-5">Kaspro adalah sistem digital yang akan membantu anda untuk mempermudah pengelolaan laporan kas, dengan menawarkan menyimpan data pada sistem cloud untuk mengantisipasi kehilangan data. </p>
                <a href="{{route('dashboard')}}">
                    <button class="btn btn-primary">Coba Sekarang</button>
                </a>
            </div>
            <div class="col-sm-6 py-4 d-flex justify-content-center">
                <img src="{{asset('assets/images/draw/undraw_mobile_payments_re_7udl.svg')}}" alt=".." class="w-75">
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
