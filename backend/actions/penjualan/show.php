<?php
if (!isset($_GET['id'])) {
    echo "<script>alert('Tidak Bisa memilih ID ini');
    \n window.location.href = '../../pages/sapi/index.php';\n 
    </script>\n 
    ";
}

$id = $_GET['id'];

$qSelect = "SELECT * FROM sapi WHERE id='$id'";
$result = mysqli_query($connect, $qSelect) or die(mysqli_error($connect));

$sapi = $result->fetch_object();
if (!$sapi) {
    die("Data tidak ditemukan");
}
