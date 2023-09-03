<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">HOME</div>
                <a class="nav-link" href="/">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">MENU</div>
                <a class="nav-link" href="/kegiatan">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Kegiatan
                </a>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseMitra" aria-expanded="false" aria-controls="collapseMitra">
                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Mitra
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseMitra" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="#">Tambah Mitra</a>
                        <a class="nav-link" href="#">Lihat Mitra</a>
                    </nav>
                </div>
               
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCetak" aria-expanded="false" aria-controls="collapseCetak">
                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Cetak
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseCetak" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="#">Surat Tugas</a>
                        <a class="nav-link" href="#">SPK</a>
                        <a class="nav-link" href="#">BAST</a>
                    </nav>
                </div>

            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            <?= session()->get('user_email'); ?>
        </div>
    </nav>
</div>