<?php

session_start();

if( !isset ($_SESSION["login"])) {
    header("location : login.php");
    exit;
}

require 'functions.php';

$id = $_GET["id"];

$mhs = query("SELECT * FROM mahasiswa WHERE id = $id ") [0] ;



if( isset($_POST["submit"]) ) {


    if (ubah($_POST) > 0 ) {
        echo "
          <script>
              alert ('Data berhasil diubah')
              document.location.href = 'index.php'
          </script>
        
        ";

    }
    else {
        echo "
        <script>
             alert ('Data gagal diubah')
             
        </script>
        
        ";
    }
   

}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ubah data mahasiswa</title>
</head>
<body>
    <h1>ubah data mahasiswa</h1>

   
    
    <form action="" method="post" enctype="multipart/form-data" >

    <input type="hidden" name="id"  value="<?= $mhs["id"]; ?>">
    <input type="hidden" name="gambarLama"  value="<?= $mhs["gambar"]; ?>">

    <label for="nrp">nrp</label>
    <input type="text" name="nrp" id="nrp" required value="<?= $mhs["nrp"];?>">
<br>
<br>
    <label for="nama">nama</label>
    <input type="text" name="nama" id="nama" required value="<?= $mhs["nama"];?>">
<br>
<br>
    <label for="email">email</label>
    <input type="text" name="email" id="email" required value="<?= $mhs["email"]; ?>">
<br>
<br>
    <label for="jurusan">jurusan</label>
    <input type="text" name="jurusan" id="jurusan" required value="<?= $mhs["jurusan"]; ?>">
<br>
<br>
    <label for="gambar">gambar</label> <br>
    <img src="asset/<?= $mhs['gambar'] ?>" widht="20"> <br>
    <input type="file" name="gambar" id="gambar" >
<br>
<br>
    <button type="submit" name="submit">ubah data</button>
    </form>
    
   
</body>
</html>