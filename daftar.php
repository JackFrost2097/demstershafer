<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>

<body>
    <?php
    require 'functions.php';

    if (isset($_POST['daftar'])) {
        if (adduser($_POST) > 0) {
            echo "
        <script>
            alert('Berhasil Bro');
            document.location.href = 'login.php';
        </script>";
        } else {
            echo "
        <script>
            alert('Gagal Bro');
            document.location.href = 'daftar.php';
        </script>";
        }
    }
    ?>
    <div class="container  align-items-center vh-100 ">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <h1>Form Pendaftaran</h1>
                <form method="POST" action="" class=" row border border-success p-3">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="userpassword" name="userpassword" required>
                        </div>
                        <div class="mb-3">
                            <label for="usertgllahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="usertgllahir" name="usertgllahir" required>
                        </div>
                        <div class="mb-3">
                            <label for="gender" class="form-label">Jenis Kelamin</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="usergender" id="gender_l" value="Lk"
                                    required>
                                <label class="form-check-label" for="gender_l">Laki-laki</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="usergender" id="gender_p" value="Pr"
                                    required>
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
                            <textarea class="form-control" id="alamat" name="useralamat" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <input type="hidden" name="userlevel" value="2">
                        </div>
                        <div class="mb-3">
                            <a class="btn bg-primary-subtle" href="index.php">Back HOME</a>
                        </div>
                    </div>
                    <button type="submit" name="daftar" class="btn btn-primary">Daftar</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>