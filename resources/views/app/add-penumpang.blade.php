<link rel="stylesheet" href="{{ asset('custom/search-page.css') }}">
@extends('layout.main')
@section('content')
<body class="text-dark">
    @include('layout.navbar')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6" style="margin-top: 2em;">
                <div class="card">
                    <h2 class="card-header card-title text-center">Tambah Penumpang</h2>
                    <div class="card-body">
                        <div class="row">
                            @if (Session::has('error'))
                            <span class="alert alert-danger">Sepertinya terjadi kesalahan, mohon coba lagi nanti</span>
                            @else
                            <small class="text-center text-secondary">Bayi tidak akan dihitung ke dalam total harga</small>
                            @endif
                        </div>
                        <form action="{{ route('penumpang.adds') }}" method="post" class="form-group mt-2">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col">
                                    <label for="persons" class="form-label">Tambah Penumpang</label>
                                    <input type="number" name="persons" id="persons" class="form-control" value="1">
                                </div>
                                <div class="col d-flex align-items-end">
                                    <button type="submit" class="row-12 form-control btn btn-primary">Tambah</button>
                                </div>
                            </div>
                        </form>
                        @if(Session::has('persons'))
                        <form action="{{ route('penumpang.book') }}" method="post" class="form-group">
                            {{ csrf_field() }}
                            @for($x = 1; $x <= Session::get('persons'); $x++)
                                <div class="row mt-5">
                                    <div class="col">
                                        <label for="person{{ $x }}" class="form-label">Penumpang {{ $x }}</label>
                                        <input class="form-control" type="text" name="person{{ $x }}" id="person{{ $x }}">
                                        <label for="no_kursi{{ $x }}" class="form-label">Kursi</label>
                                        <select name="no_kursi{{ $x }}" id="no_kursi{{ $x }}}" class="form-select">
                                            @for($y = 1; $y <= Session::get('order')->jumlah_kursi; $y++)
                                                <option value="{{ $y }}">{{ $y }}</option>
                                            @endfor
                                        </select>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="umur{{ $x }}" id="umurd{{ $x }}" value="Dewasa">
                                            <label for="umurd{{ $x }}" class="form-check-label">Dewasa</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="umur{{ $x }}" id="umura{{ $x }}" value="Anak-Anak">
                                            <label for="umura{{ $x }}" class="form-check-label">Anak-Anak</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="umur{{ $x }}" id="umurb{{ $x }}" value="Bayi">
                                            <label for="umurb{{ $x }}" class="form-check-label">Bayi</label>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                            <button type="submit" class="form-control btn btn-primary mt-3">Booking Sekarang</button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection