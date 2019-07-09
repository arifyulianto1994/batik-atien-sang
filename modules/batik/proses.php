<?php 
	session_start();

	// panggil koneksi database.php utk koneksi
	require_once "../../config/database.php";

	// query utk cek status login user
	// jika user blm login alihkan ke halaman login dan tampilkan pesan =1
	if(empty($_SESSION['username']) && empty ($_SESSION['password'])){
		echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
	}

	// jika user sdh login, maka jalankan perintah utk insert, update dan delete
	else {
		if($_GET['act']=='insert') {
			if(isset($_POST['simpan'])){
			// ambil data hasil submit dr form
			$kd_barang 		= mysqli_real_escape_string($mysqli, trim($_POST['kd_barang']));
			$kd_supplier 	= mysqli_real_escape_string($mysqli, trim($_POST['kd_supplier']));
			// $nama_supplier 	= mysqli_real_escape_string($mysqli, trim($_POST['nama_supplier']));
			$nama_barang	= mysqli_real_escape_string($mysqli, trim($_POST['nama_barang']));
			$kategori		= mysqli_real_escape_string($mysqli, trim($_POST['kategori']));
			$created_user	= $_SESSION['id_user'];
		

			// query utk menyimpan data ke tabel pakaian
			$query = mysqli_query ($mysqli, "INSERT INTO tb_pakaian(kd_barang,kd_supplier,nama_barang,kategori,harga_beli,harga_jual, created_user,updated_user) VALUES('$kd_barang','$kd_supplier','$nama_barang','$kategori','$harga_beli','$harga_jual','$created_user','$created_user')") or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli));

			// cek query
			if($query){
				// jika berhasil tampilkan pesan berhasil simpan data
				header("location: ../../main.php?module=batik&alert=1");
			}
		}
	}

	elseif ($_GET['act']=='update'){
		if(isset($_POST['simpan'])){
			if(isset($_POST['kd_barang'])){
				// ambil data hasil submit dr form
				$kd_barang 		= mysqli_real_escape_string($mysqli, trim($_POST['kd_barang']));
				$kd_supplier 	= mysqli_real_escape_string($mysqli, trim($_POST['kd_supplier']));
				$nama_barang 	= mysqli_real_escape_string($mysqli, trim($_POST['nama_barang']));
				$kategori		= mysqli_real_escape_string($mysqli, trim($_POST['kategori']));
				$harga_beli 	= str_replace('.', '',mysqli_real_escape_string($mysqli, trim($_POST['harga_beli'])));
				$harga_jual		= str_replace('.', '', mysqli_real_escape_string($mysqli, trim($_POST['harga_jual'])));
				$updated_user	= $_SESSION['id_user'];

				// query utk ubah data pd tabel pakaian
				$query = mysqli_query($mysqli, "UPDATE tb_pakaian SET 
									kd_supplier 	= '$kd_supplier',
									nama_barang 	= '$nama_barang',
									kategori		= '$kategori',
									harga_beli		= '$harga_beli',
									harga_jual		= '$harga_jual',
									updated_user	= '$updated_user' WHERE kd_barang = '$kd_barang'") or die('Ada kesalahan pada query update: '.mysqli_error($mysqli));

				// cek query
				if($query){
					// jika berhasil tampilkan pesan berhasil update data
					header("location: ../../main.php?module=batik&alert=2");
				}
			}
		}
	}

	elseif($_GET['act']=='delete'){
		if(isset($_GET['id'])){
			$kd_barang=$_GET['id'];

			// query utk hapus data pd tabel pakaian
			$query = mysqli_query($mysqli, "DELETE FROM tb_pakaian WHERE kd_barang='$kd_barang'") or die('Ada Kesalahan pada query delete : '.mysqli_error($mysqli));

			// cek hasil query
			if($query){
				// jika berhasil tampilkan pesan berhasil delete data
				header("location: ../../main.php?module=batik&alert=3");
			}
		}
	}
}
 ?>