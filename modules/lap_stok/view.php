<!-- content header -->
<section class="content-header">
  <h1>
    <i class="fa fa-file-text-o icon-title"></i> Laporan Stok Batik

    <a class="btn btn-primary btn-social pull-right" href="modules/lap_stok/cetak.php" target="_blank">
      <i class="fa fa-print"></i> Cetak
    </a>
  </h1>

</section>


<!-- main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-body">
					<!-- tampilan tabel pakaian -->
					<table id="dataTables1" class="table table-bordered table-striped table-hover">
						<!-- tampilan tabel header -->
						<thead>
							<tr>
								<th class="center">No.</th>
								<th class="center">Kode Barang</th>
								<th class="center">Nama Barang</th>
								<th class="center">Kategori</th>
								<th class="center">Harga Beli</th>
								<th class="center">Harga Jual</th>
								<th class="center">Stok</th>
								
							</tr>
						</thead>
						<!-- tampilan tabel body -->
						<tbody>
							<?php 
							$no=1;
							// query utk tampilkan data dr tabel pakaian
							$query = mysqli_query($mysqli, "SELECT kd_barang,nama_barang,kategori,harga_beli,harga_jual,stok FROM tb_pakaian ORDER BY nama_barang ASC") or die('Ada kesalahan pada query tampil data barang: '.mysqli_error($mysqli));

							// tampilkan data
							while($data = mysqli_fetch_assoc($query)){
					              $harga_beli = format_rupiah($data['harga_beli']);
					              $harga_jual = format_rupiah($data['harga_jual']);
					              // menampilkan isi tabel dari database ke tabel di aplikasi
					              echo "<tr>
					              			<td width='30' class='center'>$no</td>
					              			<td width='80' class='center'>$data[kd_barang]</td>
					              			<td width='100' class='center'>$data[nama_barang]</td>
					              			<td width='80' class='center'>$data[kategori]</td>
					              			<td width='100' align='right'>Rp. $harga_beli</td>
					              			<td width='100' align='right'>Rp. $harga_jual</td>
					              			<td width='80' align='right'>$data[stok]</td>
					              			
					              		</tr>";
					              	$no++;
					              }
 							 ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>