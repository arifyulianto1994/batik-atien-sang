<?php 
	session_start();

	// panggil koneksi database.php utk koneksi
	require_once "../../config/database.php";

	// fungsi utk cek status login user
	// jika user blm login, alihkan ke halaman login dan tampilkan pesan =1
	if(empty($_SESSION['username']) && empty($_SESSION['password'])){
		echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
	}
	// jika user sdh login maka jalankan perintah utk insert ,update  dan delete
	else{
		// ambil data hasil submit dr form
		// $id_detail_masuk		=mysqli_real_escape_string($mysqli, trim($_POST['id_detail_masuk']));
		
		if (isset($_POST['kd_transaksi'])) {
			$tanggal				= mysqli_real_escape_string($mysqli, trim($_POST['tanggal_masuk']));
			$exp					= explode('-',$tanggal);
			$total_stok				= mysqli_real_escape_string($mysqli, trim($_POST['total_stok']));

			// data tabel barang masuk
			$kd_transaksi			= mysqli_real_escape_string($mysqli, trim($_POST['kd_transaksi']));
			$tanggal_masuk			= $exp[2]."-".$exp[1]."-".$exp[0];

			// data tabel detail masuk
			$kd_barang				= mysqli_real_escape_string($mysqli, trim($_POST['kd_barang']));
			$kd_supplier			= mysqli_real_escape_string($mysqli, trim($_POST['kd_supplier']));
			$jumlah_masuk			= mysqli_real_escape_string($mysqli, trim($_POST['jumlah_masuk']));
			$harga					= str_replace(".", "", mysqli_real_escape_string($mysqli, trim($_POST['harga'])));
			$sub_total				= mysqli_real_escape_string($mysqli, trim($_POST['sub_total']));

			$created_user	 		= $_SESSION['id_user'];

			// query utk simpan dataa ke tabell keranjang
			$insert_keranjang = mysqli_query($mysqli, "INSERT INTO keranjang (kd_transaksi, tanggal_masuk, kd_barang, kd_supplier, jumlah_masuk, harga, sub_total) VALUES ('$kd_transaksi', '$tanggal_masuk', '$kd_barang', '$kd_supplier', '$jumlah_masuk', '$harga', '$sub_total')");

			// cek query
			if($insert_keranjang){
				echo true;
			}

		} elseif (isset($_GET['id'])){
				$id_keranjang = $_GET['id'];
	
				// query utk hapus data pd tabel pakaian
				$query = mysqli_query ($mysqli, "DELETE FROM keranjang WHERE id_keranjang = '$id_keranjang'") or die('Ada Kesalahan pada query delete : '.mysqli_error($mysqli));
	
				// cek hasil query
				if ($query){
					// jika berhasil tampilkan pesan berhasil delete data
					echo true;
				}
		}

	}
 ?>