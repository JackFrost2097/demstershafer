<?php
// Memulai session
session_start();

// Cek apakah session username dan level admin telah terdaftar
if (isset($_SESSION['username']) && $_SESSION['level'] == 1) {
    // Tampilkan konten halaman untuk level admin
    //echo "Selamat datang, " . $_SESSION['username'] . "! Anda sedang berada di halaman admin.";
    $b = '<div class="col-sm-7">';
    $c = '</div>';
    include "functions.php";
    include "head.php";
    include "navbar.php";
    $pilihpas = '<script>
    function handleDiagnosa() {
        var selectPasien = document.getElementById("selectPasien");
        var selectedPasienValue = selectPasien.value;

        // Cek apakah pilihan pasien bernilai kosong atau "pakar"
        if (selectedPasienValue === "" || selectedPasienValue === "pakar") {
            alert("Pilih pasien sebelum melakukan diagnosa!");
            return; // Menghentikan proses lebih lanjut jika nilai kosong atau "pakar"
        }

        // Jika pilihan pasien valid, lanjutkan ke proses diagnosa di sini...
        // Tambahkan kode Anda untuk menangani diagnosa di bagian ini.
    }
</script>';
} elseif (isset($_SESSION['username']) && $_SESSION['level'] == 2) {

    // Tampilkan konten halaman untuk level admin
    //echo "Selamat datang, " . $_SESSION['username'] . "! Anda sedang berada di halaman admin.";
    $a = '<a class="nav-link" href="logout.php">Logout</a>';
    $b = '<div class="col-sm-8">';
    $c = '</div>';
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
$pasien = tampil("SELECT * FROM pasien");
$pil = tampil("SELECT * FROM gejala");
echo $b;
?>


<h1>Halaman Diagnosa</h1>
<form action="" class="form-control" method="post">

    <!-- Card -->
    <div class="card ara">
        <div class="card-body">
            <!-- Judul Card -->
            <h5 class="card-title">Pilih Pasien</h5>
            <!-- Pilihan Pasien menggunakan elemen "select" -->
            <div class="mb-3">
                <label for="selectPasien" class="form-label">Pilih Pasien:</label>
                <select class="form-select" name="pasiena" id="selectPasien">
                    <option value="" selected>Pilih pasien...</option>
                    <?php
                    foreach ($pasien as $row):
                        ?>
                        <option value=<?= $row["usernama"]; ?>>
                            <?= $row["usernama"]; ?>
                        </option>
                    <?php endforeach; ?>
                    <!-- Tambahkan opsi lain sesuai kebutuhan -->
                </select>
                <?php foreach ($pasien as $row):
                    ?>
                    <input type="hidden" name="idpas" value="<?= $row['idpasien'] ?>">
                <?php endforeach; ?>
            </div>
            <!-- Tombol Tambah Pasien menggunakan elemen "button" -->
            <a class="btn btn-primary" href="pasien.php">Tambah Pasien</a>
        </div>
    </div>

    <table class="table table-hover pt-5 table-primary table-striped text-center table-bordered">
        <thead class="sticky-header">
            <tr>
                <th colspan="3" class="text-end" scope="col">
                    <button scope="col" type="submit" name="diagnosa" id="btn-sembunyi" class="btn btn-primary"
                        data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                        onclick="handleDiagnosa()">Diagnosa</button>
                </th>
            </tr>
            <tr>
                <th scope="col">
                    No
                </th>
                <th scope="col">
                    Pilih Gejala
                </th>
                <th scope="col">
                    Nama Gejala
                </th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($pil as $row):
                ?>
                <tr>
                    <td>
                        <?php echo $no;
                        $no++; ?>
                    </td>
                    <td>
                        <input type="checkbox" name="bukti[]" value="<?php echo $row['idgejala']; ?>" <?php echo (isset($_POST['bukti']) && in_array($row['idgejala'], $_POST['bukti'])) ? 'checked' : ''; ?>>
                    </td>
                    <td>
                        <?= $row["namagejala"]; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</form>
</div>
<div class="col-md-4" id="sembunyi">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> HASIL DIAGNOSA </h3>
        </div>
        <div class="panel-body">
            <div id="">
                <table class="table table-primary">
                    <thead>
                        <th>Gejala</th>
                        <th>Hasil akhir</th>
                    </thead>
                    <?php
                    if (isset($_POST['diagnosa'])) {
                        $tangkap = $_POST['bukti'];
                        $ppasien = $_POST['idpas'];
                        $usernama = $_POST['pasiena'];
                        $username = $_SESSION['username'];
                        $gejala = implode($tangkap);
                        if (count($_POST['bukti']) < 2) {
                            echo "<script>
                                        alert('Pilih Lebih dari 2 bro');
                                        document.location.href = 'diagnosa.php';
                                    </script>" . "<script>
                                    alert('Pilih Lebih dari 2 bro');
                                    document.location.href = 'diagnosa.php';
                                </script>";
                        } else { ?>
                            <tr>
                                <td>
                                    <?php
                                    //echo "== MENENTUKAN NILAI DENSITAS ==\n"; 
                                    //print_r($densitas_baru);
                                    //**pemanggilan gejala
                                    $s = tampil("SELECT GROUP_CONCAT(namagejala) AS namagejala FROM gejala WHERE idgejala IN ('" . implode("', '", $tangkap) . "')");
                                    foreach ($s as $dat):
                                        echo implode('` , `', $dat, );
                                        echo "<br>";
                                    endforeach;
                                    ?>
                                    <br>
                                </td>
                                <?php
                                $sql = "SELECT GROUP_CONCAT(b.kodepenyakit), a.bobot
                                        FROM basis a
                                        JOIN penyakit b ON a.idpenyakit=b.idpenyakit
                                        WHERE a.idgejala IN(" . implode(',', $_POST['bukti']) . ") 
                                        GROUP BY a.idgejala";
                                $result = $db->query($sql);
                                $evidence = array();
                                while ($row = $result->fetch_row()) {
                                    $evidence[] = $row;
                                }
                                //--- cek bobot
                                //$results = mysqli_query($db, $sql);
                                //while ($roww = mysqli_fetch_assoc($results)) {
                                //    print_r($roww);
                                //    echo "<br>";
                                //}
                                //--- menentukan environement
                                $sql = "SELECT GROUP_CONCAT(kodepenyakit) FROM penyakit";
                                $result = $db->query($sql);
                                $row = $result->fetch_row();
                                $fod = $row[0];

                                //--- menentukan nilai densitas
                                $densitas_baru = array();
                                while (!empty($evidence)) {
                                    $densitas1[0] = array_shift($evidence);
                                    $densitas1[1] = array($fod, 1 - $densitas1[0][1]);
                                    $densitas2 = array();
                                    if (empty($densitas_baru)) {
                                        $densitas2[0] = array_shift($evidence);
                                    } else {
                                        foreach ($densitas_baru as $k => $r) {
                                            if ($k != "&theta;") {
                                                $densitas2[] = array($k, $r);
                                            }
                                        }
                                    }
                                    $theta = 1;
                                    foreach ($densitas2 as $d) {
                                        $theta -= $d[1];
                                    }
                                    $densitas2[] = array($fod, $theta);
                                    $m = count($densitas2);
                                    $densitas_baru = array();
                                    for ($y = 0; $y < $m; $y++) {
                                        for ($x = 0; $x < 2; $x++) {
                                            if (!($y == $m - 1 && $x == 1)) {
                                                $v = explode(',', $densitas1[$x][0]);
                                                $w = explode(',', $densitas2[$y][0]);
                                                sort($v);
                                                sort($w);
                                                $vw = array_intersect($v, $w);
                                                if (empty($vw)) {
                                                    $k = "&theta;";
                                                } else {
                                                    $k = implode(',', $vw);
                                                }
                                                if (!isset($densitas_baru[$k])) {
                                                    $densitas_baru[$k] = $densitas1[$x][1] * $densitas2[$y][1];
                                                } else {
                                                    $densitas_baru[$k] += $densitas1[$x][1] * $densitas2[$y][1];
                                                }
                                            }
                                        }
                                    }
                                    foreach ($densitas_baru as $k => $d) {
                                        if ($k != "&theta;") {
                                            $densitas_baru[$k] = $d / (1 - (isset($densitas_baru["&theta;"]) ? $densitas_baru["&theta;"] : 0));
                                        }
                                    }
                                }

                                //--- perangkingan
                                //echo "== PERANGKINGAN ==\n";
                                unset($densitas_baru["&theta;"]);
                                arsort($densitas_baru);

                                ?>





                                <td>
                                    <?php

                                    //--- menampilkan hasil akhir
                                    //echo "== HASIL AKHIR ==\n";
                                    $codes = array_keys($densitas_baru);
                                    $final_codes = explode(',', $codes[0]);
                                    $sqll = "SELECT GROUP_CONCAT(namapenyakit)  
											FROM penyakit  
											WHERE kodepenyakit IN('" . implode("','", $final_codes) . "')";

                                    $result = $db->query($sqll);
                                    $row = $result->fetch_row();
                                    echo "Terdeteksi penyakit <a href='penyakit.php'><b>{$row[0]}</b></a> dengan derajat kepercayaan " . round($densitas_baru[$codes[0]] * 100, 2) . "%";
                                    //panggil data menggunakan array
                                    $densitas = round($densitas_baru[$codes[0]] * 100, 2);
                                    $sql2 = "SELECT GROUP_CONCAT(idpenyakit)  
											FROM penyakit  
											WHERE kodepenyakit IN('" . implode("','", $final_codes) . "')";
                                    $result2 = $db->query($sql2);
                                    $row2 = $result2->fetch_row();
                                    $penyakit = "{$row2[0]}";
                                    //panggil code gejala
                                    $s = "SELECT GROUP_CONCAT(kodegejala)  
											FROM gejala  
											WHERE idgejala IN('" . implode("', '", $tangkap) . "')";

                                    $res = $db->query($s);
                                    $rw = $res->fetch_row();
                                    $codegejala = "{$rw[0]}";

                                    //input riwayat
                                    $sql3 = "INSERT INTO riwayat (idriwayat,idgejala, idpenyakit, username,usernama,idpasien, nilaiprobabilitas) VALUES ('','$codegejala','$penyakit','$username','$usernama','$ppasien,','$densitas')";
                                    $db->query($sql3);
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo "lakukan konsultasi terlebih dahulu" . "<br>";

                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <div class="panel panel-primary bg-primary-subtle border border-secondary p-2">
        <div class="panel-heading p-2 bg-primary">
            <h3 class="panel-title text-light"> SARAN BERDASARKAN NILAI KEPERCAYAAN </h3>
        </div>
        <div class="panel-body bg-success-subtle">
            <h1></h1>
            <p>jika nilai kepercayaan 15% - 25% maka disarankan untuk melaukan pengeceka ke klinik atau rumah
                sakit</p><br>
            <p>jika nilai kepercayaan 25% - 50% maka disarankan untuk melaukan konsultasi ke dokter atau pakar
            </p><br>
            <p>jika nilai kepercayaan 50% - 100% maka disarankan untuk melaukan perawatan intensif</p><br>
        </div>
    </div>
    <?php
    echo $c;
    ?>
    <?php
    include "footer.php";
    ?>

    <script>
        $(document).ready(function () {
            $("form").submit(function (e) {
                var checkboxes = $("input[type=\'checkbox\']");
                var checked = false;

                checkboxes.each(function () {
                    if ($(this).is(":checked")) {
                        checked = true;
                        return false;
                    }
                });

                if (!checked) {
                    e.preventDefault(); // Mencegah pengiriman form jika tidak ada checkbox yang dipilih
                    alert("Pilih setidaknya satu checkbox.");
                }
            });
        });

    </script>

    <?php
    echo $pilihpas;
    include 'end.php';
    ?>