<!-- content header -->
<section class="content-header">
	<h1>
		<i class="fa fa-folder-o icon-title"></i>Data Supplier
		<a class="btn btn-primary btn-social pull-right" href="?module=form_supplier&form=add" title="Tambah Data" data-toggle="tooltip">
			<i class="fa fa-plus"></i>Tambah
		</a>
	</h1>
</section>

<!-- main conntent -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
			

			<?php 
				// tampilkan pesan jika aler=""
				if(empty($_GET['alert'])){
					echo "";
				}
				// jika alert =1
				// tampilkan pesan sukses data supplier baru berhasil disimpan
				elseif($_GET['alert']==1){
					echo "<div class='alert alert-success alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						<h4><i class='icon fa fa-check-circle'></i>Sukses!</h4>Data Supplier baru berhasil disimpan
					</div>";
				}
				// jika alert =2
				// tampilkan pesan sukses data suppl berhasil diubah
				elseif($_GET['alert']==2){
					echo "<div class='alert alert-success alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						<h4><i class='icon fa fa-check-circle'></i>Sukses!</h4>Data Supplier berhasil diubah
					</div>";
				}
				// jika alert =3
				// tampilkan pesan sukse data suppl berhasil dihapus
				elseif($_GET['alert']==3){
					echo "<div class='alert alert-success alert-dismissable'> 
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						<h4><i class='icon fa fa-chech-circle'></i>Sukses!</h4>Data Supplier berhasil dihapus
					</div>";
				}
			 ?>

			 <div class="box box-primary">
			 	<div class="box-body">
			 		<!-- tampilkan tabel suppl -->
			 		<table id="dataTables1" class="table table-bordered table-striped table-hover">
			 			<!-- tampilan tabel header -->
			 			<thead>
			 				<tr>
			 					<th class="center">No.</th>
			 					<th class="center">Kode Supplier</th>
			 					<th class="center">Nama</th>
			 					<th class="center">Alamat</th>
			 					<th class="center">No Hp</th>
			 					<th>Aksi</th>
			 				</tr>
			 			</thead>
			 			<!-- tampilan tabel body -->
			 			<tbody>
			 				<?php 
			 					$no=1;
			 					// query utk tampilkan data dr tabel suppl
			 					$query = mysqli_query($mysqli, "SELECT kd_supplier,nama_supplier,alamat_supplier,no_hp FROM tb_supplier ORDER BY kd_supplier DESC") or die('Ada kesalahan pada query tampil data supplier: '.mysqli_error($mysqli));


			 					// tampilkan data
			 					while($data = mysqli_fetch_assoc($query)){
			 					echo "<tr>
			 							<td width='30' class='center'>$no</td>
			 							<td width='80' class='center'>$data[kd_supplier]</td>
			 							<td width='100' class='center'>$data[nama_supplier]</td>
			 							<td width='150' class='center'>$data[alamat_supplier]</td>
			 							<td width='30' class='center'>$data[no_hp]</td>
			 							<td class='center' width='80'>
			 								<div>
			 									<a data-toggle='tooltip' data-placement='top' title='Ubah' style='margin-right:5px' class='btn btn-warning btn-sm' href='?module=form_supplier&form=edit&id=$data[kd_supplier]'>
			 										<i style='color:#fff' class='glyphicon glyphicon-edit'></i>
			 									</a>";
			 				 ?>
			 				 	<a data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger btn-sm" href="modules/supplier/proses.php?act=delete&id=<?php echo $data['kd_supplier']; ?>" onclick="return confirm('Anda yakin ingin menghapus supplier <?php echo $data['nama_supplier']; ?> ?');">
			 				 		<i style="color:#fff" class="glyphicon glyphicon-trash"></i>
			 				 	</a>
			 				<?php 
			 					echo "</div>
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