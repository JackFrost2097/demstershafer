<?php

session_start();
include('head.php');
require 'functions.php';


if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['userlevel'];

    // Query untuk mendapatkan data pengguna berdasarkan username dan password
    $query = "SELECT * FROM user WHERE username = '$username' AND userpassword = '$password' AND userlevel = '$level'";
    $result = mysqli_query($db, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        // Autentikasi berhasil
        $_SESSION['username'] = $user['username'];
        $_SESSION['password'] = $user['password'];
        $_SESSION['level'] = $user['userlevel'];

        if ($user['userlevel'] == 1) {
            // Jika level admin (level = 1), redirect ke halaman admin
            header("Location: index.php");
        } elseif ($user['userlevel'] == 2) {
            // Jika level user (level = 2), redirect ke halaman user
            header("Location: index.php");
        }
    } else {
        // Autentikasi gagal

        echo "
        <script>
            alert('username atau password salah bro');;
        </script>";
    }
}

?>


<!-- copy code from here -->
<br>
<br>
<div class="row">
    <div class="col-sm-12 col-md-4"></div>
    <div class="col-sm-12 col-md-4">
        <div class="card mb-5">
            <a href="index.php">HOME</a>
            <h4 class="card-title text-center mt-5 mb-4 text-primary">
                Sign in
            </h4>
            <div class="container p-3">
                <form action="" method="post" class="form-control border border-success">
                    <div class="row">
                        <div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-3">
                            <div class="form-label">Username</div>
                            <input type="text" name="username" class="form-control" required />
                        </div>

                        <div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-3">
                            <div class="form-label">Password</div>
                            <input type="password" name="password" class="form-control" required />
                        </div>
                        <div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-3">
                            <center>
                                <input type="radio" name="userlevel" class="form-check-input" value="2" required />
                                Pasien
                                <input type="radio" name="userlevel" class="form-check-input" value="1" required />
                                Pakar
                            </center>
                        </div>
                        <div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-3">
                            <a href="#" class="text-dark text-decoration-none">Forgot password?</a>
                        </div>
                        <div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-3">
                            <center>
                                <button class="btn btn-primary" type="submit" name="login">
                                    Login
                                </button>
                            </center>
                        </div>
                        <div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-5">
                            <center>
                                <a href="daftar.php" class="text-decoration-none text-center text-primary">Gak Ada
                                    AKUN ? ,
                                    DAFTAR</a>
                            </center>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- copy code upto here -->
    <div class="col-sm-12 col-md-4"></div>
</div>