<?php 
	session_start();

	// panggil koneksi database.php utk koneksi
	require_once "../../config/database.php";

	// fungsi utk cek status login user
	// jika blm login alihkan ke halaman login dan tampilkan pesan -1
	if(empty($_SESSION['username']) && empty($_SESSION['password'])){
		echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
	}
	// jika user sdh login jalankan perintah utk insert, update, dan delete
	else{
		if($_GET['act']=='insert'){
			if(isset($_POST['simpan'])){
				// ambill data hasil submit form
				$kd_supplier 		= mysqli_real_escape_string($mysqli, trim($_POST['kd_supplier']));
				$nama_supplier 		= mysqli_real_escape_string($mysqli, trim($_POST['nama_supplier']));
				$alamat_supplier 	= mysqli_real_escape_string($mysqli, trim($_POST['alamat_supplier']));
				$no_hp 				= mysqli_real_escape_string($mysqli, trim($_POST['no_hp']));

				// query utk simpan data ke tb_supplier
				$query = mysqli_query($mysqli, "INSERT INTO tb_supplier(kd_supplier,nama_supplier,alamat_supplier,no_hp) VALUES('$kd_supplier','$nama_supplier','$alamat_supplier','$no_hp')") or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli));

				// cek query
				if($query){
					// jika berhasil tampilkan pesan berhasil simpan data
					header("location: ../../main.php?module=supplier&alert=1");
				}
			}
		}
		elseif($_GET['act']=='update'){
			if(isset($_POST['simpan'])){
				if(isset($_POST['kd_supplier'])){
					// ambil data hasil submit d form
					$kd_supplier 	= mysqli_real_escape_string($mysqli, trim($_POST['kd_supplier']));
					$nama_supplier 	= mysqli_real_escape_string($mysqli, trim($_POST['nama_supplier']));
					$alamat_supplier= mysqli_real_escape_string($mysqli, trim($_POST['alamat_supplier']));
					$no_hp 			= mysqli_real_escape_string($mysqli, trim($_POST['no_hp']));

					// query utk ubah data pd tb_supplier
					$query = mysqli_query($mysqli, "UPDATE tb_supplier SET nama_supplier 	= '$nama_supplier',
																			alamat_supplier = '$alamat_supplier',
																			no_hp 			= '$no_hp' 
																			WHERE kd_supplier='$kd_supplier'") or die('Ada kesalahan pada query update :'.mysqli_error($mysqli));

					// cek query
					if($query){
						// jika berhasil tampilkan pesan berhasil update data
						header("location: ../../main.php?module=supplier&alert=2");
					}
				}
			}
		}
		elseif($_GET['act']=='delete'){
			if(isset($_GET['id'])){
				$kd_supplier = $_GET['id'];

				// query utk hapus data pd tb_supplier
				$query = mysqli_query($mysqli, "DELETE FROM tb_supplier WHERE kd_supplier='$kd_supplier'") or die('Ada kesalahan pada query delete : '.mysqli_error($mysqli));

				// cek hasil query
				if($query){
					// jika berhasil tampilkan pesan berhasil delete data
					header("location: ../../main.php?module=supplier&alert=3");
				}
			}
		}
	}
 ?>