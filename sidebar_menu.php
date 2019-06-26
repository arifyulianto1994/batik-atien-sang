<?php 
	// cek level utk tampil menu sesuai dgn hak akses
	// jika hak akses=admin tampilkan menu
if($_SESSION['hak_akses']=='Admin') { ?>
	<!-- sidebar menu -->
		<ul class="sidebar-menu">
			<li class="header">MAIN MENU</li>

	<?php 
		// fungsi utk cek menu aktif
		// jika menu branda dipilih, menu beranda aktif
		if ($_GET["module"]=="beranda") { ?>
			<li class="active">
				<a href="?module=beranda"><i class="fa fa-home"></i>Beranda</a>
			</li>
	<?php 
		}
	// jika tidak, menu home tdk aktif
	else { ?>
		<li>
			<a href="?module=beranda"><i class="fa fa-home"></i>Beranda</a>
		</li>
	<?php 
		}

	// <!-- jika menu data  batik dipilih, maka aktif -->

	if($_GET["module"]=="batik" || $_GET["module"]=="form_batik") { ?>
		<li class="active">
			<a href="?module=batik"><i class="fa fa-folder"></i>Data Batik</a>
		</li>
	<?php 
	}

	// jika tdk, maka menu data batik tdk aktif
	else { ?>
		<li>
			<a href="?module=batik"><i class="fa fa-folder"></i>Data Batik</a>
		</li>


	<?php 
		}

	// <!-- jika menu data  suplier dipilih, maka aktif -->

	if($_GET["module"]=="supplier" || $_GET["module"]=="form_supplier") { ?>
		<li class="active">
			<a href="?module=supplier"><i class="fa fa-folder"></i>Data Supplier</a>
		</li>
	<?php 
	}

	// jika tdk, maka menu data supplier tdk aktif
	else { ?>
		<li>
			<a href="?module=supplier"><i class="fa fa-folder"></i>Data Supplier</a>
		</li>

	<?php 
		}

	// jika menu data barang masuk dipilih, maka menu data barang masuk aktif
	if($_GET["module"]=="barang_masuk" || $_GET["module"]=="form_barang_masuk") {?>
		<li class="active">
			<a href="?module=barang_masuk"><i class="fa fa-cloud-download"></i>Transaksi Batik Masuk</a>
		</li>

	<?php 
		}
	// jika tdk, maka menu data barang masuk tdk aktif
	else { ?>
		<li>
			<a href="?module=barang_masuk"><i class="fa fa-cloud-download"></i>Transaksi Batik Masuk</a>
		</li>

	<?php 
	}
	// jika menu data barang keluar dipilih, maka menu data barang keluar aktif
	if($_GET["module"]=="barang_keluar" || $_GET["module"]=="form_barang_keluar") {?>
		<li class="active">
			<a href="?module=barang_keluar"><i class="fa fa-share-square"></i>Transaksi Batik Keluar</a>
		</li>

	<?php 
		}
	// jika tdk, maka menu data barang keluar tdk aktif
	else { ?>
		<li>
			<a href="?module=barang_keluar"><i class="fa fa-share-square"></i>Transaksi Batik Keluar</a>
		</li>

	<?php 
	}

	// jika menu laporan stok batik dipilih menu lap stok batik aktif
	if($_GET["module"]=="lap_stok"){?>
		<li class="active treeview">
			<a href="javascript:void(0);">
				<i class="fa fa-file-text"></i><span>Laporan</span><i class="fa fa-angle-left pull-right"></i>
			</a>
				<ul class="treeview-menu">
					<li class="active"><a href="?module=lap_stok"><i class="fa fa-circle-o"></i>Stok Barang</a>
					</li>
					<li><a href="?module=lap_barang_masuk"><i class="fa fa-circle-o"></i>Batik Masuk</a></li>
					<li><a href="?module=lap_barang_keluar"><i class="fa fa-circle-o"></i>Batik Keluar</a></li>
				</ul>
		</li>
	<?php 
	 }


	 // jika menu laporan barang masuk dipilih, menu lap barang masuk aktif
	 elseif($_GET["module"]=="lap_barang_masuk"){?>
	 	<li class="active treeview">
	 		<a href="javascript:void(0);">
	 			<i class="fa fa-file-text"></i><span>Laporan</span><i class="fa fa-angle-left pull-right"></i>
	 		</a>
	 			<ul class="treeview-menu">
	 				<li><a href="?module=lap_stok"><i class="fa fa-circle-o"></i>Stok Barang</a></li>
	 				<li class="active"><a href="?module=lap_barang_masuk"><i class="fa fa-circle-o"></i>Batik Masuk</a></li>
	 				<li><a href="?module=lap_barang_keluar"><i class="fa fa-circle-o"></i>Batik Keluar</a></li>
	 			</ul>
	 	</li>
	 <?php 
	 }

	 // jika menu laporan barang keluar dipilih, menu lap barang keluar aktif
	 elseif($_GET["module"]=="lap_barang_keluar"){?>
	 	<li class="active treeview">
	 		<a href="javascript:void(0);">
	 			<i class="fa fa-file-text"></i><span>Laporan</span><i class="fa fa-angle-left pull-right"></i>
	 		</a>
	 			<ul class="treeview-menu">
	 				<li><a href="?module=lap_stok"><i class="fa fa-circle-o"></i>Stok Barang</a></li>
	 				<li><a href="?module=lap_barang_masuk"><i class="fa fa-circle-o"></i>Batik Masuk</a></li>
	 				<li class="active"><a href="?module=lap_barang_keluar"><i class="fa fa-circle-o"></i>Batik Keluar</a></li>
	 			</ul>
	 	</li>
	 <?php 
	 }
	 // jjika menu laporan tdk dipilih, menu lap tdk aktif
	 else{ ?>
	 	<li class="treeview">
	 		<a href="javascript:void(0);">
	 			<i class="fa fa-file-text"></i> <span>Laporan</span><i class="fa fa-angle-left pull-right"></i>
	 		</a>
	 		<ul class="treeview-menu">
	 			<li><a href="?module=lap_stok"><i class="fa fa-circle-o"></i>Stok Barang</a></li>
	 			<li><a href="?module=lap_barang_masuk"><i class="fa fa-circle-o"></i>Batik Masuk</a></li>
	 			<li><a href="?module=lap_barang_keluar"><i class="fa fa-circle-o"></i>Batik Keluar</a></li>
	 		</ul>
	 	</li>
	 <?php 
	}

	 // jika menu ubah pass dipilih, akan aktif
	 if($_GET["module"]=="password"){?>
	 	<li class="active">
	 		<a href="?module=password"><i class="fa fa-lock"></i>Ubah Password</a>
	 	</li>
	 <?php 
	}
	// jika tdk menu ubah pass tdk aktf
	else{?>
		<li>
			<a href="?module=password"><i class="fa fa-lock"></i>Ubah Password</a>
		</li>
	<?php 
	}
	?>
</ul>
		<!-- side bar menu en -->

<?php 
}
// jika hak akses = pemilik ,tampilkan menu
elseif($_SESSION['hak_akses']=='Manajer') { ?>
	<!--sidebar menu start  -->
		<ul class="sidebar-menu">
			<li class="header">MAIN MENU</li>


			<?php 
				// fungsi utk cek menu aktif
				// jika menu beranda dipilih maka akan aktif
				if($_GET["module"]=="beranda") {?>
					<li class="active"> 
						<a href="?module=beranda"><i class="fa fa-home"></i>Beranda</a>
					</li>
			<?php 
			}
			// jika tdk, menu beranda tdk aktif
			else {?>
				<li>
					<a href="?module=beranda"><i class="fa fa-home"></i>Beranda</a>
				</li>
			<?php 
			 }

			 // jika menu lap stok barang dipilih ,maka akan aktif
			 /*if($_GET["module"]=="lap_stok"){?>
			 	<li class="active treeview">
			 		<a href="javascript:void(0);">
			 			<i class="fa fa-file-text"></i><span>Laporan</span><i class="fa fa-angle-left pull-right"></i>
			 		</a>
			 			<ul class="treeview-menu">
			 				<li class="active"><a href="?module=lap_stok"><i class="fa fa-circle-o"></i>Stok Barang</a>
			 				</li>
			 				<li><a href="?module=lap_barang_masuk"><i class="fa fa-circle-o"></i>Barang Masuk</a></li>
			 				<li><a href="?module=lap_barang_keluar"><i class="fa fa-circle-o"></i>Barang Keluar</a></li>
			 			</ul>
			 	</li>
			 <?php 
			}
			// jika menu lap barang masuk dipilih, maka akan aktif
			elseif($_GET["module"]=="lap_barang_masuk"){ ?>
				<li class="active treeview">
					<a href="javascript:void(0);">
						<i class="fa fa-file-text"></i><span>Laporan</span><i class="fa fa-angle-left pull-right"></i>
					</a>
						<ul class="treeview-menu">
							<li><a href="?module=lap_stok"><i class="fa fa-circle-o"></i>Stok Barang</a></li>
							<li class="active"><a href="?module=lap_barang_masuk"><i class="fa fa-circle-o"></i>Barang Masuk</a></li>
							<li><a href="?module=lap_barang_keluar"><i class="fa fa-circle-o"></i>Barang Keluar</a></li>
						</ul>
				</li>
			<?php 
				}
				// jika menu lap barang keluar dipilih, maka akan aktif
			elseif($_GET["module"]=="lap_barang_keluar"){ ?>
				<li class="active treeview">
					<a href="javascript:void(0);">
						<i class="fa fa-file-text"></i><span>Laporan</span><i class="fa fa-angle-left pull-right"></i>
					</a>
						<ul class="treeview-menu">
							<li><a href="?module=lap_stok"><i class="fa fa-circle-o"></i>Stok Barang</a></li>
							<li><a href="?module=lap_barang_masuk"><i class="fa fa-circle-o"></i>Barang Masuk</a></li>
							<li class="active"><a href="?module=lap_barang_keluar"><i class="fa fa-circle-o"></i>Barang Keluar</a></li>
						</ul>
				</li>
			<?php 
				}

			// jika menu lap tdk dipilih maka tdk aktif
			else { ?>
				<li class="treeview">
					<a href="javascript:void(0);">
						<i class="fa fa-file-text"></i><span>Laporan</span><i class="fa fa-angle-left pull-right"></i>
					</a>
						<ul class="treeview-menu">
							<li><a href="?module=lap_stok"><i class="fa fa-circle-o"></i>Stok Barang</a></li>
							<li><a href="?module=lap_barang_masuk"><i class="fa fa-circle-o"></i>Barang Masuk</a>
							</li>
							<li><a href="?module=lap_barang_keluar"><i class="fa fa-circle-o"></i>Barang Keluar</a>
						</ul>
				</li>
			<?php 
			} 
			// jika menu grafik dipilih maka akan aktif
			if($_GET["module"]=="grafik" || $_GET["module"]=="form_grafik"){?>
				<li class="active">
					<a href="?module=grafik"><i class="fa fa-bar-chart"></i>Grafik Penjualan</a>
				</li>
			<?php 
			}
			// jika tdk, menu grafik tdk aktif
			else{ ?>
				<li>
					<a href="?module=grafik"><i class="fa fa-bar-chart"></i>Grafik Penjualan</a>
				</li>
			<?php 
			 }*/

			 // jika menu peramaln dipilih, maka akan aktif
			 if($_GET["module"]=="peramalan" || $_GET["module"]=="form_peramalan"){?>
			 	<li class="active">
			 		<a href="?module=peramalan"><i class="fa fa-refresh"></i>Peramalan</a>
			 	</li>
			 <?php 
			 }
			 // jika tdk, menu peramalan tdk aktif
			 else{ ?>
			 	<li>
			 		<a href="?module=peramalan"><i class="fa fa-refresh"></i>Peramalan</a>
			 	</li>

			<?php 
			}
			// jika menu lap peramalan dipilih maka akan aktif
			 if($_GET["module"]=="lap_peramalan" || $_GET["module"]=="lap_peramalan"){?>
			 	<li class="active">
			 		<a href="?module=lap_peramalan"><i class="fa fa-file-text"></i>Laporan Peramalan</a>
			 	</li>
			 <?php 
			 }
			 // jika tdk, menu lap peramalan tdk aktif
			 else{ ?>
			 	<li>
			 		<a href="?module=lap_peramalan"><i class="fa fa-file-text"></i>Laporan Peramalan</a>
			 	</li>
			 <?php 
			}

			// jika menu user dipilih, menu user aktif
			if($_GET["module"]=="user" || $_GET["module"]=="form_user"){?>
				<li class="active">
					<a href="?module=user"><i class="fa fa-user"></i>Manajemen User</a>
				</li>

			<?php 
			}
			// jika tdk, menu user tdk aktf
			else{ ?>
				<li>
					<a href="?module=user"><i class="fa fa-user"></i>Manajemen User</a>
				</li>
			<?php 
			}
			// jika menu ubah password dipilih maka akan aktif
			if($_GET["module"]=="password"){?>
				<li class="active">
					<a href="?module=password"><i class="fa fa-lock"></i>Ubah Password</a>
				</li>
			<?php 
				}
			// jika tdk menu ubah password tdk aktif
			else { ?>
				<li>
					<a href="?module=password"><i class="fa fa-lock"></i>Ubah Password</a>
				</li>
			<?php 
				}
			 ?>
	</ul>
	<!-- sidebarmenu end -->

<?php 
}
?>