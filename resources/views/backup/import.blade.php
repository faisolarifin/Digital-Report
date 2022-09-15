@extends('templates.admin', ['title' => 'Export Database'])

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Backup</h3>
                <p class="text-subtitle text-muted text-capitalize"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb text-capitalize">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item">Users</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5>Import Database</h5>
                <small class="text-danger">Ketika melakukan import database, semua data akan direset menjadi data yang anda import.</small>
            </div>
            <div class="card-body">
                <form action="{{route('backup.import')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Pilih database .json</label>
                        <input class="form-control" type="file" name="database" id="formFile" accept="application/json" required>
                    </div>
                    <button class="btn btn-sm btn-primary px-sm-5">Proses</button>
                </form>
            </div>
        </div>

    </section>

    <script>
        dom = '<a href="{{route('backup.export')}}"><li class="sidebar-title">Backup Db</li></a>';
        dom += '<a href="{{route('backup.import')}}"><li class="sidebar-title mt-3">Import Db</li></a>';
        $('.menu').html(dom);
    </script>

@endsection
