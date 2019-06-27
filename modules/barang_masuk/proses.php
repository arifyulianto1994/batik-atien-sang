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

		// query utk simpan dataa ke tabell barang masuk
		$query_detailmasuk = mysqli_query($mysqli, "INSERT INTO detail_masuk (kd_transaksi, tanggal_masuk, kd_barang, kd_supplier, jumlah_masuk, harga, sub_total) VALUES ('$kd_transaksi', '$tanggal_masuk', '$kd_barang', '$kd_supplier', '$jumlah_masuk', '$harga', '$sub_total')");

		$query_barangmasuk = mysqli_query($mysqli, "INSERT INTO tb_barang_masuk (kd_transaksi, tanggal_masuk, sub_total) VALUES ('$kd_transaksi', '$tanggal_masuk', '$sub_total')");

		// cek query
		if($query_barangmasuk){
			// query utk ubah data pd tabel barang masuk
			$query1 = mysqli_query($mysqli, "UPDATE tb_pakaian SET stok = '$total_stok' WHERE kd_barang='$kd_barang'") or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));

			// cek query
			if($query1){
				// jika berhasil tampilkan pesan berhasil simpandata
				$nomor 	= 0; 
				$output = "";

				$output .= "<tr>";
					$output .= "<td>".$nomor."</td>";
					$output .= "<td>".$tanggal_masuk."</td>";
					$output .= "<td>".$kd_barang."</td>";
					$output .= "<td>".$jumlah_masuk."</td>";
					$output .= "<td>".$sub_total."</td>";
					$output .= "<td>
									<button class='btn btn-danger'><i class='glyphicon glyphicon-remove'></i></button>
								</td>";
				$output .= "</tr>";

				echo $output;
			}
		}

		// if($_POST['id']){
		// 	$view = $koneksi->query("SELECT * FROM detail_masuk WHERE id='$id'");
		// 	if($view->num_rows){
		// 		$row_view = $view->fetch_assoc();
		// 		echo '<table class="table table-bordered">
		// 				<tr>
		// 					<th>Nama Barang</th>
		// 					<td>'.$row_view['nama_barang'].'</td>
		// 				</tr>
		// 				<tr>
		// 					<th>Kategori</th>
		// 					<td>'.$row_view['kategori'].'</td>
		// 				</tr>
		// 					<th>Harga</th>
		// 					<td>'.$row_view['harga'].'</td>
		// 				</tr>
		// 					<th>Jumlah</th>
		// 					<td>'.$row_view['jumlah_masuk'].'</td>
		// 				</tr>'
							
		// 	}
		// }
	}
 ?>