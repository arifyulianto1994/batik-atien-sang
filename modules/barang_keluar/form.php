<script type="text/javascript">
	function tampil_batik(input){
		var num = input.value;

		$.post("modules/barang_keluar/batik.php", {
			dataidbatik:num,
		}, function(response){
			$('#stok').html(response)

			document.getElementById('jumlah_masuk').focus();
		});
	}	
</script>

<?php 
	// fungsi utk cek tampilan form
	// jika form add data yg diklik
	if($_GET['form']=='add') { ?>
		<!-- tampilan form addd data -->
		<!-- content header -->
		<section class="content-header">
			<h1>
				<i class="fa fa-edit icon-title"></i>Input Data Batik Keluar
			</h1>
			<ol class="breadcrumb">
				<li><a href="?module=beranda"><i class="fa fa-home"></i>Beranda</a></li>
				<li><a href="?module=barang_keluar">Batik Keluar</a></li>
				<li class="active">Tambah</li>
			</ol>
		</section>

		<!-- main content -->
		<section class="content">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-primary">
						<!-- form statrt -->
						<form role="form" class="form-horizontal" action="modules/barang_keluar/proses.php?act=insert" method="POST" name="formBarangKeluar">
							<div class="box-body">
								<?php 
									// query utk buat kode transaksi
									$query_id = mysqli_query($mysqli, "SELECT RIGHT(kd_transaksi,7) as kode FROM tb_barang_keluar ORDER BY kd_transaksi DESC LIMIT 1") or die('Ada kesalahan pada query tampil kode transaksi : '.mysqli_error($mysqli));
									$count=mysqli_num_rows($query_id);

									if($count <> 0){
										// ambil data kode trans
										$data_id = mysqli_fetch_assoc($query_id);
										$kode = $data_id['kode']+1;
									}else{
										$kode=1;
									}

									// buat kode trans
									$tahun = date("Y");
									$buat_id = str_pad($kode, 7, "0", STR_PAD_LEFT);
									$kd_transaksi = "TK-$tahun-$buat_id";
								 ?>

								 <div class="form-group">
								 	<label class="col-sm-2 control-label">Kode Transaksi</label>
								 	<div class="col-sm-5">
								 		<input type="text" class="form-control" name="kd_transaksi" value="<?php echo $kd_transaksi; ?>" readonly required>
								 	</div>
								 </div>

								 <div class="form-group">
								 	<label class="col-sm-2 control-label">Tanggal Keluar</label>
								 	<div class="col-sm-5">
								 		<input type="text" class="form-control date-picker" date-date-format="dd-mm-yyyy" name="tanggal_keluar" autocomplete="off" value="<?php echo date("d-m-Y"); ?>" required>
								 	</div>
								 </div>
								 
								 <div class="form-group">
								 	<label class="col-sm-2 control-label">Batik</label>
								 	<div class="col-sm-5">
								 		<select class="chosen-select" name="kd_barang" data-placeholder="--Pilih--" onchange="tampil_batik(this)" autocomplete="off" required>
								 			<option value=""></option>
								 			<?php 
								 				$query_batik = mysqli_query($mysqli, "SELECT kd_barang, nama_barang FROM tb_pakaian ORDER BY nama_barang ASC") or die('Ada kesalahan pada query tampil batik: '.mysqli_error($mysqli));

								 				while($data_batik = mysqli_fetch_assoc($query_batik)){
								 					echo"<option value=\"$data_batik[kd_barang]\"> $data_batik[kd_barang] | $data_batik[nama_barang]</option>";
								 				}
								 			 ?>
								 		</select>
								 	</div>
								 </div>

								 <span id='stok'>
								 	<div class="form-group">
								 		<label class="col-sm-2 control-label">Stok</label>
								 		<div class="col-sm-5">
								 			<input type="text" class="form-control" id="stok" name="stok" readonly required>
								 		</div>
								 	</div>
								 </span>

								   <div class="form-group">
								 	<label class="col-sm-2 control-label">Jumlah</label>
								 	<div class="col-sm-5">
								 		<input type="text" class="form-control" id="jumlah_keluar" name="jumlah_keluar" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" required>
								 	</div>
								 </div>

								 <div class="form-group">
										<label class="col-sm-2 control-label">Harga</label>
										<div class="col-sm-5">
											<div class="input-group">
												<span class="input-group-addon">Rp.</span>
												<input type="text" class="form-control" id="harga" name="harga" autocomplete="off" onKeyPress="return goodchars(event, '0123456789,this>" readonly required>
											</div>
										</div>
									</div>

								  <div class="form-group">
										<label class="col-sm-2 control-label">Total</label>
										<div class="col-sm-5">
											<div class="input-group">
												<span class="input-group-addon">Rp.</span>
												<input type="text" class="form-control" id="total" name="total" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" readonly required>
											</div>
										</div>
									</div>


								 <hr>

							<!-- ./box body -->
							</div>

							<div class="box-footer">
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
										<input type="submit" class="btn btn-success btn-submit" name="simpan" value="Simpan">
										<a href="?module=barang_keluar" class="btn btn-default btn-reset">Batal</a>
									</div>
								</div>
							</div>
							
						</form>
					</div>
				</div>
			</div>
		</section>


		<section class="content">
			<h3>
				<i class="fa fa-shopping-cart icon-title"></i>List Produk
			</h3>
			<div class="row">
				<div class="col-md-12">
					<div class="box box-primary">
						<div class="box-body">
							<table class="table table-bordered table-striped table-hover">
			 			<!-- tampilan tabel header -->
			 			<thead>
			 				<tr>
			 					<th class="center">No.</th>
			 					<th class="center">Kode Transaksi</th>
			 					<th class="center">Tanggal</th>
			 					<th class="center">Kode Barang</th>
			 					<th class="center">Jumlah</th>
			 					<th class="center">Harga</th>
			 					<th class="center">Total</th>
			 					<th class="center">Aksi</th>
			 				</tr>
			 			</thead>
						<tbody>
			 				<?php 
			 					$no =1;
			 					// query utk tampilkan data dr tabel pakaian
			 					$query = mysqli_query($mysqli, "SELECT a.kd_transaksi,a.tanggal_keluar,b.kd_barang,a.jumlah_keluar,b.nama_barang								FROM detail_keluar as a INNER JOIN tb_pakaian as b ON a.kd_barang=b.kd_barang
			 													ORDER BY kd_transaksi DESC") or die('Ada kesalahan pada query tampil data Barang masuk: '.mysqli_error($mysqli));

			 					// tampilkan data
			 					while ($data = mysqli_fetch_assoc($query)){
			 						$tanggal = $data['tanggal_masuk'];
			 						$exp = explode('-',$tanggal);
			 						$tanggal_masuk = $exp[2]."-".$exp[1]."-".$exp[0];
			 					


			 					// tampilkan isi tabel dr database ke tbl di app
			 					echo "<tr>
			 							<td width='30' class='center'>$no</td>
			 							<td width='100' class='center'>$data[kd_transaksi]</td>
			 							<td width='80' class='center'>$tanggal_masuk</td>
			 							<td width='100' class='center'>$data[kd_barang]</td>
			 							<td width='100' class='center'>$data[nama_barang]</td>
			 							<td width='80' class='center'>$data[jumlah_masuk]</td>
			 							<td width='80' class='center'>$data[satuan]</td>
			 							<td class='center' width='80'>
			 								<div>
			 									<a data-toggle='tooltip' data-placement='top' title='Hapus' style='margin-right:5px' class='btn btn-danger btn-sm' href='?module=form_batik&form=edit&id=$data[kd_transaksi]'>
			 										<i style='color:#fff' class='fa fa-times'></i>
			 									</a>";
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
			 	</div>
			 	<div class="box-footer">
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<input type="submit" class="btn btn-success btn-submit" name="simpan" value="Selesai">
							</div>
						</div>
				</div>
				
			 </div>
		</div>
	</div>
</section>
<?php 
}
 ?>