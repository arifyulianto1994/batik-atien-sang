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
		if($_GET['act']=='insert'){
			if(isset($_POST['simpan'])){
				// ambil data hasil submit dr form
				$kd_transaksi		=mysqli_real_escape_string($mysqli, trim($_POST['kd_transaksi']));
				$tanggal			=mysqli_real_escape_string($mysqli, trim($_POST['tanggal_keluar']));
				$exp				=explode('-',$tanggal);
				$tanggal_keluar		= $exp[2]."-".$exp[1]."-".$exp[0];
				$kd_barang			=mysqli_real_escape_string($mysqli, trim($_POST['kd_barang']));
				// $nama_barang		=mysqli_real_escape_string($mysqli, trim($_POST['nama_barang']));
				$jumlah_keluar		=mysqli_real_escape_string($mysqli, trim($_POST['jumlah_keluar']));
				$harga 				= str_replace('.', '',mysqli_real_escape_string($mysqli, trim($_POST['harga'])));
				$total 				= str_replace('.', '',mysqli_real_escape_string($mysqli, trim($_POST['total'])));

				$created_user = $_SESSION['id_user'];

				// query utk simpan dataa ke tabell barang keluar
				$query = mysqli_query($mysqli, "INSERT INTO tb_barang_keluar(kd_transaksi,tanggal_keluar,kd_barang,jumlah_keluar,harga,total,created_user) VALUES('$kd_transaksi','$tanggal_keluar','$kd_barang','$jumlah_keluar','$harga','$total','$created_user')") or die('Ada Kesalahan pada query insert : '.mysqli_error($mysqli));

				// cek query
				if($query){
					// query utk ubah data pd tabel batik
					$query1=mysqli_query($mysqli, "UPDATE tb_pakaian SET stok = '$total_stok' WHERE kd_barang='$kd_barang'") or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));

					// cek query
					if($query1){
						// jika berhasil tampilkan pesan berhasil simpandata
						header("location: ../../main.php?module=barang_keluar&alert=1");
					}
				}
			}
		}
	}
 ?>