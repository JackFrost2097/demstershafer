<?php
session_start();
unset($_SESSION['username']);
unset($_SESSION['password']);
unset($_SESSION['userlevel']);
echo "
<script>
    alert('anda sudah logout Bro');
    document.location.href = 'index.php';
    </script>
    ";
?>