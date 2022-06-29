<link rel="stylesheet" href="{{ asset('custom/search-page.css') }}">
@extends('layout.main')
@section('content')
<body class="text-dark">
    @include('layout.navbar')
    <div class="container">
        <div class="row">
            <div class="row justify-content-center">
                <div class="col-12" style="margin-top: 8em;">
                    <div class="card">
                        <h2 class="card-header card-title text-center">Tambah Data Penumpang</h2>
                        <div class="card-body">
                            
                        </div>
                        <div class="card-body">
                            <form action="" method="POST" class="form-group">
                                {{ csrf_field() }}
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection