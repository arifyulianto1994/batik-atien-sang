<!-- content header -->
<section class="content-header">
	<h1>
		<i class="fa fa-cloud-download icon-title"></i>Data Batik Masuk

		<a class="btn btn-primary btn-social pull-right" href="?module=form_barang_masuk&form=add" title="Tambah Data" data-toggle="tooltip">
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
				// tampilkan pesan sukses "data batik masuk berhasil disimpan"
				elseif($_GET['alert']==1){
					echo "<div class='alert alert-success alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-check-circle'></i>Sukses!</h4>Data Batik Masuk berhasil disimpan
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
			 					$query = mysqli_query($mysqli, "SELECT b.kd_transaksi,b.tanggal_masuk,b.sub_total
			 													FROM tb_barang_masuk a, detail_masuk b
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
			 							<td width='100' class='center'>$data[sub_total]</td>
			 							
			 							
			 							<td class='center' width='80'>
			 								<div>
			 								<button type='button' class='btn btn-info' data-toggle='modal' data-target='#myModal'>Detail</button>
			 									";
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
			<!-- <p>Bagian body modal</p> -->
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



			 	<!-- <script type="text/javascript">
			 		$(document).ready(function(){
			 			$('#myModal').on('show.bs.modal', function (e) {
			 				var rawid = $(e.relatedTarget).data('id');
			 				$.ajax({
			 					type : 'post',
			 					url : 'proses.php',
			 					data : 'rawid='+ rawid,
			 					success : function(data){
			 					$('.fetched-data').html(data);
			 				}
			 				});
			 			});
			 		});
			 	</script> -->

			 	<script type="text/javascript">
			 		$(document).ready(function(){
			 			$('.view_data').click(function(){
			 				var id = $(this).attr("id");

			 				$.ajax({
			 					url : 'proses.php',
			 					method : 'post',
			 					data : {id:id},
			 					success:function(data){
			 						$('#myForm').html(data);
			 						$('#myModal').modal("show");
			 					}
			 				});
			 			});
			 		});
			 	</script>



			 	</div>
			 </div>
		</div>
	</div>
</section>
