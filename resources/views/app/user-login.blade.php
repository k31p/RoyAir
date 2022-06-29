@extends('layout.main')
@section('content')
<body class="text-dark">
    @include('layout.navbar')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card shadow-xl" style="margin-top: 10em;">
                    <h2 class="card-title card-header text-center">Login</h2>
                    <div class="card-body">
                        <form action="{{ route('penumpang.ceklogin') }}" method="post" class="form-group">
                            @if(Session::has('error'))
                                <div class="alert alert-danger text-center">Username atau password anda salah!</div>
                            @endif
                            @csrf
                            <div>
                                <label for="username" class="form-label">Username</label>
                                <input type="text" name="username" id="username" class="form-control" value="{{ old('username') }}">
                                @error('username') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control">
                                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <button type="submit" class="form-control btn btn-primary mt-2">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection