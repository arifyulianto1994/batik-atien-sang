<?php 
	session_start();
	ob_start();

	// panggil koneksi database.php utk koneksi db
	require_once "../../config/database.php";
	// panggil fungsi utk format tgl
	include "../../config/fungsi_tanggal.php";
	// panggil fungsi utk format rupiah
	include "../../config/fungsi_rupiah.php";

	$hari_ini = date("d-m-Y");

	// ambil data hasil submit dr form
	$tgl1 = $_GET['tgl_awal'];
	$explode = explode('-',$tgl1);
	$tgl_awal = $explode[2]."-".$explode[1]."-".$explode[0];

	$tgl2 = $_GET['tgl_akhir'];
	$explode = explode("-", $tgl2);
	$tgl_akhir = $explode[2]."-".$explode[1]."-".$explode[0];

	if(isset($_GET['tgl_awal'])){
		$no =1;
		// query utk tampilkan data dr tabel barang_masuk
		$query = mysqli_query($mysqli, "SELECT a.kd_transaksi,b.kd_barang,b.nama_barang,a.jumlah_keluar,a.harga,a.total FROM detail_masuk as a INNER JOIN tb_pakaian as b ON a.kd_barang=b.kd_barang WHERE a.tanggal_keluar BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY a.kd_transaksi ASC") or die('Ada kesalahan pada query tampil Transaksi : '.mysqli_error($mysqli));
		$count = mysqli_num_rows($query);
	}
 ?>

<!-- bagian halaman html yg akan dikonvert -->
 <html xmlns="http://www.w3.org/1999/xhtml"> 
 	<head>
 		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
 		<title>LAPORAN BARANG KELUAR</title>
 		<link rel="stylesheet" type="text/css" href="../../assets/css/laporan.css" />
 	</head>
 	<body>
 		<div id="title">
 			LAPORAN BATIK KELUAR
 		</div>
 		<?php 
 			if($tgl_awal==$tgl_akhir){ ?>
 				<div id="title-tanggal">
 					Tanggal <?php echo tgl_eng_to_ind($tgl1); ?>
 				</div>
 		<?php 
 			}else { ?>
 				<div id="title-tanggal">
 					Tanggal <?php echo tgl_eng_to_ind($tgl1); ?> s.d <?php echo tgl_eng_to_ind($tgl2); ?>
 				</div>
 		<?php 
 			}
 		 ?>

 		 <hr><br>
 		 <div id="isi">
 		 	<table width="100" border="0.3" cellpadding="0" cellspacing="0"> 
 		 		<thead style="background: #e8ecee">
 		 			<tr class="tr-title">
 		 				<th height="20" align="center" valign="middle">NO.</th>
 		 				<th height="20" align="center" valign="middle">Kode Transaksi</th>
 		 				<th height="20" align="center" valign="middle">Tanggal</th>
 		 				<th height="20" align="center" valign="middle">Kode Barang</th>
 		 				<th height="20" align="center" valign="middle">Nama Barang</th>
 		 				<th height="20" align="center" valign="middle">Jumlah</th>
 		 				<th height="20" align="center" valign="middle">Total</th>
 		 			</tr>
 		 		</thead>
 		 		<tbody>
 		 			<?php 
 		 				// jika ada data
 		 				if($count == 0) {
 		 					echo "<tr>
 		 							<td width='40' height='13' align='center' valign='middle'></td>
 		 							<td width='120' height='13' align='center' valign='middle'></td>
 		 							<td width='80' height='13' align='center' valign='middle'></td>
 		 							<td width='80' height='13' align='center' valign='middle'></td>
 		 							<td style='padding-left:5px;' width='155' height='13' valign='middle'></td>
 		 							<td style='padding-right=:10px;' width='100' height='13' align='right' valign='middle'></td>
 		 							<td width='80' height='13' align='center' valign='middle'></td>
 		 						</tr>";

 		 				}
 		 				// jika data tdk ada
 		 				else{
 		 					// tampilkan data
 		 					while ($data=mysqli_fetch_assoc($query)){
 		 						$tanggal  = $data['tanggal_keluar'];
 		 						$exp      = explode('-', $tanggal);
 		 						$tanggal_masuk = $exp[2]."-".$exp[1]."-".$exp[0];

 		 						// tampilkan isi tabel dr db ke tabel di app
 		 						echo "<tr>
 		 								<td width='40' height='13' align='center' valign='middle'>$no</td>
 		 								<td width='120' height='13' align='center' valign='middle'>$data[kd_transaksi]</td>
 		 								<td width='80' height='13' align='center' valign='middle'>$tanggal_keluar</td>
 		 								<td width='80' height='13' align='center' valign='middle'>$data[kd_barang]</td>
 		 								<td style='padding-left:10px;' width='155' height='13' valign='middle'>$data[nama_barang]</td>
 		 								<td style='padding-right:10px;' width='100' height='13' align='right' valign='middle'>$data[jumlah_keluar]</td>
 		 								 <td width='80' height='13' align='center' valign='middle'>$data[harga]</td>
 		 								<td width='80' height='13' align='center' valign='middle'>$data[total]</td>
 		 							</tr>";
 		 						$no++;
 		 					}
 		 				}
 		 			 ?>
 		 		</tbody>
 		 	</table>

 		 	<div id="footer-tanggal">
 		 		Pekalongan, <?php echo tgl_eng_to_ind("$hari_ini"); ?>
 		 	</div>
 		 	<div id="footer-jabatan">
 		 		Pemilik
 		 	</div>

 		 	<div id="footer-nama">
 		 		Atien
 		 	</div>
 		 </div>
 	</body>
 </html>
 <?php 
$filename="LAPORAN BATIK KELUAR.pdf";

$content = ob_get_clean();
$content = '<page style="font-familiy: freeserif">'.($content).'</page>';

// panggil library html2pdf
require_once('../../assets/plugins/html2pdf_v4.03/html2pdf.class.php');
try{
	$html2pdf = new HTML2PDF('P','F4','en', false, 'ISO-8859-15',array(10, 10, 10, 10));
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output($filename);
}
catch(HTML2PDF_exception $e) { echo $e; }
  ?>
