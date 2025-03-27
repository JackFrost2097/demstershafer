<?php
$db = mysqli_connect('localhost', 'root', '', 'sistempakarpenyakit');
//-- halt and show error message if connection fail
if (!$db) {
    die('Connect Error (' . $db->connect_errno . ')' . $db->connect_error);
}


//UTNUK UMUM
function tampil($nampil)
{
    global $db;
    $result = mysqli_query($db, $nampil);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}
//END UNTUK UMUM

// PENYAKIT PUNYA KELUARGA
function tambahpenyakit($add)
{
    global $db;
    $kdpenyakit = $add['kodepenyakit'];
    $nmpenyakit = $add['namapenyakit'];
    $ketpenyakit = $add['keterangan'];
    $query = "INSERT INTO penyakit VALUES ('','$kdpenyakit','$nmpenyakit','$ketpenyakit')";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}
function ubahpenyakit($ubah)
{
    global $db;
    $id = $ubah['idpenyakit'];
    $kdpenyakit = $ubah['kodepenyakit'];
    $nmpenyakit = $ubah['namapenyakit'];
    $ketpenyakit = $ubah['keterangan'];
    $query = "UPDATE penyakit SET kodepenyakit = '$kdpenyakit', namapenyakit = '$nmpenyakit', keterangan = '$ketpenyakit' WHERE idpenyakit = $id";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function hapuspenyakit($hapus)
{
    global $db;
    $id = $hapus['idpenyakit'];
    $query = "DELETE FROM penyakit WHERE idpenyakit = $id";
    $querys = "ALTER TABLE penyakit AUTO_INCREMENT =1";
    mysqli_query($db, $query);
    mysqli_query($db, $querys);
    return mysqli_affected_rows($db);
} //END UNTUK Penyakit

// GEJALA PUNYA KELUARGA
function tambahgejala($add)
{
    global $db;
    $kdgejala = $add['kodegejala'];
    $nmgejala = $add['namagejala'];
    $query = "INSERT INTO gejala VALUES ('','$kdgejala','$nmgejala')";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}
function ubahgejala($ubah)
{
    global $db;
    $id = $ubah['idgejala'];
    $kdgejala = $ubah['kodegejala'];
    $nmgejala = $ubah['namagejala'];
    $query = "UPDATE gejala SET kodegejala = '$kdgejala', namagejala = '$nmgejala' WHERE idgejala = $id";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function hapusgejala($hapus)
{
    global $db;
    $id = $hapus['idgejala'];
    $query = "DELETE FROM gejala WHERE idgejala = $id";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
} //END UNTUK Gejala

//UNTUK Pasien
function tambahpasien($add)
{
    global $db;
    $nmpasien = $add['usernama'];
    $alapasien = $add['useralamat'];
    $tgllahir = $add['usertgllahir'];

    // Menghitung umur dari tanggal lahir
    $dob = new DateTime($tgllahir);
    $today = new DateTime();
    $umur = $today->diff($dob)->y;

    $query = "INSERT INTO pasien VALUES ('', '$nmpasien', '$alapasien', '$umur', '$tgllahir')";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function ubahpasien($ubah)
{
    global $db;
    $id = $ubah['idpasien'];
    $nmpasien = $ubah['usernama'];
    $alapasien = $ubah['useralamat'];
    $agepasien = $ubah['umur'];
    $tgllahir = $ubah['usertgllahir'];
    $query = "UPDATE pasien SET usernama = '$nmpasien', useralamat = '$alapasien', umur = '$agepasien', usertgllahir = '$tgllahir' WHERE idpasien = $id";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function hapuspasien($hapus)
{
    global $db;
    $id = $hapus['idpasien'];
    $query = "DELETE FROM pasien WHERE idpasien = $id";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}
function tambahbasis($add)
{
    global $db;
    $idpenyakit = $add['idpenyakit'];
    $idgejala = $add['idgejala'];
    $bobot = $add['bobot'];
    if (!empty($idgejala)) {
        foreach ($idpenyakit as $penyakit) {
            $query = "INSERT INTO basis VALUES ('','$penyakit','$idgejala' ,'$bobot')";
            mysqli_query($db, $query);
        }
        return mysqli_affected_rows($db);
    }
    return 0;
}
function hapusbasis($hapus)
{
    global $db;
    $id = $hapus['idbasis'];
    $query = "DELETE FROM basis WHERE idbasis = $id";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}
function ubahbasis($ubah)
{
    global $db;
    $id = $ubah['idbasis'];
    $idpenyakit = $ubah['idpenyakit'];
    $idgejala = $ubah['idgejala'];
    $bobot = $ubah['bobot'];
    $query = "UPDATE basis SET idpenyakit = '$idpenyakit', idgejala = '$idgejala', bobot = '$bobot' WHERE idbasis = $id";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function tampilconcat($tampil)
{
    global $db;
    $result = mysqli_query($db, $tampil);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}





function adduser($add)
{

    global $db;
    $username = $add['username'];
    $usernama = $add['usernama'];
    $useralamat = $add['useralamat'];
    $userpassword = $add['userpassword'];
    $userlevel = $add['userlevel'];
    $usertgllahir = $add['usertgllahir'];
    $sekarang = date('Y-m-d');
    $umur = date_diff(date_create($add['usertgllahir']), date_create($sekarang))->y;
    $usergender = $add['usergender'];
    $query = "INSERT INTO user VALUES ('','$username','$usernama','$useralamat','$userpassword','$userlevel','$usertgllahir','$usergender')";
    $query1 = "INSERT INTO pasien VALUES ('','$usernama','$useralamat','$umur','$usertgllahir')";
    mysqli_query($db, $query);
    mysqli_query($db, $query1);
    return mysqli_affected_rows($db);
}
function hapusriwayat($hapus)
{
    global $db;
    $id = $hapus['idriwayat'];
    $query = "DELETE FROM riwayat WHERE idriwayat = $id";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}
?>