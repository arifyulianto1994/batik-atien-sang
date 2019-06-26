<!-- page header -->
<section class="content-header">
	<h1>
		<i class="fa fa-folder-o icon-title"></i>Data Batik
		<a class="btn btn-primary btn-social pull-right" href="?module=form_batik&form=add" title="Tambah Data" data-toggle="tooltip">
			<i class="fa fa-plus"></i>Tambah
		</a>
	</h1>
</section>


<!-- main conten -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
			

			<?php 
				// fungsi utk tampilkan pesan
				// jika alert = ""(kosong)
				// tampilkan pesan ""(kosong)
				if(empty($_GET['alert'])){
					echo "";
				}
				// jika alert=1
				// tampilkan pesan sukses 'data pakaian baru berhasil disimpan'
				elseif ($_GET['alert']==1){
					echo "<div class='alert alert-success alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-check-circle'></i>Sukses!</h4>
							Data Batik baru berhasil disimpan.
						</div>";
				}
				// jika alert =2
				// tampilkan pesan sukses 'data pakaian berhasil diubah'
				elseif($_GET['alert']==2){
					echo "<div class='alert alert-success alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-check-circle'></i>Sukses!</h4>
							Data Batik baru berhasil diubah.
						</div>";
				}
				// jika alert=3
				// tampilkan pesan sukses 'data pakaian berhasil dihapus'
				elseif($_GET['alert']==3){
					echo "<div class='alert alert-success alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-check-circle'></i>Sukses!</h4>
							Data Batik baru berhasil dihapus.
						</div>";
				}
			 ?>

			 <div class="box box-primary">
			 	<div class="box-body">
			 		<!-- tampilan tabelpakaian -->
			 		<table id="dataTables1" class="table table-bordered table-striped table-hover">
			 			<!-- tampilan tabel header -->
			 			<thead>
			 				<tr>
			 					<th class="center">No.</th>
			 					<th class="center">Kode Barang</th>
			 					<th class="center">Nama Supplier</th>
			 					<th class="center">Nama Barang</th>
			 					<th class="center">Kategori</th>
			 					<th class="center">Harga Beli</th>
			 					<th class="center">Harga Jual</th>
			 					<th class="center">Stok</th>
			 					<th class="center">Aksi</th>
			 					
			 				</tr>
			 			</thead>
			 			<!-- tampilan tabel body -->
			 			<tbody>
			 				<?php 
			 					$no =1;
			 					// query utk menampilkan data dr tabel pakaian
			 					$query=mysqli_query($mysqli,"SELECT a.kd_barang,b.nama_supplier,a.nama_barang,a.kategori,a.harga_beli,a.harga_jual,a.stok FROM tb_pakaian a INNER JOIN tb_supplier b ON a.kd_supplier = b.kd_supplier ORDER BY a.kd_barang DESC") or die('Ada kesalahan pada query tampil data pakaian: '.mysqli_error($mysqli));

			 					// tampilkan data
			 					while($data=mysqli_fetch_assoc($query)) {
			 						$harga_beli = format_rupiah($data['harga_beli']);
			 						$harga_jual = format_rupiah($data['harga_jual']);
			 						// tampilkan isi tabel dr db ke tabel  di app
			 						echo "<tr>
			 								<td width='30' class='center'>$no</td>
			 								<td width='80' class='center'>$data[kd_barang]</td>
			 								<td width='80' class='center'>$data[nama_supplier]</td>
			 								<td width='150' class='center'>$data[nama_barang]</td>
			 								<td width='80' class='center'>$data[kategori]</td>
			 								<td width='70' align='right'>Rp. $harga_beli</td>
			 								<td width='70' align='right'>Rp. $harga_jual</td>
			 								<td width='50' class='center'>$data[stok]</td>
			 								<td class='center' width='80'>
			 									<div>
			 										<a data-toggle='tooltip' data-placement='top' title='Ubah' style='margin-right:5px' class='btn btn-warning btn-sm' href='?module=form_batik&form=edit&id=$data[kd_barang]'>
			 											<i style='color:#fff' class='glyphicon glyphicon-edit'></i>
			 										</a>";
			 				 ?>
			 				 <a data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger btn-sm" href="modules/batik/proses.php?act=delete&id=<?php echo $data['kd_barang'];?>" onclick="return confirm('Anda yakin akan menghapus barang <?php echo $data['nama_barang']; ?> ?');">
			 				 	<i style="color: #fff" class="glyphicon glyphicon-trash"></i>
			 				 </a>
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
			 </div>
		</div>
	</div>
</section>