<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $db = mysqli_connect('localhost', 'root', '', 'testt');
    //-- halt and show error message if connection fail
    if (!$db) {
        die('Connect Error (' . $db->connect_errno . ')' . $db->connect_error);
    }
    function tampil($nampil)
    {
        global $db;
        $result = mysqli_query($db, $nampil);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    } //END UNTUK UMUM
    function tambahbasis($add)
    {
        global $db;
        $idpenyakit = $add['idpenyakit'];
        $idgejala = $add['idgejala'];
        $bobot = $add['bobot'];
        if (!empty($idgejala)) {
            foreach ($idgejala as $gejala) {
                $query = "INSERT INTO basis VALUES ('','$idpenyakit','$gejala' ,'$bobot')";
                mysqli_query($db, $query);
            }
            return mysqli_affected_rows($db);
        }
        return 0;
    }
    if (isset($_POST['kirim'])) {
        if (tambahbasis($_POST) > 0) {
            echo "
            <script>
                alert('Berhasil UPdate Bro');
                document.location.href = 'test3.php';
            </script>";
        } else {
            echo "
            <script>
                alert('Gagal Bro');
                document.location.href = 'test3.php';
            </script>";
        }
    }
    ?>
    <form action="" method="post">
        <p>idpenyakit</p>
        <input type="text" name="idpenyakit">
        <p>id gejala</p>
        <?php
        for ($a = 0; $a < 10; $a++) {
            ?>
            <input type="checkbox" name="idgejala[] " value="<?= $a; ?>" id="id_checkbox">
            <label for="id_checkbox">
                <?= $a; ?>
            </label>
            <?php
        }
        ?>
        <input type="number" name="bobot" id="" min="0" max="1" step="0.1">
        <button type="submit" name="kirim">tambah data</button>
    </form>
    <?php
    $data = tampil("select * from basis");
    ?>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>IDa</th>
            <th>IDb</th>
            <th>BBt</th>
        </tr>
        <?php
        foreach ($data as $row):
            ?>
            <tr>
                <td>
                    <?= $row['id']; ?>
                </td>
                <td>
                    <?= $row['ida']; ?>
                </td>
                <td>
                    <?= $row['idb']; ?>
                </td>
                <td>
                    <?= $row['bbt']; ?>
                </td>
            </tr>
            <?php
        endforeach;
        ?>
    </table>

    <?php foreach ($isig as $gejala): ?>
        <tr>
            <td><input type="checkbox" name="idgejala[]" value="<?= $isip['idgejala']; ?>"
                    id="checkbox_<?= $isip['idgejala']; ?>"></td>
            <td>
                <label for="checkbox_<?= $isip['idgejala']; ?>">
                    <?= "G0" . $isip['idgejala']; ?>. ‎<?= $isip['namagejala']; ?>
                </label>
            </td>
        </tr>
    <?php endforeach; ?>

</body>

</html>