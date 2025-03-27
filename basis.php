<?php
// Memulai session
session_start();
// Cek apakah session username dan level admin telah terdaftar
if (isset($_SESSION['username']) && $_SESSION['level'] == 1) {
    // Tampilkan konten halaman untuk level admin
    //echo "Selamat datang, " . $_SESSION['username'] . "! Anda sedang berada di halaman admin.";
    include "functions.php";
    include "head.php";
    include "navbar.php";
} elseif (isset($_SESSION['username']) && $_SESSION['level'] == 2) {

    // Tampilkan konten halaman untuk level admin
    //echo "Selamat datang, " . $_SESSION['username'] . "! Anda sedang berada di halaman admin.";
    include "functions.php";
    include "head.php";
    include "navbaruser.php";
    echo "
        <script>
            alert('KAmu bukan Admin');
            document.location.href = 'index.php';
        </script>";
} else {
    // Jika session tidak terdaftar atau level bukan admin, redirect ke halaman login
    echo "
        <script>
            alert('Login dulu bro Bro');
            document.location.href = 'login.php';
        </script>";
    exit();
}
$pil = tampil("SELECT * FROM basis");
$penyakit = tampil("SELECT * FROM penyakit");
$gejala = tampil("SELECT * FROM gejala");

if (isset($_POST['tambah'])) {
    if (tambahbasis($_POST) > 0) {
        echo "
        <script>
            alert('Berhasil Bro');
            document.location.href = 'basis.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Gagal Bro');
            document.location.href = 'basis.php';
        </script>";
    }
}
if (isset($_POST['update'])) {
    if (ubahbasis($_POST) > 0) {
        echo "
        <script>
            alert('Berhasil UPdate Bro');
            document.location.href = 'basis.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Gagal Bro');
            document.location.href = 'basis.php';
        </script>";
    }
}
if (isset($_POST['delete'])) {
    if (hapusbasis($_POST) > 0) {
        echo "
        <script>
            alert('Berhasil delete Bro');
            document.location.href = 'basis.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Gagal Bro');
            document.location.href = 'basis.php';
        </script>";
    }
}
?>
<!-- Modal Tambah-->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Data pasien</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" class="form-control bg-primary-subtle border border-success p-5" method="post">
                    <p>Id Gejala</p>
                    <select name="idgejala" class="form-select">
                        <?php foreach ($gejala as $isig): ?>
                            <option value=<?= $isig['idgejala']; ?>>
                                <?= "G0" . $isig['idgejala']; ?>.‎ <?= $isig['namagejala']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <table class="table table-primary table-responsive ">
                        <thead>
                            <th colspan="3">
                                <p>Id Penyakit</p>
                            </th>
                        </thead>
                        <tbody>
                            <?php foreach ($penyakit as $isip): ?>
                                <tr>
                                    <td class="p-3" colspan="2">
                                        <input type="checkbox" name="idpenyakit[]" value=<?= $isip['idpenyakit']; ?>>
                                    </td>
                                    <td>
                                        <label>
                                            <?= "P0" . $isip['idpenyakit']; ?>. ‎
                                            <?= $isip['namapenyakit']; ?>
                                        </label>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <p>Bobot</p>
                    <input type=" number" name="bobot" class="form-control" placeholder='MIN=0.1 MAX=1' min='0'
                        step="0.01" max='1' required>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="col-md-11 pt-5">
    <h1>Basis Pengetahuan</h1>
    <br><br>
    <table class="table-hover pt-5 table table-primary table-striped text-center table-bordered">
        <thead class="sticky-header">
            <tr>
                <td scope="col" colspan="7" class="text-end"> <button type="button" class="btn btn-primary"
                        data-bs-toggle="modal" data-bs-target="#staticBackdrop">+ Gejala</button></td>
            </tr>
            <tr>
                <th>
                    No
                </th>
                <th>
                    Id Gejala
                </th>
                <th>
                    Id Penyakit
                </th>
                <th>
                    Bobot
                </th>
                <th colspan="2">
                    Action
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
                        <?= "G0" . $row["idgejala"]; ?>
                    </td>
                    <td>
                        <?= "P0" . $row["idpenyakit"]; ?>
                    </td>
                    <td>
                        <?= $row["bobot"]; ?>
                    </td>
                    <td>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                            data-bs-target="#updatedata<?= $row['idbasis']; ?>">
                            update
                        </button>
                    </td>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#deletedata<?= $row['idbasis']; ?>">
                            Delete
                        </button>
                    </td>
                </tr>
                <!-- Modal Update DATA-->
                <div class="modal fade" id="updatedata<?= $row['idbasis']; ?>" data-bs-backdrop="static"
                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">DATA Basis Pengetahuan</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="" class="form-control text-center p-5" method="post">
                                    <p>Pilih penyakit</p>
                                    <select class="form-select" name="idpenyakit">
                                        <?php foreach ($penyakit as $isip): ?>
                                            <option value=<?= $isip['idpenyakit']; ?>>
                                                <?= "P0" . $isip['idpenyakit']; ?>.‎ <?= $isip['namapenyakit']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <p>Pilih Gejala</p>
                                    <select class="form-select" name="idgejala">
                                        <?php foreach ($gejala as $isig): ?>
                                            <option value=<?= $isig['idgejala']; ?>>
                                                <?= "G0" . $isig['idgejala']; ?>‎ . ‎
                                                <?= $isig['namagejala']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <p>Bobot</p>
                                    <input step="0.1" min="0" max="1" type="number" name="bobot"
                                        value="<?= $row['bobot'] ?>" class="form-control">
                                    <input type="hidden" name="idbasis" value=<?= $row['idbasis']; ?>>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="update" class="btn btn-warning">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end of modal update -->
                <!--- ||||| ----->
            <!-- Modal Delete DATA-->
                <div class="modal fade" id="deletedata<?= $row['idbasis']; ?>" data-bs-backdrop="static"
                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Data basis</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post">
                                    <input type="hidden" name="idbasis" value="<?= $row['idbasis']; ?>">
                                    <p>Id Penyakit :
                                        <?= "P0" . $row['idpenyakit']; ?>
                                    </p>
                                    <p>Id gejala :
                                        <?= "G0" . $row['idgejala']; ?>
                                    </p>
                                    </p>
                                    <p>Bobot :
                                        <?= $row['bobot']; ?>
                                    </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end of modal delete -->
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php
include 'footer.php';
?>
<script>
    $(document).ready(function () {

        $('td').click(function () {
            var checkbox = $(this).find('input[type="checkbox"]');
            checkbox.prop('checked', !checkbox.prop('checked'));
        });

        function myFunction() {
            var x = document.getElementById("sembunyi");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }

    });
</script>
<?php
include 'end.php';
?>