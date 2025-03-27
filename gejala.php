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
    $b = '<div class="col-sm-12 container">';
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
    echo "<style>.araa { display: none; }</style>";
    include "navbaruser.php";
}
$pil = tampil("SELECT * FROM gejala");

if (isset($_POST['tambah'])) {
    if (tambahgejala($_POST) > 0) {
        echo "
        <script>
            alert('Berhasil Bro');
            document.location.href = 'gejala.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Gagal Bro');
            document.location.href = 'gejala.php';
        </script>";
    }
}
if (isset($_POST['update'])) {
    if (ubahgejala($_POST) > 0) {
        echo "
        <script>
            alert('Berhasil UPdate Bro');
            document.location.href = 'gejala.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Gagal Bro');
            document.location.href = 'gejala.php';
        </script>";
    }
}
if (isset($_POST['delete'])) {
    if (hapusgejala($_POST) > 0) {
        echo "
        <script>
            alert('Berhasil delete Bro');
            document.location.href = 'gejala.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Gagal Bro');
            document.location.href = 'gejala.php';
        </script>";
    }
}
?>
<!-- Modal Tambah-->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Data gejala</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" class="form-control text-center p-5" method="post">
                    <p>Kode gejala</p>
                    <input type="text" name="kodegejala" id="kodegejala" class="form-control" required>
                    <p>Nama gejala</p>
                    <input type="text" name="namagejala" id="namagejala " class="form-control" required>
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
<h1>Daftar Gejala</h1>
<table class="table table-hover pt-5 table-primary table-striped text-center table-bordered">
    <thead class="sticky-header">
        <tr>
            <td scope="col" colspan="5" class="text-start">
                <button type="button" class="btn btn-primary ara" data-bs-toggle="modal"
                    data-bs-target="#staticBackdrop">+ Gejala</button>
            </td>
        </tr>
        <tr>
            <th scope="col">
                No
            </th>
            <th scope="col">
                Kode Gejala
            </th>
            <th scope="col">
                Nama Gejala
            </th>
            <th colspan="2" class="ara" scope="col">
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
                    <?= $row["kodegejala"]; ?>
                </td>
                <td>
                    <?= $row["namagejala"]; ?>
                </td>
                <td class="ara">
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                        data-bs-target="#updatedata<?= $row['idgejala']; ?>">
                        update
                    </button>
                </td>
                <td class="ara">
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#deletedata<?= $row['idgejala']; ?>">
                        Delete
                    </button>
                </td>
            </tr>
            <!-- Modal Update DATA-->
            <div class="ara modal fade" id="updatedata<?= $row['idgejala']; ?>" data-bs-backdrop="static"
                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Data gejala</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" class="form-control text-center p-5" method="post">
                                <input type="hidden" name="idgejala" value="<?= $row['idgejala']; ?>">
                                <p>Kode gejala</p>
                                <input type="text" name="kodegejala" id="kodegejala" class="form-control" required
                                    value="<?= $row['kodegejala']; ?>">
                                <p>Nama gejala</p>
                                <input type="text" name="namagejala" id="namagejala " class="form-control" required
                                    value="<?= $row['namagejala']; ?>">
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
            <div class="modal fade" id="deletedata<?= $row['idgejala']; ?>" data-bs-backdrop="static"
                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Data gejala</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post">
                                <input type="hidden" name="idgejala" value="<?= $row['idgejala']; ?>">
                                <p>Kode gejala :
                                    <?= $row['kodegejala']; ?>
                                </p>
                                <p>Nama gejala :
                                    <?= $row['namagejala']; ?>
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
<?php echo $c;
include "footer.php";
include 'end.php';
?>