<link rel="stylesheet" href="{{ asset('custom/search-page.css') }}">
@extends('layout.main')
@section('content')
<body class="text-dark">
    @include('layout.navbar')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6" style="margin-top: 2em;">
                <div class="card">
                    <h2 class="card-header card-title text-center">@if(Session::has('order'))Pastikan Pilihan Pesawat Anda @else Cari Tiket @endif</h2>
                    <div class="card-body">
                        @if(Session::has('order'))
                            <form action="" method="POST" class="form-group">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col">
                                        <label for="awal" class="form-label">Awal Berangkat</label>
                                        <input type="text" name="awal" id="awal" class="form-control" value="{{ Session::get('order')->rute_awal }}" disabled readonly>
                                    </div>
                                    <div class="col">
                                        <label for="tujuan" class="form-label">Tujuan</label>
                                        <input type="text" name="tujuan" id="tujuan" class="form-control" value="{{ Session::get('order')->rute_akhir }}" disabled readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="harga" class="form-label">Harga per Orang</label>
                                        <input type="text" name="" id="harga" class="form-control" value="{{ Session::get('order')->harga }}" disabled readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="kelas" class="form-label">Kelas</label> 
                                        <input type="text" class="form-control" name="kelas" id="kelas" value="{{ Session::get('order')->nama_type }}" disabled readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="pesawat" class="form-label">Nama Pesawat</label>
                                        <input type="text" class="form-control" name="pesawat" id="pesawat" value="{{ Session::get('order')->kode }}" disabled readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="maskapai" class="form-label">Maskapai</label>
                                        <input type="text" class="form-control" name="maskapai" id="maskapai" value="{{ Session::get('order')->kode_pesawat }}" disabled readonly>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <a href="{{ route('penumpang.cancel') }}" type="submit" class="form-control btn btn-danger">Cancel</a>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ route('penumpang.add') }}" type="submit" class="form-control btn btn-primary">Yes</a>
                                    </div>
                                </div>
                            </form>
                        @else
                            <form action="{{ route('penumpang.search') }}" method="POST" class="form-group">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col">
                                        <label for="awal" class="form-label">Awal Berangkat</label>
                                        <input type="text" name="awal" id="awal" class="form-control" value="{{ old('awal') }}">
                                    </div>
                                    <div class="col">
                                        <label for="tujuan" class="form-label">Tujuan</label>
                                        <input type="text" name="tujuan" id="tujuan" class="form-control" value="{{ old('tujuan') }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="tanggal" class="form-label">Tanggal Berangkat</label>
                                        <input type="date" name="tanggal_berangkat" id="tanggal" class="form-control">
                                    </div>
                                    <div class="col">
                                        <label for="kelas" class="form-label">Kelas</label> 
                                        <select name="kelas" id="kelas" class="form-select">
                                            <option value="Economy">Economy</option>
                                            <option value="Business">Business</option>
                                            <option value="First Class">First Class</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="maskapai" class="form-label">Maskapai</label>
                                        <select name="maskapai" id="maskapai" class="form-select">
                                            <option value="Lion Air">Lion Air</option>
                                            <option value="CityLink">CityLink</option>
                                            <option value="Batik Air">Batik Air</option>
                                            <option value="Air Asia">Air Asia</option>
                                            <option value="Garuda Indonesia">Garuda Indonesia</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-center mt-2">
                                        <button type="submit" class="btn btn-primary">Cari Tiket</button>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection