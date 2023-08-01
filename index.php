<?php


session_start();

if( !isset ($_SESSION["login"])) {
    header("location : login.php");
    exit;
}


require 'functions.php';

$mahasiswa = query("SELECT * FROM mahasiswa");

if ( isset($_POST["cari"])) {
    $mahasiswa = cari($_POST["keyword"]);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>halaman admin</title>
</head>
<body>

<a href = "logout.php">logout</a>

<h1>daftar mahasiswa</h1>

<a href="tambah.php">tambah data mahasiswa</a>
<br>
<br>
<form action="" method="post">
    <input type="text" name="keyword" placeholder="cari..." autocomplete="off">
    <button type="submit" name="cari">cari</button>
</form>
<br>

<table background="salmon" padding="1" cellpadding="10" cellspacing="0">
    <tr>  
          <th>no</th>
          <th>aksi</th>
          <th>gambar</th>
          <th>nrp</th>
          <th>nama</th>
          <th>email</th>
          <th>jurusan</th>
    </tr> 
    <?php $i = 1 ; ?>  
    <?php foreach($mahasiswa as $row) : ?>
    <tr>
        <td><?= $i; ?></td>
        <td>
            <a href="ubah.php?id=<?= $row["id"] ; ?>">ubah</a> |
            <a href="hapus.php?id=<?= $row["id"] ; ?>" onclick="return confirm ('anda yakin ingin menghapusnya?')">hapus</a>
        </td>
        <td><img src="asset/<?= $row["gambar"] ; ?>" alt=""></td>
        <td><?= $row["nrp"] ; ?></td>
        <td><?= $row["nama"] ; ?></td>
        <td><?= $row["email"] ; ?></td>
        <td><?= $row["jurusan"] ; ?></td>
        
    </tr>
    <?php $i++ ?>
    <?php endforeach; ?>



</table>
</body>
</html>