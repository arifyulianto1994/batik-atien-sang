<?php 

	session_start();

	// panggil koneksi database.php utk koneksi db
	require_once "../../config/database.php";

	// fungsi utk cek status login user
	// jika user blm login, alihkan ke halaman login dan tampilkan pesan =1
	if(empty($_SESSION['username']) && empty($_SESSION['password'])) {
		echo "<meta http-equiv='refresh' content='0; yrl=index.php?alert=1'>";
	}

	// jika user blm login, maka jalankan perintah utk ubah password
	else{
		if(isset($_POST['simpan'])) {
			if(isset($_SESSION['id_user'])) {
				// ambil data hasil submit dr form
				$old_pass = md5(mysqli_real_escape_string($mysqli, trim($_POST['old_pass'])));
				$new_pass = md5(mysqli_real_escape_string($mysqli, trim($_POST['new_pass'])));
				$retype_pass = md5(mysqli_real_escape_string($mysqli, trim($_POST['retype_pass'])));

				// ambil data hasil dr session user
				$id_user = $_SESSION['id_user'];

				// seleksi pass dr tabel user utk dicek
				$sql = mysqli_query($mysqli, "SELECT password FROM tb_user WHERE id_user=$id_user") or die('Ada kesalahan pada query seleksi password : '.mysqli_error($mysqli));
				$data = mysqli_fetch_assoc($sql);


				// fungsi utk cek pass sebelum diubah
				// jika input password lama tdk sesuai dg pass di db, alihkkan ke hal ubah pass dan tampilkan pesan=1
				if($old_pass != $data['password']) {
					header("Location: ../../main.php?module=password&alert=1");
				}

				// jika input pass lama sama dengan pass db, jalankan perintah untk cek selanjutnya
				else {
					// jika input pass baru tdk sama dg input ulangi pass baru, alihkan ke hal ubah pass dan tampilkan pesan =2
					if($new_pass != $retype_pass) {
						header("Location: ../../main.php?module=password&alert=2");
					}

					// jalankan perintah update pass
					else {
						// query utk ubah data pada tabel  user
						$query = mysqli_query($mysqli, "UPDATE tb_user SET password = '$new_pass' WHERE id_user = '$id_user'") or die('Ada kesalahan pada query update password : '.mysqli_error($mysqli));

						// cek query
						if($query) {
							// jika berhasil tampilkan psan berhasil iupdate data
							header("Location: ../../main.php?module=password&alert=3");
						}
					}
				}
			}
		}
	}
 ?>