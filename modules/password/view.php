<!-- content header -->
<section class="content-header">
	<h1>
		<i class="fa fa-lock icon-title"></i>Ubah Password
	</h1>
	<ol class="breadcrumb">
		<li><a href="?module=beranda"><i class="fa fa-home"></i>Beranda</a></li>
		<li class="active">Password</li>
		<li class="active">Ubah</li>
	</ol>
</section>

<!-- main content -->
<section class="content">
	<div class="row">
		<div class="com-md-12">
			

			<?php 
				// fungsi utk tampilkan pesan
				// jika alert = ""
				// tampilkan pesan ""
				if(empty($_GET['alert'])){
					echo "";
				}

				// jika alert =1 , tammpilkan pesan gagal "password lama anda salah"
				elseif($_GET['alert'] == 1){
					echo "<div class='alert alert-danger alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-times-circle'></i>Gagal!</h4>Password lama anda salah.
						</div>";
				}
				// jika alert =2, tampilkan pesan gagal "password baru dan ulangi password baru tdk cocok"
				elseif($_GET['alert'] == 2){
					echo "<div class='alert alert-danger alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-times-circle'></i>Gagal!</h4>Password baru dan ulangi password baru tidak cocok.
						</div>";
				}
				// jika aler = 3, tampilkan pesan password berhasil diubah
				elseif ($_GET['alert'] == 3) {
					echo "<div class='alert alert-success alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-check-circle'></i>Sukses!</h4>Password berhasil diubah.
						</div>";
				}
			 ?>


			 <!-- form ubah password -->
			 <div class="box box-primary">
			 	<!-- form start -->
			 	<form role="form" class="form-horizontal" method="POST" action="modules/password/proses.php">
			 		<div class="box-body">
			 			

			 			<div class="form-group">
			 				<label class="col-sm-2 control-label">Password Lama</label>
			 				<div class="col-sm-5">
			 					<input type="password" class="form-control" name="old_pass" autocomplete="off" required>
			 				</div>
			 			</div>

			 			<div class="form-group">
			 				<label class="col-sm-2 control-label">Password Baru</label>
			 				<div class="col-sm-5">
			 					<input type="password" class="form-control" name="new_pass" autocomplete="off" required>
			 				</div>
			 			</div>

			 			<div class="form-group">
			 				<label class="col-sm-2 control-label">Ulangi Password Baru</label>
			 				<div class="col-sm-5">
			 					<input type="password" class="form-control" name="retype_pass" autocomplete="off" required>
			 				</div>
			 			</div>
			 		</div>

			 		<div class="box-footer bg-btn-action">
			 			<div class="form-group">
			 				<div class="col-sm-offset-2 col-sm-10">
			 					<input type="submit" class="btn btn-success btn-submit" name="simpan" value="Simpan">
			 				</div>
			 			</div>
			 		</div>
			 	</form>
			 </div>
		</div>
	</div>
</section>