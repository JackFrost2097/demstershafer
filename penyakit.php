<?php
// Memulai session
session_start();

// Cek apakah session username dan level admin telah terdaftar
if (isset($_SESSION['username']) && $_SESSION['level'] == 1) {
    // Tampilkan konten halaman untuk level admin
    //echo "Selamat datang, " . $_SESSION['username'] . "! Anda sedang berada di halaman admin.";
    $b = '<div class="col-sm-11 ">';
    $c = '</div>';
    include "functions.php";
    include "head.php";
    include "navbar.php";
} elseif (isset($_SESSION['username']) && $_SESSION['level'] == 2) {

    // Tampilkan konten halaman untuk level admin
    //echo "Selamat datang, " . $_SESSION['username'] . "! Anda sedang berada di halaman admin.";
    $a = '<a class="nav-link" href="logout.php">Logout</a>';
    $b = '<div class="col-sm-12 container pt-3">';
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
    include "functions.php";
    echo "<style>.ara { display: none; }</style>";
    include "navbaruser.php";

}
$pil = tampil("SELECT * FROM penyakit");

if (isset($_POST['tambah'])) {
    if (tambahpenyakit($_POST) > 0) {
        echo "
        <script>
            alert('Berhasil Bro');
            document.location.href = 'penyakit.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Gagal Bro');
            document.location.href = 'penyakit.php';
        </script>";
    }
}
if (isset($_POST['update'])) {
    if (ubahpenyakit($_POST) > 0) {
        echo "
        <script>
            alert('Berhasil UPdate Bro');
            document.location.href = 'penyakit.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Gagal Bro');
            document.location.href = 'penyakit.php';
        </script>";
    }
}
if (isset($_POST['delete'])) {
    if (hapuspenyakit($_POST) > 0) {
        echo "
        <script>
            alert('Berhasil delete Bro');
            document.location.href = 'penyakit.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Gagal Bro');
            document.location.href = 'penyakit.php';
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
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Data Penyakit</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" class="form-control text-center p-5" method="post">
                    <p>Kode Penyakit</p>
                    <input type="text" name="kodepenyakit" id="kodepenyakit" class="form-control" required>
                    <p>Nama Penyakit</p>
                    <input type="text" name="namapenyakit" id="namapenyakit " class="form-control" required>
                    <p>Keterangan</p>
                    <textarea name="keterangan" class="form-control" required></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>

<?php echo $b; ?>
<h1>Daftar Penyakit</h1>
<table class="pt-5 table table-primary table-striped text-center ">
    <thead class="sticky-header pt-5">
        <tr>
            <td scope="col" colspan="6" class="text-end">
                <button type="button" class="btn btn-primary ara" data-bs-toggle="modal"
                    data-bs-target="#staticBackdrop">+
                    Penyakit</button>
            </td>
        </tr>
        <tr>
            <th scope="col">
                No
            </th>
            <th scope="col">
                Kode Penyakit
            </th>
            <th scope="col">
                Nama Penyakit
            </th>
            <th scope="col">
                Keterangan
            </th>
            <th scope="col" colspan="2" class="ara">
                Action
            </th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach ($pil as $row):
            ?>
            <tr>
                <td>
                    <?php echo $no;
                    $no++; ?>
                </td>
                <td>
                    <?= $row["kodepenyakit"]; ?>
                </td>
                <td>
                    <?= $row["namapenyakit"]; ?>
                </td>
                <td>
                    <?= $row["keterangan"]; ?>
                </td>
                <td>
                    <button type="button" class="btn btn-warning ara" data-bs-toggle="modal"
                        data-bs-target="#updatedata<?= $row['idpenyakit']; ?>">
                        update
                    </button>
                </td>
                </td>
                <td>
                    <button type="button" class="btn btn-danger ara" data-bs-toggle="modal"
                        data-bs-target="#deletedata<?= $row['idpenyakit']; ?>">
                        Delete
                    </button>
                </td>
            </tr>
            <!-- Modal Update DATA-->
            <div class="modal fade" id="updatedata<?= $row['idpenyakit']; ?>" data-bs-backdrop="static"
                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Data Penyakit</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" class="form-control text-center p-5" method="post">
                                <input type="hidden" name="idpenyakit" value="<?= $row['idpenyakit']; ?>">
                                <p>Kode Penyakit</p>
                                <input type="text" name="kodepenyakit" id="kodepenyakit" class="form-control" required>
                                <p>Nama Penyakit</p>
                                <input type="text" name="namapenyakit" id="namapenyakit " class="form-control" required>
                                <p>Keterangan</p>
                                <textarea name="keterangan" class="form-control"></textarea>
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
            <div class="modal fade" id="deletedata<?= $row['idpenyakit']; ?>" data-bs-backdrop="static"
                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Data Penyakit</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post">
                                <input type="hidden" name="idpenyakit" value="<?= $row['idpenyakit']; ?>">
                                <p>Kode Penyakit :
                                    <?= $row['kodepenyakit']; ?>
                                </p>
                                <p>Nama Penyakit :
                                    <?= $row['namapenyakit']; ?>
                                </p>
                                <p>Keterangan :
                                    <?= $row['keterangan']; ?>
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
<?php
echo $c;
include 'footer.php';
include 'end.php';
?>