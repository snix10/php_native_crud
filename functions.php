<?php
// koneksi ke database
$conn = mysqli_connect("localhost","root","","mahasiswa");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row ;
    }
    return $rows;
}



function tambah($data) {
        global $conn;

        
        $nrp = htmlspecialchars ($_POST ["nrp"]) ;
        $nama = htmlspecialchars ($_POST ["nama"] ) ;
        $email = htmlspecialchars ($_POST ["email"]) ;
        $jurusan = htmlspecialchars ($_POST ["jurusan"]) ;
        

        $gambar = upload();
        
        if(!$gambar) {
            return false;
        }
    
    
        $query= "INSERT INTO mahasiswa VALUES
                  ('','$nama', '$nrp' ,'$jurusan' ,'$email' ,'$gambar')";
        
        mysqli_query($conn,$query);

        return mysqli_affected_rows($conn);


}


function upload() {
    
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    if ($error === 4 ) {
        echo "
             <script>
                  alert('pilih gambar terlebih dahulu');
             </script> ";
        return false;

     }
 
       $ektensiGambarValid = ['jpg', 'jpeg','png'];
       $ektensiGambar = explode('.', $namaFile);
       $ektensiGambar = strtolower (end ($ektensiGambar) );
       if (!in_array ($ektensiGambar, $ektensiGambarValid) ) {
         
        echo "<script>
                    alert('yang anda upload bukan gambar');
               </script>";
         return false;
       }

       if( $ukuranFile > 1000000) {
        echo "<script>
                 alert('ukuran gambar terlalu besar');
             </script>";
        return false;
       }


       $namaFileBaru = uniqid();
       $namaFileBaru .= '.';
       $namaFileBaru .= $ektensiGambar;

        move_uploaded_file($tmpName, 'asset/' . $namaFileBaru);

        return $namaFileBaru;
          
}

 
function hapus($id) {
    global $conn ;
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id ");
    return mysqli_affected_rows ($conn);
}



    function ubah($data) {
        global $conn;

        $id = $data ["id"];
        $nrp = htmlspecialchars ($data ["nrp"]) ;
        $nama = htmlspecialchars ($data ["nama"] ) ;
        $email = htmlspecialchars ($data ["email"]) ;
        $jurusan = htmlspecialchars ($data ["jurusan"]) ;
        
        $gambarLama =  htmlspecialchars ($data ["gambarLama"]) ;
        if ($_FILES['gambar']['error'] === 4) {
            $gambar = $gambarLama ; 
        } else {
            $gambar = upload() ;
        }



       
    
    
        $query= "UPDATE mahasiswa SET 
                    nrp = '$nrp',
                    nama = '$nama',
                    email = '$email',
                    jurusan = '$jurusan',
                    gambar = '$gambar'
                 WHERE id = $id
                    ";
        
        mysqli_query($conn,$query);

        return mysqli_affected_rows($conn);


}

function cari($keyword) {
    $query = "SELECT * FROM mahasiswa WHERE
                  nama LIKE '%$keyword%' OR
                  nrp LIKE '%$keyword%' OR
                  email LIKE '%$keyword%' OR
                  jurusan LIKE '%$keyword%'

             ";

     return query($query);
}


function registrasi($data) {
    global $conn;

    $username =strtolower (stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn,$data["password"]);
    $password2 = mysqli_real_escape_string($conn,$data["password2"]);
     

       $result = mysqli_query($conn, "SELECT username FROM user WHERE username= '$username'");
       if(mysqli_fetch_assoc($result)) {
        echo  "<script>
                   alert('username yang dipilih sudah terdaftar');
              </script>";
              return false;
       }


     if($password !== $password2) {
         echo "<script>
              alert ('konfirmasi password tidak sesuai');
         </script>";
             return false;

     } 


       $password = password_hash($password, PASSWORD_DEFAULT);
    

     mysqli_query($conn, "INSERT INTO user VALUES('','$username','$password')");
     
     return mysqli_affected_rows($conn);


}

?>