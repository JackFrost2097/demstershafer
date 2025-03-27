<?php
// Memulai session
session_start();

// Cek apakah session username dan level admin telah terdaftar
if (isset($_SESSION['username']) && $_SESSION['level'] == 1) {
    // Tampilkan konten halaman untuk level admin
    //echo "Selamat datang, " . $_SESSION['username'] . "! Anda sedang berada di halaman admin.";
    $b = '<div class="col-sm-11 ">';
    $c = '</div>';
    $username = $_SESSION['username'];
    include "functions.php";
    include "head.php";
    include "navbar.php";
} elseif (isset($_SESSION['username']) && $_SESSION['level'] == 2) {

    // Tampilkan konten halaman untuk level admin
    //echo "Selamat datang, " . $_SESSION['username'] . "! Anda sedang berada di halaman admin.";
    $a = '<a class="nav-link" href="logout.php">Logout</a>';
    $b = '<div class="col-sm-8">';
    $c = '</div>';
    $username = $_SESSION['username'];
    include "functions.php";
    include "head.php";
    include "navbaruser.php";
    echo "<style>.ara { display: none; }</style>";
} else {
    $a = "<a class='nav-link ' href='login.php'>Login</a>";
    $b = '<div class="col-sm-12">';
    $c = '</div>';
    include "head.php";
    include "navbaruser.php";
    echo "
    <script>
        alert('Login dulu lah bro');
        document.location.href = 'login.php';
    </script>";
}

if (isset($_POST['hapus'])) {
    if (hapusriwayat($_POST) > 0) {
        echo "
        <script>
            alert('Berhasil delete Bro');
            document.location.href = 'riwayat.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Gagal Bro');
            document.location.href = 'riwayat.php';
        </script>";
    }
}
echo $b;
?>
<!-- menampilkan daftar gejala-->

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title p-5"> Riwayat Diagnosa </h3>
    </div>
    <div class="panel-body">
        <form role="form" method="post" action="riwayat.php" class=" form form-group">
            <table class="table" border="2">
                <thead>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Gejala</th>
                    <th>Penyakit</th>
                    <th>Tingkat Kepercayaan</th>
                    <th>Aksi</th>
                </thead>

                <?php
                if ($username == 'pakar') {
                    $sqli = "SELECT * 
                    FROM riwayat 
                    INNER JOIN penyakit ON riwayat.idpenyakit = penyakit.idpenyakit 
                    INNER JOIN user ON riwayat.usernama = user.usernama";
                } else {
                    $sqli = "SELECT * 
                    FROM riwayat 
                    INNER JOIN penyakit ON riwayat.idpenyakit = penyakit.idpenyakit 
                    INNER JOIN user ON riwayat.usernama = user.usernama 
                    WHERE user.username = '$username'";
                }
                $result = $db->query($sqli);
                while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td>
                            <input type="hidden" name="idriwayat" value="<?= "{$row['idriwayat']}" ?>">
                            <?php
                            echo "{$row['usernama']}<br>"; ?>
                        </td>
                        <td>
                            <?php
                            echo "{$row['useralamat']}<br>"; ?>
                        </td>
                        <td>
                            <?php echo "{$row['idgejala']}<br>"; ?>
                        </td>
                        <td>
                            <?php
                            echo "{$row['namapenyakit']}<br>"; ?>
                        </td>
                        <td>
                            <?php
                            echo "{$row['nilaiprobabilitas']}<br>"; ?>
                        </td>
                        <td>
                            <button type="submit" href="" name="hapus" class="btn btn-tm btn-danger">
                                hapus
                            </button>
                        </td>
                    </tr>
                    <?php
                }
                ?>


            </table>
        </form>
    </div>
</div>
<?php
echo $c;
include "footer.php";
include 'end.php';
?>