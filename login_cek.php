<?php 
	// panggil file utk koneksi ke db

require_once "config/database.php";

// ambil data hasil submit dari form
$username = mysqli_real_escape_string($mysqli, stripslashes(strip_tags(htmlspecialchars(trim($_POST['username'])))));
$password = md5(mysqli_real_escape_string($mysqli,stripcslashes(strip_tags(htmlspecialchars(trim($_POST['password']))))));

// utk memastikan username dan password berupa huruf atau angka

if(!ctype_alnum($username) OR !ctype_alnum($password)) {
	header("Location: index.php?alert=1");
}
else {
	// ambil data dr tabel user utk cek 
	$query = mysqli_query($mysqli, "SELECT * FROM tb_user WHERE username='$username' AND password='$password' AND status='aktif'") or die('Ada Kesalahan pada query user: '.mysqli_error($mysqli));
	$rows = mysqli_num_rows($query);

// jika data ada, maka jalankan perintah utk membuat session
	if ($rows > 0) {
		$data = mysqli_fetch_assoc($query);

		session_start();
		$_SESSION['id_user'] 		= $data['id_user'];
		$_SESSION['nama_user'] 		= $data['nama_user'];
		$_SESSION['username'] 		= $data['username'];
		$_SESSION['password'] 		= $data['password'];
		$_SESSION['hak_akses'] 		= $data['hak_akses'];

		// alihkan ke hal user
		header("Location: main.php?module=beranda");
	}

	// jika data tdk ada,alihkan ke hal login dan tampil pesan
	else {
		header("Location: index.php?alert=1");
	}
}

 ?>