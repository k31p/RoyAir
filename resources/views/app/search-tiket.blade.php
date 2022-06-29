<link rel="stylesheet" href="{{ asset('custom/search-page.css') }}">
@extends('layout.main')
@section('content')
<body class="text-dark">
    @include('layout.navbar')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6" style="margin-top: 8em;">
                <div class="card">
                    <h2 class="card-header card-title text-center">Cari Tiket</h2>
                    <div class="card-body">
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
                                <div class="col">
                                    <label for="jumlah" class="form-label">Jumlah Penumpang</label>
                                    <input type="number" name="jumlah" id="jumlah" class="form-control" value="1">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection