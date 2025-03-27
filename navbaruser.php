<nav class='navbar navbar-expand-lg bg-body-tertiary sticky-lg-top' data-bs-theme='dark'>
    <div class='container-fluid'>
        <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarTogglerDemo01'
            aria-controls='navbarTogglerDemo01' aria-expanded='false' aria-label='Toggle navigation'>
            <span class='navbar-toggler-icon'></span>
        </button>
        <div class='collapse navbar-collapse' id='navbarTogglerDemo01'>
            <a class='navbar-brand' href='index.php'>Sistem Pakar</a>
            <ul class='navbar-nav ms-auto mb-2 mb-lg-0'>
                <li class='nav-item'>
                    <a class='nav-link ' aria-current='page' href='index.php#home'>Home</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' href='#aboutus'>About Us</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' href='#contactus'>Contact Us</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="Diagnosa.php#jenis" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Cek Penyakit
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="penyakit.php">Jenis Penyakit</a></li>
                        <li><a class="dropdown-item" href="gejala.php">Jenis Gejala</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item araa" href="riwayat.php">riwayat</a></li>
                        <li><a class="dropdown-item" href="diagnosa.php">Cek Penyakit</a></li>
                    </ul>
                </li>
                <li class='nav-item'>
                    <?php echo $a; ?>
                </li>

            </ul>
        </div>
    </div>
</nav>