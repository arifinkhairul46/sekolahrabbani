<nav class="navbar navbar-expand-lg">
    <div class="container mt-3">
        <img src="{{ asset('assets/images/logo_sekolah_rabbani.png') }}" alt="logo" width="60px" height="55px">
        <img src="{{ asset('assets/images/sekolah_rabbani.png') }}" alt="logo" width="150px">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mt-2 mt-lg-0">
                <li class="nav-item">
                <a class="nav-link" aria-current="page" href="/">Beranda</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Profil
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="/visi-misi">Visi Misi</a></li>
                      <li><a class="dropdown-item" href="#">Struktur Organisasi</a></li>
                      <li><a class="dropdown-item" href="#">Lokasi Sekolah</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="kurikulum">Kurikulum</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Artikel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Kesiswaan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Humas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Karir</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">PPDB</a>
                </li>
            </ul>
            <ul class="navbar-nav mt-2 mt-lg-0" style="margin-left: auto">
                <li class="nav-item mr-2 mb-3 mb-lg-0">
                    <a class="nav-link" href="/login">Login</a>
                </li>
                <li class="nav-item mr-2 mb-3 mb-lg-0">
                    <a class="nav-link" href="/register">Register</a>
                </li>
            </ul>
        </div>
    </div>
</nav>