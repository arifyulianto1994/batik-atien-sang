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
	else {
			if(isset($_POST['kd_transaksi'])){
				// ambil data hasil submit dr form
				$kd_transaksi		= mysqli_real_escape_string($mysqli, trim($_POST['kd_transaksi']));
				$tanggal			= mysqli_real_escape_string($mysqli, trim($_POST['tanggal_keluar']));
				$exp				= explode('-',$tanggal);
				$tanggal_keluar		= $exp[2]."-".$exp[1]."-".$exp[0];
				$kd_barang			= mysqli_real_escape_string($mysqli, trim($_POST['kd_barang']));
				$jumlah_keluar		= mysqli_real_escape_string($mysqli, trim($_POST['jumlah_keluar']));
				$harga 				= str_replace('.', '',mysqli_real_escape_string($mysqli, trim($_POST['harga'])));
				$total 				= str_replace('.', '',mysqli_real_escape_string($mysqli, trim($_POST['sub_total'])));

				$created_user = $_SESSION['id_user'];

				// query utk simpan dataa ke tabell keranjang
				$insert_keranjang = mysqli_query($mysqli, "INSERT INTO keranjang_keluar (kd_transaksi, tanggal_keluar, kd_barang, jumlah_keluar, harga, sub_total) VALUES ('$kd_transaksi', '$tanggal_keluar', '$kd_barang', '$jumlah_keluar', '$harga', '$total')");

				// cek query
				if($insert_keranjang){
					$query = mysqli_query ($mysqli, "SELECT SUM(sub_total) AS total FROM keranjang_keluar WHERE kd_transaksi = '$kd_transaksi'") or die('Ada Kesalahan pada query delete : '.mysqli_error($mysqli));
					
					$cek = mysqli_fetch_array($query);

					if ($cek['total'] !== null) {
						echo $cek['total'];
					}
				}
			}
			elseif (isset($_GET['kode_barang'])){
			
				$kd_barang = $_GET['kode_barang'];

				$query_pakaian 	= mysqli_query ($mysqli, "SELECT harga_jual, stok FROM tb_pakaian WHERE kd_barang = '$kd_barang'");
				$dt_harga 		= mysqli_fetch_array($query_pakaian);
				
				$data = array(
					'stok'	=> $dt_harga['stok'],
					'harga'	=> $dt_harga['harga_jual']
				);

				echo json_encode($data);

			}
			elseif (isset($_POST['id'])){
				$kd_transaksi = $_POST['id'];
	
				$query 	= mysqli_query ($mysqli, "SELECT SUM(sub_total) AS total FROM keranjang_keluar WHERE kd_transaksi = '$kd_transaksi'") or die('Ada Kesalahan pada query delete : '.mysqli_error($mysqli));
	
				$cek 	= mysqli_fetch_array($query);
	
				if ($cek['total'] !== null) {
					echo $cek['total'];
				}
	
			}
			elseif (isset($_GET['id'])){
				$id_keranjang = $_GET['id'];
	
				// query utk hapus data pd tabel pakaian
				$query = mysqli_query ($mysqli, "DELETE FROM keranjang_keluar WHERE id_keranjang = '$id_keranjang'") or die('Ada Kesalahan pada query delete : '.mysqli_error($mysqli));
	
				// cek hasil query
				if ($query){
					// jika berhasil tampilkan pesan berhasil delete data
					echo true;
				}
			}
			elseif (isset($_POST['bayar'])){

				$kd_transaksi 	= $_POST['code'];
				$total 			= str_replace(".", "", mysqli_real_escape_string($mysqli, trim($_POST['bayar'])));
				$tanggal 		= date('Y-m-d');
	
				// ambil data keranjang
				$query_keranjang 	= mysqli_query ($mysqli, "SELECT * FROM keranjang_keluar k INNER JOIN tb_pakaian p ON p.kd_barang = k.kd_barang  WHERE kd_transaksi = '$kd_transaksi'");
	
				while ($dt = mysqli_fetch_array($query_keranjang)) {
					
					// insert data keranjang ke detail masuk
					$query_detail_masuk 	= mysqli_query($mysqli, "INSERT INTO detail_keluar (kd_transaksi, tanggal_keluar, kd_barang, jumlah_keluar, harga, sub_total) VALUES ('".$dt['kd_transaksi']."', '".$dt['tanggal_keluar']."', '".$dt['kd_barang']."', '".$dt['jumlah_keluar']."', '".$dt['harga']."', '".$dt['sub_total']."')");
	
					$stok = $dt['stok'] - $dt['jumlah_keluar'];
	
					// update stok pakaian	
					$update_pakaian = mysqli_query($mysqli, "UPDATE tb_pakaian SET stok = '".$stok."' WHERE kd_barang = '".$dt['kd_barang']."' ");
	
					$stok = 0;
				}
	
				// hapus data keranjang
				$hapus_keranjang = mysqli_query ($mysqli, "DELETE FROM keranjang_keluar WHERE kd_transaksi = '$kd_transaksi'") or die('Ada Kesalahan pada query delete : '.mysqli_error($mysqli));
	
				// insert data barang masuk
				$insert_barang_masuk = mysqli_query($mysqli, "INSERT INTO tb_barang_keluar (kd_transaksi, tanggal_keluar, sub_total) VALUES ('$kd_transaksi', '$tanggal', '$total')");
	
			}
			elseif (isset($_POST['detail'])) {

				$kd_transaksi = $_POST['detail'];
	
				// ambil data transaksi barang masuk
				$query_detail_keluar = mysqli_query ($mysqli, "SELECT p.nama_barang, p.kategori, dk.kd_transaksi, dk.jumlah_keluar, dk.harga FROM detail_keluar dk INNER JOIN tb_pakaian p ON p.kd_barang = dk.kd_barang WHERE dk.kd_transaksi = '$kd_transaksi'");
	
				$temp = [];
				$i = 0;
	
				while ($dt_detail_keluar = mysqli_fetch_array($query_detail_keluar)) {
					$temp[$i]['nama_barang'] = $dt_detail_keluar['nama_barang'];
					$temp[$i]['kategori'] = $dt_detail_keluar['kategori'];
					$temp[$i]['jumlah_keluar'] = $dt_detail_keluar['jumlah_keluar'];
					$temp[$i]['harga'] = number_format($dt_detail_keluar['harga'], 0,',','.');
					
					$i++;
				}
	
				echo json_encode($temp);
			}
		}
 ?>