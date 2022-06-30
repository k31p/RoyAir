<link rel="stylesheet" href="{{ asset('custom/home.css') }}">
@extends('layout.main')
@section('content')
<body class="text-light">
    @include('layout.navbar')
    <div class="container">
        <div class="row">
            <div class="col-12 bg-dark bg-opacity-50" style="margin-top: 10em; padding: 5em;">
                <h2 class="text-center">RoyAir</h2>
                <p class="text-center">Menyediakan tiket pesawat secara ilegal</p>
            </div>
        </div>
    </div>
    @include('layout.footer')
</body>
@endsection