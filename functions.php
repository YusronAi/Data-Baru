<?php
$conn = mysqli_connect("localhost", "root", "", "dataBarang");

function tampil($query){
    global $conn;
    $results = mysqli_query($conn, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($results)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data){
    global $conn;

    $nama = htmlspecialchars($data['nama']);
    $jumlah = htmlspecialchars($data['jumlah']);
    $warna = htmlspecialchars($data['warna']);
    
    // upload gambar
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    $query = "INSERT INTO tas VALUES (''
    , '$nama', '$jumlah', '$warna', '$gambar')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload(){
   
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    //Cek apakah tidak ada gambar diupload
    if ($error === 4) {
        echo "
            <script>
            alert('Pilih gambar terlebih dahulu');
            </script>
            ";
            return false;
    }

    //Cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if ( !in_array($ekstensiGambar, $ekstensiGambarValid )) {
        echo "
        <script>
        alert('Yang anda upload bukan gambar!!');
        </script>
        ";
        return false;
    }
    //Cek jika ukuran gambar terlalu besar

    if ( $ukuranFile > 1000000 ) {
        echo "
        <script>
        alert('Ukuran yang anda upload terlalu besar');
        </script>
        ";
        return false;
    }

    //Lolos pengecekan gambar siap diupload
    //Generate nama gambar baru

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'img/'. $namaFile);

    return $namaFileBaru;


    return $namaFile;
    
}

function hapus($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM tas WHERE id= $id");
    return mysqli_affected_rows($conn);
}

function edit($data, $id){
    global $conn;
    $nama = $data['nama'];
    $jumlah = $data['jumlah'];
    $warna = $data['warna'];
    $gambarLama = htmlspecialchars($data['gambarLama']);

    //Cek apakah user pilih gambar baru atau tidak
    if ($_FILES['gambar']['error'] === 4 ) {
        $gambar = $gambarLama;
    }else {
        $gambar = upload();
    }

    $query = "UPDATE tas SET nama='$nama', jumlah='$jumlah', 
            warna='$warna' where id=$id";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function cari($keyword){
    $query = "SELECT * FROM tas WHERE nama LIKE '%$keyword%' OR
            jumlah LIKE '%$keyword%' OR warna LIKE '%$keyword%'";

    return tampil($query);
}

function registrasi($data){
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $pass1 = mysqli_real_escape_string($conn, $data["pass1"]);
    $pass2 = mysqli_real_escape_string($conn, $data["pass2"]);
    

    // Cek username sudah ada belum
    $result = mysqli_query($conn, "SELECT USERNAME FROM USERS WHERE USERNAME='$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
            alert('Username sudah terdaftar!');    
        </script>";
        return false;
    }

    //Cek konfirmasi password
    if ($pass1 !== $pass2) {
        echo "<script>
            alert('Konfirmasi password tidak sesuai!');    
        </script>";
        return false;
    }
    // // Enksripsi password
    $pass1 = password_hash($pass1, PASSWORD_DEFAULT);
    mysqli_query($conn, "INSERT INTO users VALUES('', '$username',
        '$pass1')");

    return mysqli_affected_rows($conn);
}


?>