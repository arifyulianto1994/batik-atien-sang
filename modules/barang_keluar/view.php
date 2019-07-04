<!-- content header -->
<section class="content-header">
	<h1>
		<i class="fa fa-sign-in icon-title"></i>Data Batik Keluar

		<a class="btn btn-primary btn-social pull-right" href="?module=form_barang_keluar&form=add" title="Tambah Data" data-toggle="tooltip">
			<i class="fa fa-plus"></i>Tambah
		</a>
	</h1>
</section>

<!-- main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
			

			<?php 
				// fungsi utk tampil pesan
				// jika alert = "" (kosong)
				// tampilkan pesan "" (kosong
				if(empty($_GET['alert'])){
					echo "";
				}
				// jika alert=1
				// tampilkan pesan sukses "data barang keluar berhasil disimpan"
				elseif($_GET['alert']==1){
					echo "<div class='alert alert-success alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-check-circle'></i>Sukses!</h4>Data Batik Keluar berhasil disimpan
						</div>";
				}
			 ?>

			 <div class="box box-primary">
			 	<div class="box-body">
			 		<!-- tampilan tabel batik -->
			 		<table id="dataTables1" class="table table-bordered table-striped table-hover">
			 			<!-- tampilan tabel header -->
			 			<thead>
			 				<tr>
			 					<th class="center">No.</th>
			 					<th class="center">Kode Transaksi</th>
			 					<th class="center">Tanggal</th>
			 					<th class="center">Total</th>
			 					<th class="center">Aksi</th>
			 				</tr>
			 			</thead>

			 			<tbody>
			 				<?php 
			 					$no =1;
			 					// query utk tampilkan data dr tabel pakaian
			 					$query = mysqli_query($mysqli, "SELECT kd_transaksi,tanggal_keluar,sub_total
			 													FROM tb_barang_keluar 
			 													ORDER BY kd_transaksi") or die('Ada kesalahan pada query tampil data Batik keluar: '.mysqli_error($mysqli));

			 					// tampilkan data
			 					while ($data = mysqli_fetch_assoc($query)){
			 						$tanggal = $data['tanggal_keluar'];
			 						$exp = explode('-',$tanggal);
			 						$tanggal_keluar = $exp[2]."-".$exp[1]."-".$exp[0];
			 						$sub_total = format_rupiah($data['sub_total']);
			 					


			 					// tampilkan isi tabel dr database ke tbl di app
			 					echo "<tr>
			 							<td width='20' class='center'>$no</td>
			 							<td width='100' class='center'>$data[kd_transaksi]</td>
			 							<td width='80' class='center'>$tanggal_keluar</td>		 							
			 							<td width='80' align='right'>Rp. $sub_total</td>

			 							<td class='center' width='80'>
			 								<div>
			 									<button type='button' class='btn btn-info' data-toggle='modal' data-target='#myModal'>Detail</button>";
						 				 ?>
						 				 
						 				<?php 
						 					echo "</div
						 					</td>
						 					</tr>";
						 					$no++;
						 				}
						 				?>
			 			</tbody>
			 		</table>

			 		<div class="modal fade" id="myModal" role="dialog">
						<div class="modal-dialog">
							<div class="modal-content">
			 					<div class="modal-header">
			 						<button type="button" class="close" data-dismiss="modal">&times;</button>
			 						<h4 class="modal-title">Detail Transaksi</h4>
			 					</div>
							<div class="modal-body">
								<table id="dataTables1" class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th class="center">No.</th>
											<th class="center">Nama Barang</th>
											<th class="center">Kategori</th>
											<th class="center">Jumlah</th>
											<th class="center">Harga</th>
										</tr>
									</thead>
							</table>
							</div>
						<div class="fetched-data"></div>
		
						<div class="modal-footer">
							 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
							</div>	
						</div>
					</div>

			 	</div>
			 </div>
		</div>
	</div>
</section>


