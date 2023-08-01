<?php

session_start();

if( !isset ($_SESSION["login"])) {
    header("location : login.php");
    exit;
}


require 'functions.php';

if( isset($_POST["submit"]) ) {


    if (tambah($_POST) > 0 ) {
        echo "
          <script>
              alert ('Data berhasil ditambahkan')
              document.location.href = 'index.php'
          </script>
        
        ";

    }
    else {
        echo "
        <script>
             alert ('Data gagal ditambahkan')
             
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
    <title>tambah data mahasiswa</title>
</head>
<body>
    <h1>tambah data mahasiswa</h1>
    
<form action="" method="post" enctype="multipart/form-data"> 
    <label for="nrp">nrp</label>
    <input type="text" name="nrp" id="nrp" required>
<br>
<br>
    <label for="nama">nama</label>
    <input type="text" name="nama" id="nama" required>
<br>
<br>
    <label for="email">email</label>
    <input type="text" name="email" id="email" required >
<br>
<br>
    <label for="jurusan">jurusan</label>
    <input type="text" name="jurusan" id="jurusan" required>
<br>
<br>
    <label for="gambar">gambar</label>
    <input type="file" name="gambar" id="gambar" required>
<br>
<br>
    <button type="submit" name="submit">tambah data</button>
    </form>
    
   
</body>
</html>