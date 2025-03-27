<?php
// Memulai session
session_start();

// Cek apakah session username dan level admin telah terdaftar
if (isset($_SESSION['username']) && $_SESSION['level'] == 1) {
    // Tampilkan konten halaman untuk level admin
    //echo "Selamat datang, " . $_SESSION['username'] . "! Anda sedang berada di halaman admin.";
    $b = '<div class="col-sm-11">';
    $c = '</div>';
    include "functions.php";
    include "head.php";
    include "navbar.php";
} elseif (isset($_SESSION['username']) && $_SESSION['level'] == 2) {

    // Tampilkan konten halaman untuk level admin
    //echo "Selamat datang, " . $_SESSION['username'] . "! Anda sedang berada di halaman admin.";
    $a = '<a class="nav-link" href="logout.php">Logout</a>';
    $b = '<div class="col-sm-12">';
    $c = '</div>';
    include "functions.php";
    include "head.php";
    include "navbaruser.php";
} else {
    $a = "<a class='nav-link ' href='login.php'>Login</a>";
    $b = '<div class="col-sm-12">';
    $c = '</div>';
    include "head.php";
    include "navbaruser.php";
}



//<!-- END NAVBAR || START CONTENT-->
echo $b;
?>
<div class="row" id="home">
    <div class="col-md-6 col-lg-6 pt-5 mt-5 align-items-center justify-content-center text-center ">
        <h1>Sistem Pakar Diagnosis Penyakit</h1>
        <h3>menemukan penyakit anda seperti ahlinya</h3>
        <h1>‎</h1>
        <a class="btn btn-primary" href="diagnosa.php"> Cek Penyakit</a>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#exampleModal">
            ▶️Watch Now
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Penyakit</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h3>
                            ‎
                        </h3>
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/exGMjD8EwrY"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen></iframe>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-6">
        <img class="img-fluid " id="animated-updown" src="assets/img/Health-Requirements-1.png" alt="">
    </div>
</div>
<div class="row bodyy text-center">
    <h1>‎</h1>
    <h1 class="text-light" id="jenis">Jenis Penyakit Yang Dapat Kami Diagnosa</h1>
    <h3>‎</h3>
    <div class="container">
        <table class="table table-striped table-bordered">
            <tr>
                <th>No</th>
                <th>Jenis Penyakit</th>
                <th>Jumlah Kasus</th>
            </tr>
            <tr>
                <td>1</td>
                <td>Infeksi Akut pada saluran pernafasan bagian atas</td>
                <td> 106,150</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Penyakit Tekanan Darah Tinggi / Hipertensi</td>
                <td>98267</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Gastritis</td>
                <td>49165</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Diabetes Mellitus</td>
                <td>48970</td>
            </tr>
            <tr>
                <td>5</td>
                <td>commoncold</td>
                <td>36483</td>
            </tr>
            <tr>
                <td>6</td>
                <td>Dispepsia</td>
                <td>36398</td>
            </tr>
            <tr>
                <td>7</td>
                <td>Infeksi pada saluran pernafasan bagian atas (ISPA)</td>
                <td>36044</td>
            </tr>
            <tr>
                <td>8</td>
                <td>Myalgia</td>
                <td>35835</td>
            </tr>
            <tr>
                <td>9</td>
                <td>Diare</td>
                <td>26743</td>
            </tr>
            <tr>
                <td>10</td>
                <td>Penyakit pada sistem otot dan jaringan pengikat </td>
                <td>21892</td>
            </tr>
        </table>
    </div>
</div>
<div class="cusbg imgsatu text-primary-emphasis fw-bolder thumbnaill pt-5 pb-5">
    <h1>‎</h1>
    <h2 class="text-center"><a href="" class=" text-decoration-none alert alert-info">We Help We Care</a>
    </h2>

    <h1>‎</h1>
</div>
<div class="bg-dark-subtle container-fluid text-black  pt-5 pb-5" id="aboutus">
    <h1 class="text-center  pt-5 pb-5">About Us</h1>
    <p class="container pt-5 pb-5"> ‎ ‎ ‎Sistem pakar kami memberikan keunggulan dalam memecahkan masalah
        kompleks
        dengan cepat
        dan akurat. Dengan memanfaatkan kecerdasan buatan dan pengetahuan yang mendalam, kami dapat
        memberikan
        solusi
        yang
        cerdas dan tepat waktu. Kecepatan dan efisiensi sistem pakar kami memungkinkan pengguna untuk
        mendapatkan
        jawaban
        dan rekomendasi secara instan, tanpa harus menunggu waktu yang lama. Kami bangga memiliki tim ahli
        yang
        telah
        menyumbangkan pengetahuan dan pengalaman mereka untuk membangun sistem pakar yang handal.
        Pengetahuan yang
        dikumpulkan dan diimplementasikan dalam sistem kami memberikan keakuratan dan konsistensi dalam
        pengambilan
        keputusan. Kami memahami pentingnya ketersediaan layanan, oleh karena itu sistem pakar kami dapat
        diakses
        24/7,
        sehingga pengguna dapat mengakses solusi dan informasi yang dibutuhkan kapan saja.
        Dengan sistem pakar kami, kami berkomitmen untuk memberikan solusi yang inovatif, memberdayakan
        pengguna
        dengan
        pengetahuan dan panduan yang dibutuhkan untuk mengatasi tantangan yang dihadapi. Kami yakin bahwa
        sistem
        pakar
        kami akan memberikan nilai tambah dan efisiensi dalam lingkungan yang membutuhkan keputusan cerdas
        dan
        solusi
        yang
        terpercaya
    </p>

</div>

<div class="cusbg imgdua text-primary fw-bolder thumbnaill d-flex align-items-center justify-content-center  pt-5 pb-5">
    <h1 class="pb-5 pt-5">‎</h1>
    <h2 class="text-decoration-none alert alert-info ">We Help We Care</h2>
    <h1>‎</h1>
</div>
<?php
echo $c;
include('footer.php');
include 'end.php';
?>