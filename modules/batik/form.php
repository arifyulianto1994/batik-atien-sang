<?php 
	// fungsi cek tampilan form
	// jika form add data yg dipilih
	if ($_GET['form']=='add'){ ?>
		<!-- tampilan form add data -->
		<!-- page header -->
		<section class="content-header">
			<h1>
				<i class="fa fa-edit icon-title"></i>Input Batik
			</h1>
			<ol class="breadcrumb">
				<li><a href="?module=beranda"><i class="fa fa-home"></i>Beranda</a></li>
				<li><a href="?module=batik">Batik</a></li>
				<li class="active">Tambah</li>
			</ol>
		</section>

		<!-- maiin content -->
		<section class="content">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-primary">
						<!-- form start -->
						<form role="form" class="form-horizontal" action="modules/batik/proses.php?act=insert" method="POST">
							<div class="box-body">
								<?php 
									// query utk buat id transaksi
									$query_id=mysqli_query($mysqli, "SELECT RIGHT(kd_barang,6) as kode FROM tb_pakaian ORDER BY kd_barang DESC LIMIT 1") or die('Ada kesalahan pada query tampil data batik : '.mysqli_error($mysqli));
									$count = mysqli_num_rows($query_id);
									if($count <> 0){
										// ambil data kode brg
										$data_id = mysqli_fetch_assoc($query_id);
										$kode = $data_id['kode']+1;
									}else{
										$kode =1;
									}

									// buat kode brg
									$buat_id = str_pad($kode, 6, "0", STR_PAD_LEFT);
									$kd_barang = "B$buat_id";
									?>

									<div class="form-group">
										<label class="col-sm-2 control-label">Kode Barang
										</label>
										<div class="col-sm-5">
											<input type="text" class="form-control" name="kd_barang" value="<?php echo $kd_barang; ?>" readonly required>
										</div>
									</div>

									 <div class="form-group">
								 	<label class="col-sm-2 control-label">Nama Supplier</label>
								 	<div class="col-sm-5">
								 		<select class="chosen-select" name="kd_supplier" data-placeholder="--Pilih--" autocomplete="off" required>
								 			<option value=""></option>
								 			<?php 
								 				$query_suppl = mysqli_query($mysqli, "SELECT kd_supplier, nama_supplier FROM tb_supplier ORDER BY nama_supplier ASC") or die('Ada kesalahan pada query tampil suppl: '.mysqli_error($mysqli));

								 				while($data_suppl = mysqli_fetch_assoc($query_suppl)){ ?>
								 					<option value="<?= $data_suppl['kd_supplier'] ?>"> <?= $data_suppl['kd_supplier'] ?> | <?= $data_suppl['nama_supplier'] ?></option>
								 				<?php } ?>
								 		</select>
								 	</div>
								 </div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Nama Barang</label>
										<div class="col-sm-5">
											<input type="text" class="form-control" name="nama_barang" autocomplete="off" required>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Kategori</label>
										<div class="col-sm-5">
											<select class="chosen-select" name="kategori" data-placeholder="--Pilih--" autocomplete="off" required>
												<option value=""></option>
												<option value="Blouse">Blouse</option>
												<option value="Gamis">Gamis</option>
												<option value="Brukat">Brukat</option>
												<option value="Pakaian Anak">Pakaian Anak</option>
												<option value="Sarimbit">Sarimbit</option>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Harga Beli</label>
										<div class="col-sm-5">
											<div class="input-group">
												<span class="input-group-addon">Rp.</span>
												<input type="text" class="form-control" id="harga_beli" name="harga_beli" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" required>
											</div>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Harga Jual</label>
										<div class="col-sm-5">
											<div class="input-group">
												<span class="input-group-addon">Rp.</span>
												<input type="text" class="form-control" id="harga_jual" name="harga_jual" autocomplete="off" onKeyPress="return goodchars(event, '0123456789,this>" required>
											</div>
										</div>
									</div>

								<!--/. box body -->
								</div>

							<div class="box-footer">
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
										<input type="submit" class="btn btn-success btn-submit" name="simpan" value="Simpan">
										<a href="?module=batik" class="btn btn-default btn-reset">Batal</a>
									</div>
								</div>
								<!-- /.box footer -->
							</div>  
						</form>
					<!-- /.box -->
					</div>
				<!-- /.col -->
				</div>
			<!-- /.row -->
			</div>
		<!-- content -->
		</section>

<?php 
}

// jika form edit daa yg diklik
// isset:cek data ada/tdk
elseif($_GET['form']=='edit'){
	if(isset($_GET['id'])){
		$query=mysqli_query($mysqli, "SELECT * FROM tb_pakaian a INNER JOIN tb_supplier b ON b.kd_supplier = a.kd_supplier WHERE a.kd_barang='$_GET[id]'") or die ('Ada kesalahan pada query tampil data batik : '.mysqli_error($mysqli));
		$data = mysqli_fetch_assoc($query);
	}
?>

<!-- tammpilan form edit data -->
<!-- page header(content) -->
<section class="content-header">
	<h1>
		<i class="fa fa-edit icon-title"></i>Ubah Batik
	</h1>
	<ol class="breadcrumb">
		<li><a href="?module=beranda"><i class="fa fa-home"></i>Beranda</a></li>
		<li><a href="?module=batik">Batik</a></li>
		<li class="active">Ubah</li>
	</ol>
</section>

<!-- main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<!-- form start -->
				<form role="form" class="form-horizontal" action="modules/batik/proses.php?act=update" method="POST"> 
					<div class="box-body">

					<input type="hidden" value="<?= $data['kd_supplier'] ?>" name="kd_supplier">
					
					<div class="form-group">
						<label class="col-sm-2 control-label">Kode Barang</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="kd_barang" value="<?php echo $data['kd_barang']; ?>" readonly required>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Nama Supplier</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="nama_supplier" value="<?php echo $data['nama_supplier']; ?>" readonly required>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Nama Barang</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="nama_barang" autocomplete="off" value="<?php echo $data['nama_barang']; ?>" required>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Kategori</label>
							<div class="col-sm-5">
								<select class="chosen-select" name="kategori" data-placeholder="--Pilih--" autocomplete="off" required>
									<option value="<?php echo $data['kategori']; ?>"><?php echo $data['kategori']; ?></option>
									<option value="Blouse">Blouse</option>
									<option value="Gamis">Gamis</option>
									<option value="Brukat">Brukat</option>
									<option value="Pakaian Anak">Pakaian Anak</option>
									<option value="Sarimbit">Sarimbit</option>
								</select>
							</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Harga Beli</label>
						<div class="col-sm-5">
							<div class="input-group">
								<span class="input-group-addon">Rp.</span>
								<input type="text" class="form-control" id="harga_beli" name="harga_beli" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" value="<?php echo format_rupiah($data['harga_beli']); ?>" required>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Harga Jual</label>
						<div class="col-sm-5">
							<div class="input-group">
								<span class="input-group-addon">Rp.</span>
								<input type="text" class="form-control" id="harga_jual" name="harga_jual" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" value="<?php echo format_rupiah($data['harga_jual']); ?>" required>
							</div>	
						</div>
					</div>

				<!--/.box body  -->
				</div>

				<div class="box-footer">
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<input type="submit" class="btn btn-success btn-submit" name="simpan" value="Simpan">
							<a href="?module=batik" class="btn btn-default btn-reset">Batal</a>
						</div>
					</div>

				<!-- /.box footer -->
				</div>	
			</form>
		<!-- /.box -->
		</div>
	<!-- /.col -->
	</div>
<!-- /.row -->
</div>
<!-- /.content -->
</section>
<?php 
}
 ?>