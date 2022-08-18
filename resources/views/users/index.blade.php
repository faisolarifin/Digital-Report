@extends('templates.template')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Users</h3>
                <p class="text-subtitle text-muted text-capitalize"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb text-capitalize">
                        <li class="breadcrumb-item"><a href="{{route('rep.kas')}}">Dashboard</a></li>
                        <li class="breadcrumb-item">Users</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5>Masih dalam Pegembangan...</h5>
            </div>

        </div>

    </section>

@endsection
