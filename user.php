<?php
include('head.php');
include('functions.php');
if (isset($_POST['daftar'])) {
    $username = $_POST['username'];
    $usernama = $_POST['usernama'];
    $useralamat = $_POST['useralamat'];
    $userpassword = $_POST['userpassword'];
    $userlevel = $_POST['userlevel'];
    $usertgllahir = $_POST['usertgllahir'];
    $usergender = $_POST['usergender'];
    $nampil = "INSERT INTO user (username, usernama, useralamat, userpassword, userlevel, usertgllahir, usergender)
VALUES ('$username', '$usernama', '$useralamat', '$userpassword', '$userlevel', '$usertgllahir', '$usergender')";

    if ($db->query($nampil) === TRUE) { ?>
        <script>
            alert('Daftar Berhasil');
            document.location = "login.php";
        </script>
        <?php
    } else { ?>
        <script>
            alert('Daftar GAGAL '.$sql. "-".$db -> error; ?>);
            documet.location = "user.php";
        </script>
        <?php
    }
}

?>

<div class="container-fluid bg-secondary">
    <div class="row bg-dark pt-5 pb-5">
        <div class="col-sm-12 col-md-4"></div>
        <div class="col-sm-12 col-md-4 bg-secondary pt-4 pb-4">
            <form action="<?php $post ?>" method="post" class="  form-control pt-5">
                <h1 class="text-center"> Daftar Akun</h1>
                <div class="row">
                    <div class="col-6">
                        <p class="pb-1 pt-2">Nama</p>
                        <input class="form-control  " type="text" name="usernama" id="usernama" required>
                        <p class="pb-1 pt-2">Tanggal Lahir</p>
                        <input class="form-control  " type="date" name="usertgllahir" id="usertgllahir" required>
                        <p class="pb-1 pt-2">Username</p>
                        <input class="form-control  " type="text" name="username" id="username required">
                    </div>
                    <div class=" col-md-6">
                        <p class="pb-1 pt-2">Alamat</p>
                        <input class="form-control " type="text" name="useralamat" id="useralamat" required>
                        <p class="pb-1 pt-2">Jenis Kelamin</p>
                        <input type="radio" name="usergender" id="usergender" value="lk"> Laki Laki
                        <br>
                        <input type="radio" name="usergender" id="usergender" value="pr"> Perempuan
                        <p class=" pb-1 pt-2">Password</p>
                        <input class="form-control " type="password" name="userpassword" id="userpassword" required>
                    </div>
                    <input type="hidden" name="userlevel" id="userlevel" value="1">
                </div>
                <br>
                <br>
                <input class="btn btn-primary" type="submit" value="Daftar" name="daftar">
            </form>
        </div>
        <div class="col-sm-12 col-md-4 "></div>
    </div>
</div>