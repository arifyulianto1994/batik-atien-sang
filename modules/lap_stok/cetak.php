<?php 
session_start();
ob_start();

// panggil koneksi database.php utk koneksi
require_once "../../config/database.php";
// panggil fungsi utk format tanggal
include "../../config/fungsi_tanggal.php";
// panggil fungsi utk format rupiah
include "../../config/fungsi_rupiah.php";

$hari_ini = date("d-m-Y");

$no =1;

// query utk tampilkan data dr tabel pakaian
$query = mysqli_query($mysqli, "SELECT kd_barang,nama_barang,kategori,harga_beli,harga_jual,stok FROM tb_pakaian ORDER BY nama_barang ASC") or die('Ada kesalahan pada query tampil data barang: '.mysqli_error($mysqli));
$count = mysqli_num_rows($query);
 ?>

 <!-- bagian html yg akan konvert -->
 <html xmlns="http://www.w3.org/1999/xhtml">
 	<head>
 		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
 		<title>LAPORAN STOK BATIK</title>
 		<link rel="stylesheet" type="text/css" href="../../assets/css/laporan.css" />
 	</head>
 	<body>
 		<div id="title">
 			LAPORAN STOK BATIK
 		</div>

 		<hr><br>

 		<div id="isi">
 			<table idth="100%" border="0.3" cellpadding="0" cellspacing="0">
                <thead style="background:#e8ecee">
                    <tr class="tr-title">
                        <th height="20" align="center" valign="middle">NO.</th>
                        <th height="20" align="center" valign="middle">KODE BARANG</th>
                        <th height="20" align="center" valign="middle">NAMA BARANG</th>
                        <th height="20" align="center" valign="middle">KATEGORI</th>
                        <th height="20" align="center" valign="middle">HARGA BELI</th>
                        <th height="20" align="center" valign="middle">HARGA JUAL</th>
                        <th height="20" align="center" valign="middle">STOK</th>
                    </tr>
                </thead>
               	<tbody>
               		<?php 
               			while ($data = mysqli_fetch_assoc($query)) {
           					 $harga_beli = format_rupiah($data['harga_beli']);
            				$harga_jual = format_rupiah($data['harga_jual']);
            		// menampilkan isi tabel dari database ke tabel di aplikasi
            		echo "  <tr>
                        <td width='20' height='13' align='center' valign='middle'>$no</td>
                        <td width='80' height='13' align='center' valign='middle'>$data[kd_barang]</td>
                        <td style='padding-left:5px;' width='150' height='13' valign='middle'>$data[nama_barang]</td>
                        <td style='padding-left:5px;' width='100' height='13' valign='middle'>$data[kategori]</td>
                        <td style='padding-right:10px;' width='80' height='13' align='right' valign='middle'>Rp. $harga_beli</td>
                        <td style='padding-right:10px;' width='80' height='13' align='right' valign='middle'>Rp. $harga_jual</td>
                        <td style='padding-right:10px;' width='50' height='13' align='right' valign='middle'>$data[stok]</td>
                        
                    </tr>";
            		$no++;
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
$filename="LAPORAN STOK BARANG.pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
//==========================================================================================================
$content = ob_get_clean();
$content = '<page style="font-family: freeserif">'.($content).'</page>';
// panggil library html2pdf
require_once('../../assets/plugins/html2pdf_v4.03/html2pdf.class.php');
try
{
    $html2pdf = new HTML2PDF('P','F4','en', false, 'ISO-8859-15',array(10, 10, 10, 10));
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output($filename);
}
catch(HTML2PDF_exception $e) { echo $e; }
?>
