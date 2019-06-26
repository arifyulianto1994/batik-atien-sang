<!-- page header -->
<section class="content-header">
	<h1>
		<i class="fa fa-home icon-title"></i>Beranda
	</h1>
	<ol class="breadcrumb">
		<li><a href="?module=beranda"><i class="fa fa-home"></i>Beranda</a></li>
	</ol>
</section>

<!-- main content -->
<section class="content">
	<div class="row">
		<div class="col-lg-12 col-xs-12">
			<div class="alert alert-info alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<p style="font-size: 15px">
					<i class="icon fa fa-user"></i>Selamat Datang <strong><?php echo $_SESSION['nama_user']; ?></strong> di Aplikasi Sistem Informasi Peramalan Persediaan Batik
				</p>
			</div> 
		</div>
	</div>

	<!-- small boxes -->
	<div class="row">
		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div style="background-color: #00c0ef;color: #fff" class="small-box">
				<div class="inner">
					<?php 
						// query utk tampilkan data dr tabel pakaian
						$query = mysqli_query($mysqli, "SELECT COUNT(kd_barang) as jumlah FROM tb_pakaian") or die('Ada kesalahan pada query tampil data pakaian: '.mysqli_error($mysqli));

						// tampilkan data
						$data = mysqli_fetch_assoc($query);
					?>
					<h3><?php echo $data['jumlah']; ?></h3>
					<p>Data Batik</p>
				</div>

				<div class="icon">
					<i class="fa fa-folder"></i>
				</div>
				<?php 
					 if ($_SESSION['hak_akses']!='Manajer') { ?>
           				 <a href="?module=form_batik&form=add" class="small-box-footer" title="Tambah Data" data-toggle="tooltip"><i class="fa fa-plus"></i></a>
				<?php 
				 	}else { ?>
				 		<a class="small-box-footer"><i class="fa"></i></a>
				<?php 
					}
				?>
			</div>
		</div>

		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div style="background-color: #6c90aa;color: #fff" class="small-box">
				<div class="inner">
					<?php 
						// query utk tampilkan data dr tabel pakaian
						$query = mysqli_query($mysqli, "SELECT COUNT(kd_supplier) as jumlah FROM tb_supplier") or die('Ada kesalahan pada query tampil data supplier: '.mysqli_error($mysqli));

						// tampilkan data
						$data = mysqli_fetch_assoc($query);
					?>
					<h3><?php echo $data['jumlah']; ?></h3>
					<p>Data Supplier</p>
				</div>
				
				<div class="icon">
					<i class="fa fa-folder"></i>
				</div>
				<?php 
					 if ($_SESSION['hak_akses']!='Manajer') { ?>
           				 <a href="?module=form_supplier&form=add" class="small-box-footer" title="Tambah Data" data-toggle="tooltip"><i class="fa fa-plus"></i></a>
				<?php 
				 	}else { ?>
				 		<a class="small-box-footer"><i class="fa"></i></a>
				<?php 
					}
				?>
			</div>
		</div>

		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div style="background-color: #00a65a;color: #fff" class="small-box">
				<div class="inner">
					 <?php 
					 	// query utk tampil data dr tabel barang masuk
					 $query =mysqli_query($mysqli, "SELECT COUNT(kd_transaksi)as jumlah FROM tb_barang_masuk") or die('Ada kesalahan pada query tampil data Batik Masuk: '.mysqli_error($mysqli));
					 // tampil data
					 $data = mysqli_fetch_assoc($query);
					 ?>
					 <h3><?php echo $data['jumlah']; ?></h3>
					 <p>Transaksi Batik Masuk</p>
				</div>
				<div class="icon">
					<i class="fa fa-cloud-download"></i>
				</div>
				<?php 
					if($_SESSION['hak_akses']!='Manajer') { ?>
						<a href="?module=form_barang_masuk&form=add" class="small-box-footer" title="Tambah Data" data-toggle="tooltip"><i class="fa fa-plus"></i></a>
				<?php 
					}else{ ?>
						<a class="small-box-footer"><i class="fa"></i></a>
					<?php 
					}
				?>
			</div>
		<!-- /.col -->
		</div>

		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div style="background-color: #6F00FF;color: #fff" class="small-box">
				<div class="inner">
					 <?php 
					 	// query utk tampil data dr tabel barang keluar
					 $query =mysqli_query($mysqli, "SELECT COUNT(kd_transaksi)as jumlah FROM tb_barang_keluar") or die('Ada kesalahan pada query tampil data Batik Keluar: '.mysqli_error($mysqli));
					 // tampil data
					 $data = mysqli_fetch_assoc($query);
					 ?>
					 <h3><?php echo $data['jumlah']; ?></h3>
					 <p>Transaksi Batik Keluar</p>
				</div>
				<div class="icon">
					<i class="fa fa-sign-in"></i>
				</div>
				<?php 
					if($_SESSION['hak_akses']!='Manajer') { ?>
						<a href="?module=form_barang_keluar&form=add" class="small-box-footer" title="Tambah Data" data-toggle="tooltip"><i class="fa fa-plus"></i></a>
				<?php 
					}else{ ?>
						<a class="small-box-footer"><i class="fa"></i></a>
					<?php 
					}
				?>
			</div>
		<!-- /.col -->
		</div>

		<div class="col-lg-3 col-xs-6">
 			<!-- small box -->
 			<div style="background-color: #f39c12;color: #fff" class="small-box">
 				<div class="inner">
 					<?php 
 						// query utk tampilkan data dr tabel batik
 					$query = mysqli_query($mysqli, "SELECT COUNT(kd_barang) as jumlah FROM tb_pakaian") or die('Ada kesalahan pada query tampil data batik: '.mysql_error($mysqli));

 					// tampilkan data
 					$data = mysqli_fetch_assoc($query);
 					?>
 					<h3><?php echo $data['jumlah']; ?></h3>
 					<p>Laporan Stok Batik</p>
 				</div>
 				<div class="icon">
 					<i class="fa fa-file-text-o"></i>
 				</div>
 				<?php 
					if($_SESSION['hak_akses']!='Manajer') { ?>
						<a href="?module=lap_stok" class="small-box-footer" title="Cetak" data-toggle="tooltip"><i class="fa fa-print"></i></a>
				<?php 
					}else{ ?>
						<a class="small-box-footer"><i class="fa"></i></a>
					<?php 
					}
				?>

 			<!-- 	<a href="?module=lap_stok" class="small-box-footer" title="Cetak Laporan" data-toggle="tooltip"><i class="fa fa-print"></i></a> -->
 			</div>
 		<!-- /.col -->
		</div>

		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div style="background-color: #dd4b39;color:#fff" class="small-box">
				<div class="inner">
					<?php 
						// query utk tampilkan data dr tabel barang masuk
					$query = mysqli_query($mysqli, "SELECT COUNT(kd_transaksi) as jumlah FROM tb_barang_masuk") or die('Ada kesalahan pada query tampil data Batik masuk: '.mysqli_error($mysqli));

					// tampilkan data
					$data = mysqli_fetch_assoc($query);
					 ?>
					 <h3><?php echo $data['jumlah']; ?></h3>
					 <p>Laporan Batik Masuk</p>
				</div>
				<div class="icon">
					<i class="fa fa-clone"></i>
				</div>
				<?php 
					if($_SESSION['hak_akses']!='Manajer') { ?>
						<a href="?module=lap_barang_masuk" class="small-box-footer" title="Cetak" data-toggle="tooltip"><i class="fa fa-print"></i></a>
				<?php 
					}else{ ?>
						<a class="small-box-footer"><i class="fa"></i></a>
					<?php 
					}
				?>

				<!-- <a href="?module=lap_barang_masuk" class="small-box-footer" title="Cetak Laporan" data-toggle="tooltip"><i class="fa fa-print"></i></a> -->
			</div>
		</div>

		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div style="background-color: #20B2AA;color:#fff" class="small-box">
				<div class="inner">
					<?php 
						// query utk tampilkan data dr tabel barang keluar
					$query = mysqli_query($mysqli, "SELECT COUNT(kd_transaksi) as jumlah FROM tb_barang_keluar") or die('Ada kesalahan pada query tampil data batik Keluar: '.mysqli_error($mysqli));

					// tampilkan data
					$data = mysqli_fetch_assoc($query);
					 ?>
					 <h3><?php echo $data['jumlah']; ?></h3>
					 <p>Laporan Batik Keluar</p>
				</div>
				<div class="icon">
					<i class="fa fa-file-pdf-o"></i>
				</div>
				<?php 
					if($_SESSION['hak_akses']!='Manajer') { ?>
						<a href="?module=lap_barang_keluar" class="small-box-footer" title="Cetak" data-toggle="tooltip"><i class="fa fa-print"></i></a>
				<?php 
					}else{ ?>
						<a class="small-box-footer"><i class="fa"></i></a>
					<?php 
					}
				?>

				<!-- <a href="?module=lap_barang_keluar" class="small-box-footer" title="Cetak Laporan" data-toggle="tooltip"><i class="fa fa-print"></i></a> -->
			</div>
		</div>

	</div>
</section>