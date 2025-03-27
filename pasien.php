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
$pil = tampil("SELECT * FROM pasien");

if (isset($_POST['tambah'])) {
    if (adduser($_POST) > 0) {
        echo "
        <script>
            alert('Berhasil Bro');
            document.location.href = 'pasien.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Gagal Bro');
            document.location.href = 'pasien.php';
        </script>";
    }
}
if (isset($_POST['update'])) {
    if (ubahpasien($_POST) > 0) {
        echo "
        <script>
            alert('Berhasil UPdate Bro');
            document.location.href = 'pasien.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Gagal Bro');
            document.location.href = 'pasien.php';
        </script>";
    }
}
if (isset($_POST['delete'])) {
    if (hapuspasien($_POST) > 0) {
        echo "
        <script>
            alert('Berhasil delete Bro');
            document.location.href = 'pasien.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Gagal Bro');
            document.location.href = 'pasien.php';
        </script>";
    }
}
?>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Data pasien</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" class="text-center p-5 bg-primary-subtle" method="post">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="userpassword" name="userpassword"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="usertgllahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="usertgllahir" name="usertgllahir" required>
                            </div>
                            <div class="mb-3">
                                <label for="gender" class="form-label">Jenis Kelamin</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="usergender" id="gender_l"
                                        value="Lk" required>
                                    <label class="form-check-label" for="gender_l">Laki-laki</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="usergender" id="gender_p"
                                        value="Pr" required>
                                    <label class="form-check-label" for="gender_p">Perempuan</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="usernama" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="usernama" name="usernama" required>
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control" id="alamat" name="useralamat" rows="3"
                                    required></textarea>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="userlevel" value="2">
                            </div>
                            <div class="mb-3">
                                <a class="btn bg-primary-subtle" href="index.php">Back HOME</a>
                            </div>
                        </div>
                    </div>
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
    <table class="pt-5 table table-primary table-striped text-center table-bordered">
        <tr>
            <td colspan="7" class="text-end"> <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#staticBackdrop">+ pasien</button></td>
        </tr>
        <tr>
            <th>
                No
            </th>
            <th>
                Nama pasien
            </th>
            <th>
                Alamat pasien
            </th>
            <th>
                Umur pasien
            </th>
            <th>
                Tanggal Lahir
            </th>
            <th colspan="2">
                Action
            </th>
        </tr>
        <?php $no = 1;
        foreach ($pil as $row):
            ?>
            <tr>
                <td>
                    <?php echo $no;
                    $no++; ?>
                </td>
                <td>
                    <?= $row["usernama"]; ?>
                </td>
                <td>
                    <?= $row["useralamat"]; ?>
                </td>
                <td>
                    <?= $row["umur"]; ?>
                </td>
                <td>
                    <?= $row["usertgllahir"]; ?>
                </td>
                <td>
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                        data-bs-target="#updatedata<?= $row['idpasien']; ?>">
                        update
                    </button>
                </td>
                </td>
                <td>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#deletedata<?= $row['idpasien']; ?>">
                        Delete
                    </button>
                </td>
            </tr>
            <!-- Modal Update DATA-->
            <div class="modal fade" id="updatedata<?= $row['idpasien']; ?>" data-bs-backdrop="static"
                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Data pasien</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" class="form-control text-center p-5" method="post">
                                <input type="hidden" name="idpasien" value="<?= $row['idpasien']; ?>">
                                <p>Kode pasien</p>
                                <input type="text" name="usernama" class="form-control" required
                                    value="<?= $row['usernama']; ?>">
                                <p>Nama pasien</p>
                                <input type="text" name="useralamat" class="form-control" required
                                    value="<?= $row['useralamat']; ?>">
                                <p>Umur </p>
                                <input type="number" name="umur" class="form-control" value="<?= $row['umur']; ?>">
                                <p>Tanggal Lahir </p>
                                <input type="date" name="usertgllahir" class="form-control" required
                                    value="<?= $row['usertgllahir']; ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="update" class="btn btn-warning">Update</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end of modal update -->

            <!-- Modal Delete DATA-->
            <div class="modal fade" id="deletedata<?= $row['idpasien']; ?>" data-bs-backdrop="static"
                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Data pasien</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post">
                                <input type="hidden" name="idpasien" value="<?= $row['idpasien']; ?>">
                                <p>Kode pasien :
                                    <?= $row['kodepasien']; ?>
                                </p>
                                <p>Nama pasien :
                                    <?= $row['namapasien']; ?>
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
    </table>
</div>
<?php
include "footer.php";
include 'end.php';
?>