<div class="navbar navbar-expand justify-content-center bg-primary">
    <a href="/" class="navbar-brand text-light">RoyAir</a>
    <div class="navbar-nav">
        <a href="/" class="nav-link text-light">Home</a>
    </div>
    <div class="navbar-nav">
        <a href="{{ route('penumpang.cari') }}" class="nav-link text-light">Tiket Pesawat</a>
    </div>
    <div class="navbar-nav">
        <a href="#" class="nav-link text-light">Bantuan?</a>
    </div>
    <div class="navbar-nav">
        <a href="#" class="nav-link text-light">About</a>
    </div>
    <div class="navbar-nav" style="margin-left: 40em;">
        @if(Session::has('penumpangID'))
            <a href="#" class="nav-link text-light">Welcome, {{ Session::get('penumpangNama') }}</a>
        @else    
            <a href="{{ route('penumpang.login') }}" class="nav-link text-light">Register/Login</a>
        @endif
    </div>
</div>