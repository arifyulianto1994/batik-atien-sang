<?php 
	// cek tampilan form
	// jika form add data dipilih
	if($_GET['form']=='add'){?>
	<!-- tampilan form add data
		CONTENT HEADER -->
		<section class="content-header">
			<h1>
				<i class="fa fa-edit icon-title"></i>Input Supplier
			</h1>
			<ol class="breadcrumb">
				<li><a href="?module=beranda"><i class="fa fa-home"></i>Beranda</a></li>
				<li><a href="?module=supplier">Supplier</a></li>
				<li class="active">Tambah</li>
			</ol>
		</section>

		<!-- main content -->
		<section class="content">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-primary">
						<!-- form start -->
						<form role="form" class="form-horizontal" action="modules/supplier/proses.php?act=insert" method="POST">
							<div class="box-body">
								<?php 
									// query utk buat id trans
									$query_id = mysqli_query($mysqli, "SELECT RIGHT(kd_supplier,6) as kode FROM tb_supplier ORDER BY kd_supplier DESC LIMIT 1")or die('Ada kesalahan pada query tampil kd_supplier : '.mysqli_error($mysqli));

								$count = mysqli_num_rows($query_id);

								if($count <> 0){
									// ambil kode suppl
									$data_id=mysqli_fetch_assoc($query_id);
									$kode = $data_id['kode']+1;
								}else {
									$kode =1;
								}

								// buat kode suppl
								$buat_id=str_pad($kode, 6, "0", STR_PAD_LEFT);
								$kd_supplier = "S$buat_id";
								 ?>

								 <div class="form-group">
								 	<label class="col-sm-2 control-label">Kode Supplier</label>
								 	<div class="col-sm-5">
								 		<input type="text" class="form-control" name="kd_supplier" value="<?php echo $kd_supplier; ?>" readonly required>
								 	</div>
								 </div>

								 <div class="form-group">
								 	<label class="col-sm-2 control-label">Nama Supplier</label>
								 	<div class="col-sm-5">
								 		<input type="text" class="form-control" name="nama_supplier" autocomplete="off" required>
								 	</div>
								 </div>

								 <div class="form-group">
								 	<label class="col-sm-2 control-label">Alamat Supplier</label>
								 	<div class="col-sm-5">
								 		<input type="text" class="form-control" name="alamat_supplier" autocomplete="off" required>
								 	</div>
								 </div>

								 <div class="form-group">
								 	<label class="col-sm-2 control-label">No HP</label>
								 	<div class="col-sm-5">
								 		<input type="text" class="form-control" name="no_hp" autocomplete="off" required>
								 	</div>
								 </div>

							</div>

							<div class="box-footer">
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
										<input type="submit" class="btn btn-success btn-submit" name="simpan" value="Simpan">
										<a href="?module=supplier" class="btn btn-default btn-reset">Batal</a>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>

<?php 
}
// jika form edit yg dipilih
// isset:cek data ada/tdk
elseif($_GET['form']=='edit'){
	if(isset($_GET['id'])){
		// query utk tampilkan data dr tabel suppl
		$query = mysqli_query($mysqli, "SELECT kd_supplier,nama_supplier,alamat_supplier,no_hp FROM tb_supplier WHERE kd_supplier='$_GET[id]'") or die ('Ada kesalahan pada query tampi data supplier : '.mysqli_error($mysqli));

		$data = mysqli_fetch_assoc($query);
	}
 ?>
 <!-- tampilan form edit data -->
 <!-- content header -->
 <section class="content-header">
 	<h1>
 		<i class="fa fa-edit icon-title"></i>Ubah Supplier
 	</h1>
 	<ol class="breadcrumb">
 		<li><a href="?module=beranda"><i class="fa fa-home"></i>Beranda</a></li>
 		<li><a href="?module=supplier">Supplier</a></li>
 		<li class="active">Ubah</li>
 	</ol>
 </section>

 <!-- main content -->
 <section class="content">
 	<div class="row">
 		<div class="col-md-12">
 			<div class="box box-primary">
 				<!-- form-start -->
 				<form role="form" class="form-horizontal" action="modules/supplier/proses.php?act=update" method="POST">
 					<div class="box-body">
 						
 						<div class="form-group">
 							<label class="col-sm-2 control-label">Kode Supplier</label>
 							<div class="col-sm-5">
 								<input type="text" class="form-control" name="kd_supplier" value="<?php echo $data['kd_supplier']; ?>" readonly required>
 							</div>
 						</div>

 						<div class="form-group">
 							<label class="col-sm-2 control-label">Nama Supplier</label>
 							<div class="col-sm-5">
 								<input type="text" class="form-control" name="nama_supplier" autocomplete="off" value="<?php echo $data['nama_supplier']; ?>" required>
 							</div>
 						</div>

 						<div class="form-group">
 							<label class="col-sm-2 control-label">Alamat Supplier</label>
 							<div class="col-sm-5">
 								<input type="text" class="form-control" name="alamat_supplier" autocomplete="off" value="<?php echo $data['alamat_supplier']; ?>" required>
 							</div>
 						</div>

 						<div class="form-group">
 							<label class="col-sm-2 control-label">No HP</label>
 							<div class="col-sm-5">
 								<input type="text" class="form-control" name="no_hp" autocomplete="off" value="<?php echo $data['no_hp']; ?>" required>
 							</div>
 						</div>
</div>
 						<div class="box-footer">
 							<div class="form-group">
 								<div class="col-sm-offset-2 col-sm-10">
 									<input type="submit" class="btn btn-success btn-submit" name="simpan" value="Simpan">
 									<a href="?module=supplier" class="btn btn-default btn-reset">Batal</a>
 								</div>
 							</div>
 						</div>
 				</form>
 			</div>
 		</div>
 	</div>
 </section>
 <?php 
}
  ?>